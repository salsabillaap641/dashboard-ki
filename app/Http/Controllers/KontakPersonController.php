<?php

namespace App\Http\Controllers;

use App\Models\KontakPerson;
use Illuminate\Http\Request;

class KontakPersonController extends Controller
{
    /**
     * Halaman ini bisa dibuka publik, termasuk pengguna yang belum login.
     */
    public function index()
    {
        $kontak = KontakPerson::first();

        return view('kontak-person', compact('kontak'));
    }

    /**
     * Form edit hanya dapat diakses Master melalui route middleware role:master.
     */
    public function edit()
    {
        $kontak = KontakPerson::first();

        if (!$kontak) {
            $kontak = KontakPerson::create([
                'alamat' => '',
                'nomor_admin' => '',
                'email' => null,
                'jam_layanan' => null,
            ]);
        }

        return view('edit-kontak-person', compact('kontak'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'alamat' => ['required', 'string', 'max:2000'],
            'nomor_admin' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'jam_layanan' => ['nullable', 'string', 'max:255'],
        ]);

        $kontak = KontakPerson::first();

        if ($kontak) {
            $kontak->update($validated);
        } else {
            KontakPerson::create($validated);
        }

        return redirect()
            ->route('kontak-person.index')
            ->with('success', 'Informasi kontak Kanwil berhasil diperbarui.');
    }
}
