<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kabupaten;
use Illuminate\Support\Collection;

class PotensiKiController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $kabupatenId = $request->query('kabupaten_id');

        // Potensi yang diinput langsung oleh Master ke tabel data_ki.
        $potensiMaster = DB::table('data_ki')
            ->join('kabupaten', 'data_ki.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('jenis_ki', 'data_ki.jenis_ki_id', '=', 'jenis_ki.id')
            ->where('data_ki.status', 'potensi')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('data_ki.nama_ki', 'like', "%{$search}%");
            })
            ->when($kabupatenId, function ($query) use ($kabupatenId) {
                $query->where('data_ki.kabupaten_id', $kabupatenId);
            })
            ->select(
                'data_ki.nama_ki',
                'kabupaten.nama_kabupaten',
                'jenis_ki.nama_jenis',
                'data_ki.tahun',
                DB::raw("'Data Master' as sumber")
            )
            ->get();

        // Pengajuan Kabupaten yang sudah diterima, tetapi belum ditautkan ke data_ki.
        // Pengajuan yang masih ditelaah/perlu perbaikan tidak ditampilkan ke publik.
        $potensiPengajuan = DB::table('pengajuan_ki')
            ->join('kabupaten', 'pengajuan_ki.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('jenis_ki', 'pengajuan_ki.jenis_ki_id', '=', 'jenis_ki.id')
            ->where('pengajuan_ki.status_pengajuan', 'diterima')
            ->whereNull('pengajuan_ki.data_ki_id')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('pengajuan_ki.nama_ki', 'like', "%{$search}%");
            })
            ->when($kabupatenId, function ($query) use ($kabupatenId) {
                $query->where('pengajuan_ki.kabupaten_id', $kabupatenId);
            })
            ->select(
                'pengajuan_ki.nama_ki',
                'kabupaten.nama_kabupaten',
                'jenis_ki.nama_jenis',
                'pengajuan_ki.tahun',
                DB::raw("'Pengajuan diterima' as sumber")
            )
            ->get();

        $potensi = $potensiMaster
            ->concat($potensiPengajuan)
            ->sortBy('nama_ki')
            ->values();

        $jumlahPotensi = $potensi->count();
        $daftarKabupaten = Kabupaten::orderBy('nama_kabupaten')->get();

        return view('potensi-ki', compact(
            'potensi', 'jumlahPotensi', 'daftarKabupaten', 'search', 'kabupatenId'
        ));
    }
}
