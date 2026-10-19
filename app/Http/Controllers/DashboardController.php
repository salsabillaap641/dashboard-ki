<?php

namespace App\Http\Controllers;

use App\Models\DataKi;
use App\Models\Kabupaten;
use App\Models\JenisKi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $jenisKiId = $request->jenis_ki_id;
    $kabupatenId = $request->kabupaten_id;


    // =========================
    // QUERY DATA KI
    // =========================

    $query = DataKi::query();

    if ($jenisKiId) {
        $query->where('jenis_ki_id', $jenisKiId);
    }

    if ($kabupatenId) {
        $query->where('kabupaten_id', $kabupatenId);
    }


    // =========================
    // KPI
    // =========================

    $totalKI = $query->count();

    $terdaftar = (clone $query)
        ->where('status', 'terdaftar')
        ->count();

    $proses = (clone $query)
        ->where('status', 'proses')
        ->count();

    $potensi = (clone $query)
        ->where('status', 'potensi')
        ->count();


    // =========================
    // DATA KABUPATEN
    // =========================

    $kabupaten = Kabupaten::with([
        'dataKi' => function ($query) use ($jenisKiId) {

            if ($jenisKiId) {
                $query->where(
                    'jenis_ki_id',
                    $jenisKiId
                );
            }

        }
    ])
    ->when($kabupatenId, function ($query) use ($kabupatenId) {

        $query->where(
            'id',
            $kabupatenId
        );

    })
    ->get();
$chartLabels = [];
$chartData = [];

foreach ($kabupaten as $kab) {

    $totalKabupaten = $kab->dataKi->count();

    $chartLabels[] = $kab->nama_kabupaten;

    $chartData[] = $totalKabupaten;
}
$chartLabels = [];
$chartTerdaftar = [];
$chartProses = [];
$chartPotensi = [];

foreach ($kabupaten as $kab) {

    $chartLabels[] = $kab->nama_kabupaten;

    $chartTerdaftar[] = $kab->dataKi
        ->where('status', 'terdaftar')
        ->count();

    $chartProses[] = $kab->dataKi
        ->where('status', 'proses')
        ->count();

    $chartPotensi[] = $kab->dataKi
        ->where('status', 'potensi')
        ->count();
}

    // =========================
    // FILTER
    // =========================

    $jenisKI = JenisKi::all();

    $daftarKabupaten = Kabupaten::all();
$dataDetail = DataKi::with([
    'jenisKi',
    'kabupaten'
])
->when($jenisKiId, function ($query) use ($jenisKiId) {

    $query->where('jenis_ki_id', $jenisKiId);

})
->when($kabupatenId, function ($query) use ($kabupatenId) {

    $query->where('kabupaten_id', $kabupatenId);

})
->orderBy('id', 'desc')
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
'dataDetail'
    ));
}
}