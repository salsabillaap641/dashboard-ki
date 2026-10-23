<?php

namespace Database\Seeders;

use App\Models\SentraKi;
use Illuminate\Database\Seeder;

class SentraKiSeeder extends Seeder
{
    /**
     * Data Sentra KI dihimpun dari dokumen PDF yang diunggah.
     * updateOrCreate mencegah duplikasi jika seeder dijalankan ulang.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_sentra' => 'Sentra KI Akademi Kebidanan Betang Asi Raya',
                'alamat' => 'Kantor: Jl. Pangeran Samudera 3 No. 07; Gedung Perkuliahan: Jl. Pangeran Samudra No. 10.',
            ],
            [
                'nama_sentra' => 'Sentra KI Akademi Kebidanan Murung Raya',
                'alamat' => 'Jl. Bhayangkara, Desa Danau Usung, Kecamatan Murung, Kabupaten Murung Raya, Kalimantan Tengah 73911.',
            ],
            [
                'nama_sentra' => 'Sentra KI Institut Teknologi dan Sains Nahdlatul Ulama Kalimantan (ITSNUKA)',
                'alamat' => 'Jl. RTA Milono Km. 3,5, Kelurahan Langkai, Kecamatan Pahandut, Palangka Raya, Kalimantan Tengah 73111.',
            ],
            [
                'nama_sentra' => 'Sentra KI Politeknik Seruyan',
                'alamat' => 'Jl. A. Yani, Kecamatan Seruyan Hilir, Kabupaten Seruyan, Kalimantan Tengah 74215.',
            ],
            [
                'nama_sentra' => 'Sentra KI STIE Dahani Dahanai',
                'alamat' => 'Jl. Cut Nyak Dien No. 09 A, Buntok, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI STIE Muara Teweh',
                'alamat' => 'Jl. Berlian, Kelurahan Lanjas, Muara Teweh, Kalimantan Tengah 73811.',
            ],
            [
                'nama_sentra' => 'Sentra KI STIE Sampit',
                'alamat' => 'Jl. Walter Condrat, Kelurahan Baamang Hilir, Kecamatan Baamang, Sampit, Kabupaten Kotawaringin Timur, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI STIPAS Tahasak Danum Pambelum Keuskupan Palangkaraya',
                'alamat' => 'Palangka Raya, Kalimantan Tengah. Alamat jalan lengkap tidak terbaca/tercantum jelas pada dokumen yang diberikan.',
            ],
            [
                'nama_sentra' => 'Sentra KI Sekolah Tinggi Agama Islam (STAI) Kuala Kapuas',
                'alamat' => 'Jl. Tambun Bungai No. 56, Kuala Kapuas, Kalimantan Tengah 73514.',
            ],
            [
                'nama_sentra' => 'Sentra KI STIE YBPK Palangka Raya',
                'alamat' => 'Jl. Haji Ikap No. 17, Palangka Raya, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI STMIK Palangkaraya',
                'alamat' => 'Jl. G. Obos No. 114, Palangka Raya, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Darwan Ali',
                'alamat' => 'Jl. Batu Berlian No. 10, Sampit, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Eka Harap',
                'alamat' => 'Jl. Beliang No. 110, Palangka Raya, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Kristen Palangka Raya (UKPR)',
                'alamat' => 'Jl. RTA Milono Km. 8,5, Palangka Raya, Kalimantan Tengah 73111.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas PGRI Palangka Raya',
                'alamat' => 'Jl. Hiu Putih, Tjilik Riwut Km. 7, Palangka Raya, Kalimantan Tengah 73112.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Islam Negeri Palangka Raya',
                'alamat' => 'Palangka Raya, Kalimantan Tengah. Alamat jalan lengkap tidak terbaca jelas pada halaman dokumen yang tersedia.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Cahaya Bangsa',
                'alamat' => 'Alamat jalan lengkap tidak terbaca jelas pada dokumen yang diberikan.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Muhammadiyah Sampit',
                'alamat' => 'Kampus 1: Jl. Ki Hajar Dewantara No. 3, Sampit, Kalimantan Tengah; Kampus 2: Jl. Pramuka No. 100, Sampit, Kalimantan Tengah.',
            ],
            [
                'nama_sentra' => 'Sentra KI Sekolah Tinggi Ilmu Hukum Tambun Bungai Palangka Raya',
                'alamat' => 'Jl. Sisingamangaraja No. 35, Palangka Raya, Kalimantan Tengah 73112.',
            ],
            [
                'nama_sentra' => 'Sentra KI Sekolah Tinggi Ilmu Ekonomi Palangka Raya',
                'alamat' => 'Jl. Yos Sudarso No. 15, Palangka Raya, Kalimantan Tengah 73112.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Terbuka Palangka Raya',
                'alamat' => 'Jl. G. Obos Km. 3,5 No. 177, Palangka Raya, Kalimantan Tengah 73112.',
            ],
            [
                'nama_sentra' => 'Sentra KI Politeknik Bisnis LPP Quantum',
                'alamat' => 'Jl. Pramuka Km. 1,8 No. 99, Sampit, Kalimantan Tengah 74322.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Muhammadiyah Palangka Raya',
                'alamat' => 'Palangka Raya, Kalimantan Tengah. Alamat jalan lengkap tidak dicantumkan jelas pada dokumen SK yang diberikan.',
            ],
            [
                'nama_sentra' => 'Sentra KI Universitas Palangka Raya (UPR)',
                'alamat' => 'Kampus UPR Tunjung Nyaho, Jl. Yos Sudarso, Palangka Raya, Kalimantan Tengah 73111.',
            ],
        ];

        foreach ($data as $item) {
            SentraKi::updateOrCreate(
                ['nama_sentra' => $item['nama_sentra']],
                ['alamat' => $item['alamat']]
            );
        }
    }
}
