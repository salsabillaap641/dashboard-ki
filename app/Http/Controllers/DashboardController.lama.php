<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\JenisKi;
use App\Models\RekapKiHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jenisKiId = $request->input('jenis_ki_id');
        $kabupatenId = $request->input('kabupaten_id');
        // Dashboard memakai snapshot tanggal terbaru; data dari tanggal berbeda
        // tidak dijumlahkan agar tidak terjadi penghitungan ganda.
        $tanggalRekapTerbaru = RekapKiHarian::max('tanggal_data');
        $tahun = $tanggalRekapTerbaru
            ? (int) \Carbon\Carbon::parse($tanggalRekapTerbaru)->year
            : (int) $request->input('tahun', now()->year);

        $rekapQuery = RekapKiHarian::query()
            ->when($tanggalRekapTerbaru, fn ($query) => $query->whereDate('tanggal_data', $tanggalRekapTerbaru))
            ->whereIn('status', ['terdaftar', 'proses']);

        if ($jenisKiId) {
            $rekapQuery->where('jenis_ki_id', $jenisKiId);
        }
        if ($kabupatenId) {
            $rekapQuery->where('kabupaten_id', $kabupatenId);
        }

        $rekapGrouped = (clone $rekapQuery)
            ->select('kabupaten_id', 'status', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kabupaten_id', 'status')
            ->get();

        // Rekap jumlah KI per jenis untuk grafik dashboard.
        $rekapPerJenis = (clone $rekapQuery)
            ->select('jenis_ki_id', 'status', DB::raw('SUM(jumlah) as total'))
            ->groupBy('jenis_ki_id', 'status')
            ->get();

        $terdaftar = (int) $rekapGrouped->where('status', 'terdaftar')->sum('total');
        $proses = (int) $rekapGrouped->where('status', 'proses')->sum('total');
        $totalKI = $terdaftar + $proses;

        // Potensi ditampilkan terpisah, tidak masuk Total KI terverifikasi.
        // Pengajuan yang sudah terhubung ke data_ki tidak dihitung ulang.
        $pengajuanPotensiQuery = DB::table('pengajuan_ki')->whereNull('data_ki_id');
        if ($jenisKiId) $pengajuanPotensiQuery->where('jenis_ki_id', $jenisKiId);
        if ($kabupatenId) $pengajuanPotensiQuery->where('kabupaten_id', $kabupatenId);

        $dataPotensiQuery = DB::table('data_ki')->where('status', 'potensi');
        if ($jenisKiId) $dataPotensiQuery->where('jenis_ki_id', $jenisKiId);
        if ($kabupatenId) $dataPotensiQuery->where('kabupaten_id', $kabupatenId);

        $potensi = (int) (clone $pengajuanPotensiQuery)->count()
            + (int) (clone $dataPotensiQuery)->count();

        $daftarKabupatenQuery = Kabupaten::query()->orderBy('nama_kabupaten');
        if ($kabupatenId) $daftarKabupatenQuery->where('id', $kabupatenId);
        $kabupaten = $daftarKabupatenQuery->get();

        $potensiPengajuanPerKabupaten = (clone $pengajuanPotensiQuery)
            ->select('kabupaten_id', DB::raw('COUNT(*) as total'))
            ->groupBy('kabupaten_id')->pluck('total', 'kabupaten_id');
        $potensiMasterPerKabupaten = (clone $dataPotensiQuery)
            ->select('kabupaten_id', DB::raw('COUNT(*) as total'))
            ->groupBy('kabupaten_id')->pluck('total', 'kabupaten_id');

        foreach ($kabupaten as $kab) {
            $kab->total_terdaftar = (int) $rekapGrouped
                ->where('kabupaten_id', $kab->id)->where('status', 'terdaftar')->sum('total');
            $kab->total_proses = (int) $rekapGrouped
                ->where('kabupaten_id', $kab->id)->where('status', 'proses')->sum('total');
            $kab->total_potensi = (int) $potensiPengajuanPerKabupaten->get($kab->id, 0)
                + (int) $potensiMasterPerKabupaten->get($kab->id, 0);
            // Total per kabupaten hanya total terverifikasi.
            $kab->total_semua = $kab->total_terdaftar + $kab->total_proses;
        }

        $chartLabels = $kabupaten->pluck('nama_kabupaten')->values();
        $chartTerdaftar = $kabupaten->pluck('total_terdaftar')->values();
        $chartProses = $kabupaten->pluck('total_proses')->values();
        $chartPotensi = $kabupaten->pluck('total_potensi')->values();

        $kabupatenTerbanyak = $kabupaten->sortByDesc('total_semua')->first();
        $jenisKI = JenisKi::orderBy('nama_jenis')->get();
        foreach ($jenisKI as $jenis) {
            $jenis->total_terdaftar = (int) $rekapPerJenis
                ->where('jenis_ki_id', $jenis->id)
                ->where('status', 'terdaftar')
                ->sum('total');
            $jenis->total_proses = (int) $rekapPerJenis
                ->where('jenis_ki_id', $jenis->id)
                ->where('status', 'proses')
                ->sum('total');
            $jenis->total_terverifikasi = $jenis->total_terdaftar + $jenis->total_proses;
        }
        $daftarKabupaten = Kabupaten::orderBy('nama_kabupaten')->get();
        $kiHariIni = null;
        $kiBulanIni = null;

        return view('dashboard', compact(
            'totalKI', 'terdaftar', 'proses', 'potensi', 'kabupaten', 'jenisKI',
            'jenisKiId', 'daftarKabupaten', 'kabupatenId', 'tahun', 'chartLabels',
            'chartTerdaftar', 'chartProses', 'chartPotensi', 'kabupatenTerbanyak',
            'kiHariIni', 'kiBulanIni', 'tanggalRekapTerbaru'
        ));
    }
}
