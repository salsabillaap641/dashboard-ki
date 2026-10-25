<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PerpustakaanKiDesainIndustriSeeder extends Seeder
{
    public function run(): void
    {
        $jenisKiId = DB::table('jenis_ki')->where('nama_jenis', 'Desain Industri')->value('id');
        if (!$jenisKiId) {
            throw new RuntimeException('Jenis KI "Desain Industri" tidak ditemukan pada tabel jenis_ki.');
        }

        $data = [
            ['nomor_permohonan' => "A00202604185", 'nama_hak' => "Busana Lamiang Geometris"],
            ['nomor_permohonan' => "A00202604183", 'nama_hak' => "Bros Mahkota Lamiang Tingang"],
            ['nomor_permohonan' => "A00202507159", 'nama_hak' => "TAS"],
            ['nomor_permohonan' => "A00202507156", 'nama_hak' => "Tas Jinjing"],
            ['nomor_permohonan' => "A00202506077", 'nama_hak' => "TAS"],
            ['nomor_permohonan' => "A00202503629", 'nama_hak' => "Tas Motif \"Jinjing Mini\""],
            ['nomor_permohonan' => "A00202503628", 'nama_hak' => "Tas Motif \"LINDA\""],
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
