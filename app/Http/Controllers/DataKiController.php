<?php

namespace App\Http\Controllers;

use App\Models\DataKi;
use App\Models\JenisKi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class DataKiController extends Controller
{
    public function create()
    {
        $jenisKI = JenisKi::all();
        $daftarKabupaten = Kabupaten::all();

        return view('input-ki', compact('jenisKI', 'daftarKabupaten'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_ki' => 'required|string|max:255',
            'jenis_ki_id' => 'required|exists:jenis_ki,id',
            'kabupaten_id' => 'required|exists:kabupaten,id',
            'pemilik' => 'required|string|max:255',
            'status' => 'required|in:terdaftar,proses,potensi',
            'tahun' => 'required|integer|min:1900|max:2100',
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);


        DataKi::create($validated);

        return redirect()
            ->route('data-ki.create')
            ->with('success', 'Data KI berhasil ditambahkan!');
    }



    public function index(Request $request)
    {
        $query = DataKi::with(['jenisKi', 'kabupaten'])
            ->withExists([
                'perpustakaanKi as sudah_di_perpustakaan'
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

    public function edit($id)
    {
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

    public function destroy($id)
    {
        $ki = DataKi::findOrFail($id);
        $ki->delete();

        return redirect()
            ->route('data-ki.index')
            ->with('success', 'Data KI berhasil dihapus!');
    }
}
