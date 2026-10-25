<?php
namespace App\Http\Controllers;
use App\Models\PerpustakaanKi;
use App\Models\JenisKi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PerpustakaanKiController extends Controller
{
    
public function index(Request $request)
{
    $query = PerpustakaanKi::query();

    // Pencarian nama HAKI atau nomor permohonan
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nama_hak', 'like', "%{$search}%")
              ->orWhere('nomor_permohonan', 'like', "%{$search}%");
        });
    }

    // Filter berdasarkan jenis KI
    if ($request->filled('jenis_ki_id')) {
        $query->where('jenis_ki_id', $request->jenis_ki_id);
    }

    // Ambil daftar jenis KI untuk dropdown filter
    $jenisKi = DB::table('jenis_ki')
        ->orderBy('nama_jenis')
        ->get();

    // Ambil data perpustakaan beserta pagination
    $dataPerpustakaan = $query
        ->orderByDesc('id')
        ->paginate(10)
        ->withQueryString();

    return view(
        'perpustakaan-ki',
        compact('dataPerpustakaan', 'jenisKi')
    );
}


    public function create()
    {
        $jenisKi = JenisKi::orderBy('nama_jenis')->get();

        return view('input-perpustakaan-ki', compact('jenisKi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hak' => 'required|string|max:65535',
            'nomor_permohonan' => 'required|string|max:255|unique:perpustakaan_ki,nomor_permohonan',
            'jenis_ki_id' => 'required|exists:jenis_ki,id',
        ]);
        PerpustakaanKi::create($validated);
        return redirect()->route('perpustakaan-ki.index')->with('success', 'Data berhasil ditambahkan ke Perpustakaan KI.');
    }

    public function edit($id)
    {
        $perpustakaanKi = PerpustakaanKi::findOrFail($id);
        return view('edit-perpustakaan-ki', compact('perpustakaanKi'));
    }

    public function update(Request $request, $id)
    {
        $perpustakaanKi = PerpustakaanKi::findOrFail($id);
        $validated = $request->validate([
            'nama_hak' => 'required|string|max:255',
            'nomor_permohonan' => ['required','string','max:255',Rule::unique('perpustakaan_ki','nomor_permohonan')->ignore($perpustakaanKi->id)],
        ]);
        $perpustakaanKi->update($validated);
        return redirect()->route('perpustakaan-ki.index')->with('success', 'Data Perpustakaan KI berhasil diperbarui.');
    }

    public function destroy($id)
    {
        PerpustakaanKi::findOrFail($id)->delete();
        return redirect()->route('perpustakaan-ki.index')->with('success', 'Data berhasil dihapus dari Perpustakaan KI.');
    }

    public function show($id)
    {
        $item = PerpustakaanKi::findOrFail($id);
        return view('detail-perpustakaan-ki', compact('item'));
    }
}
