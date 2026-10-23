<?php

namespace App\Http\Controllers;

use App\Models\SentraKi;
use Illuminate\Http\Request;

class SentraKiController extends Controller
{
    // Halaman ini dapat dilihat publik, termasuk pengguna Kabupaten.
    public function index()
    {
        $sentra = SentraKi::query()
            ->orderBy('nama_sentra')
            ->paginate(12);

        return view('sentra-ki.index', compact('sentra'));
    }

    // Fungsi berikut hanya diakses melalui route khusus Master.
    public function create()
    {
        return view('sentra-ki.form', ['sentra' => new SentraKi()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sentra' => 'required|string|max:255',
            'alamat' => 'required|string|max:5000',
        ]);

        SentraKi::create($validated);

        return redirect()->route('sentra-ki.index')
            ->with('success', 'Sentra KI berhasil ditambahkan.');
    }

    public function edit(SentraKi $sentraKi)
    {
        return view('sentra-ki.form', ['sentra' => $sentraKi]);
    }

    public function update(Request $request, SentraKi $sentraKi)
    {
        $validated = $request->validate([
            'nama_sentra' => 'required|string|max:255',
            'alamat' => 'required|string|max:5000',
        ]);

        $sentraKi->update($validated);

        return redirect()->route('sentra-ki.index')
            ->with('success', 'Data Sentra KI berhasil diperbarui.');
    }

    public function destroy(SentraKi $sentraKi)
    {
        $sentraKi->delete();

        return redirect()->route('sentra-ki.index')
            ->with('success', 'Data Sentra KI berhasil dihapus.');
    }
}
