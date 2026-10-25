<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PerpustakaanKiPatenSeeder extends Seeder
{
    public function run(): void
    {
        $jenisKiId = DB::table('jenis_ki')
            ->where('nama_jenis', 'Paten')
            ->value('id');

        if (!$jenisKiId) {
            throw new RuntimeException('Jenis KI "Paten" tidak ditemukan pada tabel jenis_ki.');
        }

        $data = [
            ['nomor_permohonan' => "S00202213831", 'nama_hak' => "METODE UNTUK MENINGKATKAN AKTIVITAS SPESIFIK ENZIM LAKASE ISOLAT JAMUR Earliella scrabrosa"],
            ['nomor_permohonan' => "S00202213757", 'nama_hak' => "ALAT PENDETEKSI KEBAKARAN MENGGUNAKAN SENSOR GAS DAN SENSOR SUHU BERBASIS MIKROKONTROLER"],
            ['nomor_permohonan' => "S00202206980", 'nama_hak' => "KINCIR AIR"],
            ['nomor_permohonan' => "S23202008783", 'nama_hak' => "Pompa Portable Tenaga Surya"],
            ['nomor_permohonan' => "S23202008622", 'nama_hak' => "METODE PEMURNIAN AIR KOMBINASI OKSIDATOR FERRAT DAN GELOMBANG ULTRASONIK"],
        ];

        DB::transaction(function () use ($data, $jenisKiId) {
            foreach ($data as $item) {
                DB::table('perpustakaan_ki')->updateOrInsert(
                    ['nomor_permohonan' => $item['nomor_permohonan']],
                    [
                        'nama_hak' => $item['nama_hak'],
                        'jenis_ki_id' => $jenisKiId,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        });
    }
}
