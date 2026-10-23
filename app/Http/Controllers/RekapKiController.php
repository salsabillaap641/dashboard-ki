<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\JenisKi;
use App\Models\RekapKiHarian;
use Illuminate\Http\Request;

class RekapKiController extends Controller
{
    public function index(Request $request)
    {
        $tanggalTerbaru = RekapKiHarian::max('tanggal_data');
        $tanggal = $request->input('tanggal', $tanggalTerbaru ?: now()->toDateString());

        $rekap = RekapKiHarian::with(['kabupaten', 'jenisKi'])
            ->whereDate('tanggal_data', $tanggal)
            ->orderBy('kabupaten_id')
            ->orderBy('jenis_ki_id')
            ->orderBy('status')
            ->get();

        $kabupaten = Kabupaten::orderBy('nama_kabupaten')->get();
        $jenisKi = JenisKi::orderBy('nama_jenis')->get();

        return view('rekap-ki.index', compact(
            'rekap', 'kabupaten', 'jenisKi', 'tanggal', 'tanggalTerbaru'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_data' => ['required', 'date'],
            'kabupaten_id' => ['required', 'integer', 'exists:kabupaten,id'],
            'jenis_ki_id' => ['required', 'integer', 'exists:jenis_ki,id'],
            'status' => ['required', 'in:terdaftar,proses'],
            'jumlah' => ['required', 'integer', 'min:0'],
        ]);

        RekapKiHarian::updateOrCreate(
            [
                'tanggal_data' => $validated['tanggal_data'],
                'kabupaten_id' => $validated['kabupaten_id'],
                'jenis_ki_id' => $validated['jenis_ki_id'],
                'status' => $validated['status'],
            ],
            ['jumlah' => $validated['jumlah']]
        );

        return redirect()
            ->route('rekap-ki.index', ['tanggal' => $validated['tanggal_data']])
            ->with('success', 'Rekap KI berhasil disimpan. Jika kombinasi data dan tanggal sama sudah ada, jumlahnya diperbarui; tanggal sebelumnya tetap tersimpan sebagai riwayat.');
    }
}
