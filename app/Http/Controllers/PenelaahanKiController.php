<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKi;
use App\Models\DataKi;
use App\Models\Kabupaten;
use App\Models\RiwayatPengajuanKi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenelaahanKiController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanKi::with([
            'jenisKi',
            'kabupaten',
            'userPengaju',
        ]);

        if ($request->filled('status')) {
            $query->where(
                'status_pengajuan',
                $request->status
            );
        }

        if ($request->filled('kabupaten_id')) {
            $query->where(
                'kabupaten_id',
                $request->kabupaten_id
            );
        }

        $pengajuan = $query->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $kabupaten = Kabupaten::orderBy('nama_kabupaten')
            ->get();

        return view('penelaahan-ki.index', compact(
            'pengajuan',
            'kabupaten'
        ));
    }

    public function show(PengajuanKi $pengajuanKi)
    {
        $pengajuanKi->load([
            'jenisKi',
            'kabupaten',
            'userPengaju',
            'riwayatPengajuan.user',
        ]);

        return view(
            'penelaahan-ki.show',
            compact('pengajuanKi')
        );
    }


public function masukkanKeDataKi(PengajuanKi $pengajuanKi)
{
    if ($pengajuanKi->status_pengajuan !== 'diterima') {
        return back()->with(
            'error',
            'Hanya pengajuan yang diterima yang dapat dimasukkan ke Data KI.'
        );
    }

    if ($pengajuanKi->data_ki_id !== null) {
        return back()->with(
            'error',
            'Pengajuan ini sudah dimasukkan ke Data KI.'
        );
    }

    DB::transaction(function () use ($pengajuanKi) {
        $pengajuanKi = PengajuanKi::whereKey($pengajuanKi->id)
            ->lockForUpdate()
            ->firstOrFail();

        if (
            $pengajuanKi->status_pengajuan !== 'diterima' ||
            $pengajuanKi->data_ki_id !== null
        ) {
            throw new \RuntimeException(
                'Pengajuan tidak dapat dimasukkan kembali.'
            );
        }

        $dataKi = DataKi::create([
            'nama_ki' => $pengajuanKi->nama_ki,
            'jenis_ki_id' => $pengajuanKi->jenis_ki_id,
            'kabupaten_id' => $pengajuanKi->kabupaten_id,
            'pemilik' => $pengajuanKi->pemilik,
            'status' => 'proses',
            'tahun' => $pengajuanKi->tahun,
            'tanggal_pengajuan' => $pengajuanKi->tanggal_pengajuan,
            'keterangan' => $pengajuanKi->keterangan,
        ]);

        $pengajuanKi->data_ki_id = $dataKi->id;
        $pengajuanKi->save();
    });

    return redirect()
        ->route('penelaahan-ki.show', $pengajuanKi->id)
        ->with('success', 'Data KI berhasil dimasukkan ke data utama.');
}


    public function update(
        Request $request,
        PengajuanKi $pengajuanKi
    ) {
        $validated = $request->validate([
            'status_pengajuan' => [
                'required',
                'in:sedang_ditelaah,perlu_perbaikan,diterima,ditolak',
            ],
            'catatan_admin' => [
    'nullable',
    'string',
    'max:5000',
    Rule::requiredIf(
        $request->input('status_pengajuan') === 'ditolak'
    ),
],
        ]);

        if (
            $validated['status_pengajuan'] === 'perlu_perbaikan'
            && empty(trim($validated['catatan_admin'] ?? ''))
        ) {
            return back()
                ->withErrors([
                    'catatan_admin' =>
                        'Catatan wajib diisi jika meminta perbaikan.',
                ])
                ->withInput();
        }

        DB::transaction(function () use (
            $pengajuanKi,
            $validated,
            $request
        ) {
            $statusLama = $pengajuanKi->status_pengajuan;

            $pengajuanKi->status_pengajuan =
                $validated['status_pengajuan'];

            $pengajuanKi->catatan_admin =
                $validated['catatan_admin'] ?? null;

            $pengajuanKi->save();

            RiwayatPengajuanKi::create([
                'pengajuan_ki_id' => $pengajuanKi->id,
                'user_id' => $request->user()->id,
                'status_sebelumnya' => $statusLama,
                'status_baru' => $validated['status_pengajuan'],
                'catatan' => $validated['catatan_admin'] ?? null,
            ]);
        });

        return redirect()
            ->route('penelaahan-ki.show', $pengajuanKi->id)
            ->with('success', 'Hasil penelaahan berhasil disimpan.');
    }
}
