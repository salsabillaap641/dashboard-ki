<?php

namespace App\Http\Controllers;

use App\Models\DataKi;
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

        // Ambil tanggal rekap terbaru agar riwayat tidak dihitung berulang.
        $tanggalRekap = RekapKiHarian::max('tanggal_data');

        $rekapQuery = RekapKiHarian::query()
            ->when($tanggalRekap, function ($query) use ($tanggalRekap) {
                $query->whereDate('tanggal_data', $tanggalRekap);
            })
            ->whereIn('status', ['terdaftar', 'proses'])
            ->when($jenisKiId, function ($query) use ($jenisKiId) {
                $query->where('jenis_ki_id', $jenisKiId);
            })
            ->when($kabupatenId, function ($query) use ($kabupatenId) {
                $query->where('kabupaten_id', $kabupatenId);
            });

        // Jumlah KI diambil dari kolom jumlah, bukan menghitung baris.
        $terdaftar = (int) (clone $rekapQuery)
            ->where('status', 'terdaftar')
            ->sum('jumlah');

        $proses = (int) (clone $rekapQuery)
            ->where('status', 'proses')
            ->sum('jumlah');

        $totalKI = $terdaftar + $proses;

        // Potensi dihitung terpisah dari rekap.
        $potensiQuery = DataKi::query()
            ->where('status', 'potensi')
            ->when($jenisKiId, function ($query) use ($jenisKiId) {
                $query->where('jenis_ki_id', $jenisKiId);
            })
            ->when($kabupatenId, function ($query) use ($kabupatenId) {
                $query->where('kabupaten_id', $kabupatenId);
            });

        $potensi = (int) (clone $potensiQuery)->count();

        // Data kabupaten/kota untuk grafik.
        $kabupatenQuery = Kabupaten::query()
            ->orderBy('nama_kabupaten');

        if ($kabupatenId) {
            $kabupatenQuery->where('id', $kabupatenId);
        }

        $kabupaten = $kabupatenQuery->get();

        $rekapPerKabupaten = (clone $rekapQuery)
            ->select(
                'kabupaten_id',
                'status',
                DB::raw('SUM(jumlah) as total')
            )
            ->groupBy('kabupaten_id', 'status')
            ->get();

        $potensiPerKabupaten = (clone $potensiQuery)
            ->select(
                'kabupaten_id',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('kabupaten_id')
            ->pluck('total', 'kabupaten_id');

        foreach ($kabupaten as $kab) {
            $kab->total_terdaftar = (int) $rekapPerKabupaten
                ->where('kabupaten_id', $kab->id)
                ->where('status', 'terdaftar')
                ->sum('total');

            $kab->total_proses = (int) $rekapPerKabupaten
                ->where('kabupaten_id', $kab->id)
                ->where('status', 'proses')
                ->sum('total');

            $kab->total_potensi = (int) $potensiPerKabupaten
                ->get($kab->id, 0);

            $kab->total_semua =
                $kab->total_terdaftar + $kab->total_proses;
        }

        $chartLabels = $kabupaten->pluck('nama_kabupaten')->values();
        $chartTerdaftar = $kabupaten->pluck('total_terdaftar')->values();
        $chartProses = $kabupaten->pluck('total_proses')->values();
        $chartPotensi = $kabupaten->pluck('total_potensi')->values();

        $kabupatenTerbanyak = $kabupaten
            ->sortByDesc('total_semua')
            ->first();

        // Data untuk filter.
        $jenisKI = JenisKi::orderBy('nama_jenis')->get();
        $daftarKabupaten = Kabupaten::orderBy('nama_kabupaten')->get();

        // Variabel kompatibilitas untuk dashboard lama.
        $dataDetail = collect();
        $kiHariIni = null;
        $kiBulanIni = null;

        // Grafik jenis KI menggunakan rekap pada tanggal terbaru.
        
// Grafik jenis KI berdasarkan tanggal rekap terbaru.
$tanggalRekap = RekapKiHarian::max('tanggal_data');

$jumlahPerJenis = DB::table('jenis_ki')
    ->leftJoin('rekap_ki_harian', function ($join) use (
        $tanggalRekap,
        $kabupatenId
    ) {
        $join->on(
            'jenis_ki.id',
            '=',
            'rekap_ki_harian.jenis_ki_id'
        );

        if ($tanggalRekap) {
            $join->whereDate(
                'rekap_ki_harian.tanggal_data',
                $tanggalRekap
            );
        }

        $join->whereIn(
            'rekap_ki_harian.status',
            ['terdaftar', 'proses']
        );

        if ($kabupatenId) {
            $join->where(
                'rekap_ki_harian.kabupaten_id',
                $kabupatenId
            );
        }
    })
    ->when($jenisKiId, function ($query) use ($jenisKiId) {
        $query->where('jenis_ki.id', $jenisKiId);
    })
    ->select(
        'jenis_ki.id',
        'jenis_ki.nama_jenis',
        DB::raw(
            'COALESCE(SUM(rekap_ki_harian.jumlah), 0) as total'
        )
    )
    ->groupBy('jenis_ki.id', 'jenis_ki.nama_jenis')
    ->orderBy('jenis_ki.id')
    ->get();

        // Produk unggulan galeri.
        $produkUnggulan = collect();

        if (DB::getSchemaBuilder()->hasTable('galeri_ki')) {
            $produkUnggulan = DB::table('galeri_ki')
                ->leftJoin(
                    'jenis_ki',
                    'galeri_ki.jenis_ki_id',
                    '=',
                    'jenis_ki.id'
                )
                ->select(
                    'galeri_ki.id',
                    'galeri_ki.nama_produk',
                    'galeri_ki.caption',
                    'galeri_ki.foto',
                    'galeri_ki.nomor_permohonan',
                    'jenis_ki.nama_jenis'
                )
                ->where('galeri_ki.is_featured', true)
                ->orderByDesc('galeri_ki.id')
                ->limit(5)
                ->get();
        }
        // Daftar potensi KI yang sudah diinput dan berstatus potensi.
$potensiMenungguTelaah = DataKi::with('jenisKi')
    ->where('status', 'potensi')
    ->when($jenisKiId, function ($query) use ($jenisKiId) {
        $query->where('jenis_ki_id', $jenisKiId);
    })
    ->when($kabupatenId, function ($query) use ($kabupatenId) {
        $query->where('kabupaten_id', $kabupatenId);
    })
    ->latest('id')
    ->take(5)
    ->get();

        return view('dashboard', compact(
            'totalKI',
            'terdaftar',
            'proses',
            'potensi',
            'kabupaten',
            'jenisKI',
            'jenisKiId',
            'daftarKabupaten',
            'kabupatenId',
            'chartLabels',
            'chartTerdaftar',
            'chartProses',
            'chartPotensi',
            'dataDetail',
            'jumlahPerJenis',
            'produkUnggulan',
            'kabupatenTerbanyak',
            'kiHariIni',
            'kiBulanIni',
            'tanggalRekap',
            'potensiMenungguTelaah',
        ));
    }
}
