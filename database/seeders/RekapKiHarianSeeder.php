<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\JenisKi;
use App\Models\RekapKiHarian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class RekapKiHarianSeeder extends Seeder
{
    public function run(): void
    {
        // Tanggal sesuai permintaan: 23 Oktober 2026.
        $tanggalData = '2026-10-23';

        // Data dari lima Excel. Baris kabupaten/jenis yang berulang sudah dijumlahkan.
        // Semua dimasukkan sebagai status "terdaftar" sesuai instruksi pengguna.
        $data = [
            ['kabupaten' => 'Barito Selatan', 'jenis' => 'Hak Cipta', 'jumlah' => 30],
            ['kabupaten' => 'Barito Selatan', 'jenis' => 'Indikasi Geografis', 'jumlah' => 1],
            ['kabupaten' => 'Barito Timur', 'jenis' => 'Hak Cipta', 'jumlah' => 46],
            ['kabupaten' => 'Barito Timur', 'jenis' => 'Merek', 'jumlah' => 7],
            ['kabupaten' => 'Barito Utara', 'jenis' => 'Hak Cipta', 'jumlah' => 112],
            ['kabupaten' => 'Barito Utara', 'jenis' => 'Merek', 'jumlah' => 11],
            ['kabupaten' => 'Gunung Mas', 'jenis' => 'Hak Cipta', 'jumlah' => 15],
            ['kabupaten' => 'Gunung Mas', 'jenis' => 'Merek', 'jumlah' => 3],
            ['kabupaten' => 'Kapuas', 'jenis' => 'Hak Cipta', 'jumlah' => 83],
            ['kabupaten' => 'Kapuas', 'jenis' => 'Merek', 'jumlah' => 8],
            ['kabupaten' => 'Kapuas', 'jenis' => 'Paten', 'jumlah' => 1],
            ['kabupaten' => 'Katingan', 'jenis' => 'Hak Cipta', 'jumlah' => 35],
            ['kabupaten' => 'Katingan', 'jenis' => 'Merek', 'jumlah' => 4],
            ['kabupaten' => 'Kotawaringin Barat', 'jenis' => 'Hak Cipta', 'jumlah' => 62],
            ['kabupaten' => 'Kotawaringin Barat', 'jenis' => 'Merek', 'jumlah' => 40],
            ['kabupaten' => 'Kotawaringin Timur', 'jenis' => 'Hak Cipta', 'jumlah' => 127],
            ['kabupaten' => 'Kotawaringin Timur', 'jenis' => 'Merek', 'jumlah' => 23],
            ['kabupaten' => 'Lamandau', 'jenis' => 'Hak Cipta', 'jumlah' => 64],
            ['kabupaten' => 'Lamandau', 'jenis' => 'Merek', 'jumlah' => 4],
            ['kabupaten' => 'Murung Raya', 'jenis' => 'Hak Cipta', 'jumlah' => 26],
            ['kabupaten' => 'Murung Raya', 'jenis' => 'Merek', 'jumlah' => 5],
            ['kabupaten' => 'Palangka Raya', 'jenis' => 'Desain Industri', 'jumlah' => 2],
            ['kabupaten' => 'Palangka Raya', 'jenis' => 'Hak Cipta', 'jumlah' => 1097],
            ['kabupaten' => 'Palangka Raya', 'jenis' => 'Merek', 'jumlah' => 62],
            ['kabupaten' => 'Palangka Raya', 'jenis' => 'Paten', 'jumlah' => 6],
            ['kabupaten' => 'Pulang Pisau', 'jenis' => 'Hak Cipta', 'jumlah' => 33],
            ['kabupaten' => 'Pulang Pisau', 'jenis' => 'Merek', 'jumlah' => 5],
            ['kabupaten' => 'Seruyan', 'jenis' => 'Hak Cipta', 'jumlah' => 23],
            ['kabupaten' => 'Seruyan', 'jenis' => 'Merek', 'jumlah' => 3],
            ['kabupaten' => 'Sukamara', 'jenis' => 'Hak Cipta', 'jumlah' => 11]
        ];

        DB::transaction(function () use ($data, $tanggalData) {
            foreach ($data as $item) {
                $kabupaten = $this->cariKabupaten($item['kabupaten']);
                $jenisKi = $this->cariJenisKi($item['jenis']);

                RekapKiHarian::updateOrCreate(
                    [
                        'tanggal_data' => $tanggalData,
                        'kabupaten_id' => $kabupaten->id,
                        'jenis_ki_id' => $jenisKi->id,
                        'status' => 'terdaftar',
                    ],
                    ['jumlah' => $item['jumlah']]
                );
            }
        });
    }

    private function cariKabupaten(string $nama): Kabupaten
    {
        $aliases = [
            'Palangka Raya' => ['Palangka Raya', 'Palangkaraya', 'Kota Palangka Raya', 'Kota Palangkaraya'],
        ];

        foreach ($aliases[$nama] ?? [$nama] as $candidate) {
            $record = Kabupaten::query()
                ->whereRaw('LOWER(nama_kabupaten) = ?', [mb_strtolower($candidate)])
                ->first();

            if ($record) {
                return $record;
            }
        }

        throw new RuntimeException("Kabupaten/kota '{$nama}' tidak ditemukan di tabel kabupaten. Seeder dibatalkan; periksa nama wilayah di database.");
    }

    private function cariJenisKi(string $nama): JenisKi
    {
        $aliases = [
            'Merek' => ['Merek', 'Merk'],
            'Paten' => ['Paten'],
            'Desain Industri' => ['Desain Industri'],
            'Hak Cipta' => ['Hak Cipta', 'Cipta'],
            'Indikasi Geografis' => ['Indikasi Geografis', 'IG'],
        ];

        foreach ($aliases[$nama] ?? [$nama] as $candidate) {
            $record = JenisKi::query()
                ->whereRaw('LOWER(nama_jenis) = ?', [mb_strtolower($candidate)])
                ->first();

            if ($record) {
                return $record;
            }
        }

        throw new RuntimeException("Jenis KI '{$nama}' tidak ditemukan di tabel jenis_ki. Seeder dibatalkan; periksa nama jenis di database.");
    }
}
