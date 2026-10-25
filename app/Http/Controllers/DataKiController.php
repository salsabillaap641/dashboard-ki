<?php

namespace App\Http\Controllers;

use App\Models\DataKi;
use App\Models\JenisKi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Models\PerpustakaanKi;
use App\Models\RiwayatPengajuanKi;
use App\Models\PengajuanKi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class DataKiController extends Controller
{
    public function create()
{
    $jenisKI = \App\Models\JenisKi::all();
    $daftarKabupaten = \App\Models\Kabupaten::all();

    return view('input-ki', compact(
    'jenisKI',
    'daftarKabupaten'
));
}

    


public function store(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'nama_ki' => 'required|string|max:255',
        'jenis_ki_id' => 'required|exists:jenis_ki,id',
        'pemilik' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1900|max:2100',
        'tanggal_pengajuan' => 'required|date',
        'nomor_kontak' => 'nullable|string|max:25',
        'bukti_pendukung' => $user->role === 'kabupaten'
            ? 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
            : 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'keterangan' => 'nullable|string',
    ]);

    // Input langsung oleh Master masuk ke data_ki
    if ($user->role === 'master') {
        $request->validate([
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'status' => 'required|in:terdaftar,proses,potensi',
        ]);

        $validated['kabupaten_id'] = $request->kabupaten_id;
        $validated['status'] = $request->status;
        if ($request->hasFile('bukti_pendukung')) {
            $validated['bukti_pendukung'] = $request->file('bukti_pendukung')
                ->store('bukti-pendukung-ki', 'public');
        }
        // Nomor kontak dan bukti disimpan pada data_ki untuk input Master.
        $validated['nomor_kontak'] = $validated['nomor_kontak'] ?? null;

        DataKi::create($validated);

        return redirect()
            ->route('data-ki.index')
            ->with('success', 'Data KI berhasil ditambahkan.');
    }

    // Input dari Kabupaten/Kota menjadi pengajuan
    if ($user->role === 'kabupaten') {
        if (!$user->kabupaten_id) {
            abort(403, 'Akun belum terhubung dengan kabupaten/kota.');
        }

        $pathBukti = $request->file('bukti_pendukung')->store('bukti-pendukung-ki', 'public');

        $pengajuan = PengajuanKi::create([
            'user_pengaju_id' => $user->id,
            'nama_ki' => $validated['nama_ki'],
            'jenis_ki_id' => $validated['jenis_ki_id'],
            'kabupaten_id' => $user->kabupaten_id,
            'pemilik' => $validated['pemilik'],
            'nomor_kontak' => $validated['nomor_kontak'] ?? null,
            'tahun' => $validated['tahun'],
            'tanggal_pengajuan' => $validated['tanggal_pengajuan'],
            'bukti_pendukung' => $pathBukti,
            'keterangan' => $validated['keterangan'] ?? null,
            'status_pengajuan' => 'menunggu_penelaahan',
            'catatan_admin' => null,
        ]);

        // Catat riwayat awal pengajuan
        RiwayatPengajuanKi::create([
            'pengajuan_ki_id' => $pengajuan->id,
            'user_id' => $user->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu_penelaahan',
            'catatan' => 'Pengajuan Potensi KI dikirim untuk penelaahan.',
        ]);

        return redirect('/')
            ->with(
                'success',
                'Pengajuan Potensi KI berhasil dikirim dan menunggu penelaahan Master.'
            );
    }

    abort(403, 'Kamu tidak memiliki akses untuk menambahkan data KI.');
}


public function pengajuanSaya(Request $request)
{
    $user = $request->user();

    abort_unless(
        $user->role === 'kabupaten',
        403,
        'Menu ini khusus pengguna Kabupaten/Kota.'
    );

    $pengajuan = PengajuanKi::with([
        'jenisKi',
        'kabupaten',
        'riwayatPengajuan.user',
    ])
        ->where('user_pengaju_id', $user->id)
        ->orderByDesc('id')
        ->paginate(10);

    return view('pengajuan-saya', compact('pengajuan'));
}


    public function detailPengajuanSaya(Request $request, PengajuanKi $pengajuanKi)
    {
        $user = $request->user();

        abort_unless(
            $user->role === 'kabupaten'
            && (int) $pengajuanKi->user_pengaju_id === (int) $user->id,
            403,
            'Kamu hanya dapat melihat detail pengajuan milikmu sendiri.'
        );

        $pengajuanKi->load([
            'jenisKi',
            'kabupaten',
            'riwayatPengajuan.user',
        ]);

        return view('detail-pengajuan-saya', compact('pengajuanKi'));
    }

    public function index(Request $request)
    {
        // Relasi perpustakaan_ki.data_ki_id sudah tidak digunakan.
        // Cocokkan data perpustakaan berdasarkan nama HAKI dengan nama KI.
        $query = DataKi::with(['jenisKi', 'kabupaten'])
            ->addSelect([
                'sudah_di_perpustakaan' => DB::table('perpustakaan_ki')
                    ->selectRaw('1')
                    ->whereRaw('perpustakaan_ki.nama_hak COLLATE utf8mb4_unicode_ci = data_ki.nama_ki COLLATE utf8mb4_unicode_ci')
                    ->limit(1),
            ]);

        // Pencarian nama KI atau pemilik
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_ki', 'like', "%{$search}%")
                    ->orWhere('pemilik', 'like', "%{$search}%");
            });
        }

        // Filter jenis KI
        if ($request->filled('jenis_ki_id')) {
            $query->where('jenis_ki_id', $request->jenis_ki_id);
        }

        // Filter kabupaten/kota
        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $dataKI = $query->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $jenisKI = JenisKi::all();
        $daftarKabupaten = Kabupaten::all();

        return view('data-ki', compact(
            'dataKI',
            'jenisKI',
            'daftarKabupaten'
        ));
    }


public function editPengajuan(Request $request, PengajuanKi $pengajuanKi)
{
    $user = $request->user();

    // Hanya pemilik pengajuan yang boleh mengedit
    abort_unless(
        $pengajuanKi->user_pengaju_id == $user->id
        && $user->role === 'kabupaten',
        403
    );

    // Hanya pengajuan yang perlu diperbaiki yang dapat diedit
    abort_unless(
        $pengajuanKi->status_pengajuan === 'perlu_perbaikan',
        403,
        'Pengajuan ini tidak dapat diedit.'
    );

    $jenisKI = JenisKi::all();

    return view('edit-pengajuan-ki', compact(
        'pengajuanKi',
        'jenisKI'
    ));
}

public function updatePengajuan(
    Request $request,
    PengajuanKi $pengajuanKi
) {
    $user = $request->user();

    abort_unless(
        $pengajuanKi->user_pengaju_id == $user->id
        && $user->role === 'kabupaten',
        403
    );

    abort_unless(
        $pengajuanKi->status_pengajuan === 'perlu_perbaikan',
        403,
        'Pengajuan ini tidak dapat diedit.'
    );

    $validated = $request->validate([
        'nama_ki' => 'required|string|max:255',
        'jenis_ki_id' => 'required|exists:jenis_ki,id',
        'pemilik' => 'required|string|max:255',
        'tahun' => 'required|integer|min:1900|max:2100',
        'tanggal_pengajuan' => 'required|date',
        'nomor_kontak' => 'nullable|string|max:25',
        'bukti_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'keterangan' => 'nullable|string',
    ]);

    if ($request->hasFile('bukti_pendukung')) {
        $pathBaru = $request->file('bukti_pendukung')->store('bukti-pendukung-ki', 'public');
        if ($pengajuanKi->bukti_pendukung) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pengajuanKi->bukti_pendukung);
        }
        $validated['bukti_pendukung'] = $pathBaru;
    }

    DB::transaction(function () use (
        $pengajuanKi,
        $validated,
        $user
    ) {
        $statusLama = $pengajuanKi->status_pengajuan;

        $pengajuanKi->update([
            ...$validated,
            'status_pengajuan' => 'menunggu_penelaahan',
            'catatan_admin' => null,
        ]);

        RiwayatPengajuanKi::create([
            'pengajuan_ki_id' => $pengajuanKi->id,
            'user_id' => $user->id,
            'status_sebelumnya' => $statusLama,
            'status_baru' => 'menunggu_penelaahan',
            'catatan' => 'Pengajuan telah diperbaiki dan dikirim ulang.',
        ]);
    });

    return redirect()
        ->route('pengajuan-saya')
        ->with(
            'success',
            'Pengajuan berhasil diperbaiki dan dikirim ulang untuk penelaahan.'
        );
}


    
public function show(Request $request, $id)
{
    abort_unless(
        $request->user() && $request->user()->role === 'master',
        403,
        'Hanya Master yang dapat melihat detail data KI.'
    );

    $ki = DataKi::with(['jenisKi', 'kabupaten'])->findOrFail($id);

    return view('detail-data-ki', compact('ki'));
}

public function edit(Request $request, $id)
{
    abort_unless(
        $request->user() && $request->user()->role === 'master',
        403,
        'Hanya Master yang dapat mengubah data KI.'
    );

    $ki = DataKi::findOrFail($id);
    $jenisKI = JenisKi::all();
    $daftarKabupaten = Kabupaten::all();

    return view('edit-ki', compact(
        'ki',
        'jenisKI',
        'daftarKabupaten'
    ));
}

    public function update(Request $request, $id)
    {
        abort_unless(
     $request->user() && $request->user()->role === 'master',
    403,
    'Hanya Master yang dapat mengubah data KI.'
);
        $ki = DataKi::findOrFail($id);

        $validated = $request->validate([
            'nama_ki' => 'required|string|max:255',
            'jenis_ki_id' => 'required|exists:jenis_ki,id',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'pemilik' => 'required|string|max:255',
            'status' => 'required|in:terdaftar,proses,potensi',
            'tahun' => 'required|integer|min:1900|max:2100',
            'tanggal_pengajuan' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        $ki->update($validated);

        return redirect()
            ->route('data-ki.index')
            ->with('success', 'Data KI berhasil diperbarui!');
    }


    public function destroy(Request $request, $id)
    {
        abort_unless(
     $request->user() && $request->user()->role === 'master',
    403,
    'Hanya Master yang dapat mengubah data KI.'
);
        $dataKI = DataKi::findOrFail($id);

        // Data Perpustakaan KI sekarang berdiri sendiri dan tidak lagi
        // terhubung melalui kolom data_ki_id, jadi jangan hapus data perpustakaan.
        $dataKI->delete();

        return redirect()->route('data-ki.index')
            ->with('success', 'Data KI berhasil dihapus. Data Perpustakaan KI tidak diubah.');
    }
}
