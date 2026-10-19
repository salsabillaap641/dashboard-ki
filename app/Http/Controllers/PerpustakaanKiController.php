<?php

namespace App\Http\Controllers;

use App\Models\PerpustakaanKi;
use App\Models\JenisKi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Models\DataKi;

class PerpustakaanKiController extends Controller
{
    public function index(Request $request)
    {
        $query = PerpustakaanKi::with(['jenisKi', 'kabupaten']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_hak', 'like', "%{$search}%")
                  ->orWhere('nomor_hak', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis_ki_id')) {
            $query->where('jenis_ki_id', $request->jenis_ki_id);
        }

        if ($request->filled('kabupaten_id')) {
            $query->where('kabupaten_id', $request->kabupaten_id);
        }

        $dataPerpustakaan = $query
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $jenisKI = JenisKi::all();
        $daftarKabupaten = Kabupaten::all();

        return view('perpustakaan-ki', compact(
            'dataPerpustakaan',
            'jenisKI',
            'daftarKabupaten'
        ));
    }

    


public function create(Request $request)
{
    $dataKI = DataKi::with(['jenisKi', 'kabupaten'])
        ->where('status', 'terdaftar')
        ->whereNotIn('id', function ($query) {
            $query->select('data_ki_id')
                ->from('perpustakaan_ki')
                ->whereNotNull('data_ki_id');
        })
        ->orderBy('nama_ki')
        ->get();

    $selectedDataKI = null;

    if ($request->filled('data_ki_id')) {
        $selectedDataKI = $dataKI->firstWhere(
            'id',
            (int) $request->data_ki_id
        );
    }

    return view('input-perpustakaan-ki', compact(
        'dataKI',
        'selectedDataKI'
    ));
}





    
public function store(Request $request)
{
    $validated = $request->validate([
        'data_ki_id' => 'required|exists:data_ki,id',
        'nomor_hak' => 'required|string|max:255|unique:perpustakaan_ki,nomor_hak',
    ]);

    $ki = DataKi::where('status', 'terdaftar')
        ->findOrFail($validated['data_ki_id']);

    $sudahAda = PerpustakaanKi::where(
        'data_ki_id',
        $ki->id
    )->exists();

    if ($sudahAda) {
        return back()
            ->withInput()
            ->withErrors([
                'data_ki_id' => 'Data KI ini sudah ada di Perpustakaan KI.',
            ]);
    }

    PerpustakaanKi::create([
        'data_ki_id' => $ki->id,
        'nama_hak' => $ki->nama_ki,
        'nomor_hak' => $validated['nomor_hak'],
        'jenis_ki_id' => $ki->jenis_ki_id,
        'kabupaten_id' => $ki->kabupaten_id,
    ]);

    return redirect()
        ->route('perpustakaan-ki.index')
        ->with('success', 'Data berhasil ditambahkan ke Perpustakaan KI.');
}

}
