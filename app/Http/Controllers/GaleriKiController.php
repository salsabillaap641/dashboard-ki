<?php

namespace App\Http\Controllers;

use App\Models\GaleriKi;
use App\Models\JenisKi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriKiController extends Controller
{
    public function index()
    {
        $galeri = GaleriKi::with('jenisKi')
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->paginate(12);

        return view('galeri-ki.index', compact('galeri'));
    }

    public function create()
    {
        $jenisKI = JenisKi::orderBy('nama_jenis')->get();
        return view('galeri-ki.create', compact('jenisKI'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'jenis_ki_id' => ['required', 'exists:jenis_ki,id'],
            'nomor_permohonan' => ['nullable', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:2000'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['foto'] = $request->file('foto')->store('galeri-ki', 'public');
        $validated['is_featured'] = $request->boolean('is_featured');

        GaleriKi::create($validated);

        return redirect()->route('galeri-ki.index')->with('success', 'Produk KI berhasil ditambahkan ke galeri.');
    }

    public function edit(GaleriKi $galeriKi)
    {
        $jenisKI = JenisKi::orderBy('nama_jenis')->get();
        return view('galeri-ki.edit', compact('galeriKi', 'jenisKI'));
    }

    public function update(Request $request, GaleriKi $galeriKi)
    {
        $validated = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'jenis_ki_id' => ['required', 'exists:jenis_ki,id'],
            'nomor_permohonan' => ['nullable', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:2000'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            if ($galeriKi->foto) {
                Storage::disk('public')->delete($galeriKi->foto);
            }
            $validated['foto'] = $request->file('foto')->store('galeri-ki', 'public');
        } else {
            unset($validated['foto']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $galeriKi->update($validated);

        return redirect()->route('galeri-ki.index')->with('success', 'Produk KI berhasil diperbarui.');
    }

    public function destroy(GaleriKi $galeriKi)
    {
        if ($galeriKi->foto) {
            Storage::disk('public')->delete($galeriKi->foto);
        }

        $galeriKi->delete();

        return redirect()->route('galeri-ki.index')->with('success', 'Produk KI berhasil dihapus dari galeri.');
    }
}
