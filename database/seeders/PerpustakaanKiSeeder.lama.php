<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerpustakaanKiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_hak' => 'UMIFIKA', 'nomor_permohonan' => 'DID2026111293'],
            ['nama_hak' => 'Gaya Tanpa Batas Usia', 'nomor_permohonan' => 'DID2026104904'],
            ['nama_hak' => 'KENZI SNACK', 'nomor_permohonan' => 'DID2026101875'],
            ['nama_hak' => 'AHZA KNIFE', 'nomor_permohonan' => 'DID2026101872'],
            ['nama_hak' => 'WARUNG ECA', 'nomor_permohonan' => 'DID2026101873'],
            ['nama_hak' => 'DF', 'nomor_permohonan' => 'DID2026101869'],
            ['nama_hak' => 'MS. COLLECTION', 'nomor_permohonan' => 'JID2026093490'],
            ['nama_hak' => 'PANCA NATURE', 'nomor_permohonan' => 'DID2026091352'],
            ['nama_hak' => 'UEIIKARUHEI + LOGO UK', 'nomor_permohonan' => 'DID2026091348'],
            ['nama_hak' => 'ARSY SNACK', 'nomor_permohonan' => 'DID2026091350'],
            ['nama_hak' => 'AZ-ZAHRA', 'nomor_permohonan' => 'DID2026091345'],
            ['nama_hak' => 'CHI-CHI BORNEO', 'nomor_permohonan' => 'DID2026083264'],
            ['nama_hak' => 'KOPKEL MERAH PUTIH KKMP BUKIT TUNGGAL KEC. JEKAN RAYA', 'nomor_permohonan' => 'KID2026078771'],
            ['nama_hak' => 'Semat Scarves', 'nomor_permohonan' => 'DID2026067517'],
            ['nama_hak' => 'Central Kalimantan Choreographer Meeting (CKCM)', 'nomor_permohonan' => 'JID2026064121'],
            ['nama_hak' => 'Titik Kumpul Ruang Karya dan Cerita IKM Kalteng', 'nomor_permohonan' => 'DID2026063816'],
            ['nama_hak' => 'KOPKEL MERAH PUTIH KKMP Lanjas + Gambar/Lukisan', 'nomor_permohonan' => 'KID2026062503'],
            ['nama_hak' => 'KDMP LAMPEONG I', 'nomor_permohonan' => 'KID2026062455'],
            ['nama_hak' => '"BANGKIT BERKAH" KDMP BUKIT INDAH', 'nomor_permohonan' => 'KID2026059646'],
            ['nama_hak' => 'Putra Putri Budaya Kalimantan Tengah', 'nomor_permohonan' => 'JID2026055206'],
            ['nama_hak' => 'BINTANG NINGGI II MEKAR BERSAMA', 'nomor_permohonan' => 'DID2026051623'],
            ['nama_hak' => 'BAITUL ILMI + LOGO', 'nomor_permohonan' => 'DID2026051517'],
            ['nama_hak' => 'SRI TAMBUN', 'nomor_permohonan' => 'DID2026041637'],
            ['nama_hak' => 'KREASI PASTIKA', 'nomor_permohonan' => 'JID2026040501'],
            ['nama_hak' => 'RUMAH KELAKAI FLAMBOYAN 108', 'nomor_permohonan' => 'DID2026040450'],
            ['nama_hak' => 'KPOP PТ КЕКAL JAYA PLASTIK + Gambar/Logo', 'nomor_permohonan' => 'DID2026036145'],
            ['nama_hak' => 'AW', 'nomor_permohonan' => 'DID2026026011'],
            ['nama_hak' => 'AMANG JALI', 'nomor_permohonan' => 'JID2026018139'],
            ['nama_hak' => 'Happy Days', 'nomor_permohonan' => 'DID2026017065'],
            ['nama_hak' => 'INDARISUCI', 'nomor_permohonan' => 'DID2026016327'],
            ['nama_hak' => '99C', 'nomor_permohonan' => 'JID2026013240'],
            ['nama_hak' => 'HASI (HAKUMPUL SELI)', 'nomor_permohonan' => 'JID2026009004'],
            ['nama_hak' => 'MONENG GALERI', 'nomor_permohonan' => 'JID2026008837'],
            ['nama_hak' => 'B42J', 'nomor_permohonan' => 'DID2026007764'],
            ['nama_hak' => 'KOSEPAT', 'nomor_permohonan' => 'DID2026006945'],
            ['nama_hak' => 'GARUMA + LOGO KUCING', 'nomor_permohonan' => 'DID2026006554'],
            ['nama_hak' => 'CA Product', 'nomor_permohonan' => 'DID2026005579'],
            ['nama_hak' => 'HOME MADE AL AMIN', 'nomor_permohonan' => 'DID2026002679'],
            ['nama_hak' => 'BALEMBA', 'nomor_permohonan' => 'DID2025143412'],
            ['nama_hak' => 'PALAPAS EPAT BY SMKN 4 BUSANA', 'nomor_permohonan' => 'DID2025142051'],
            ['nama_hak' => 'MAK GW', 'nomor_permohonan' => 'DID2025139885'],
            ['nama_hak' => 'DINIE COLLECTION', 'nomor_permohonan' => 'JID2025139883'],
            ['nama_hak' => 'BINTANG JAYA ITAH', 'nomor_permohonan' => 'DID2025139882'],
            ['nama_hak' => 'MELA BAHALAP', 'nomor_permohonan' => 'DID2025139886'],
            ['nama_hak' => 'DAPOER MBULL', 'nomor_permohonan' => 'DID2025139881'],
            ['nama_hak' => 'AQUATOP', 'nomor_permohonan' => 'JID2025139879'],
            ['nama_hak' => 'NEZA', 'nomor_permohonan' => 'DID2025139878'],
            ['nama_hak' => 'PUTERA PERDANA (PP)', 'nomor_permohonan' => 'DID2025139870'],
            ['nama_hak' => 'CINDAGIFT', 'nomor_permohonan' => 'DID2025139872'],
            ['nama_hak' => 'CALINTS', 'nomor_permohonan' => 'DID2025139874'],
            ['nama_hak' => 'CAMILAN ACIL MILA', 'nomor_permohonan' => 'DID2025139875'],
            ['nama_hak' => 'NADIA.R', 'nomor_permohonan' => 'DID2025139873'],
            ['nama_hak' => 'MBA ALIF Rasa Asli Kriuk pasti + Logo', 'nomor_permohonan' => 'DID2025139866'],
            ['nama_hak' => 'FASTIK', 'nomor_permohonan' => 'DID2025139871'],
            ['nama_hak' => 'ESTER SOY Susu Sehat Murni Susu Kedelai SSM + Gambar', 'nomor_permohonan' => 'DID2025139877'],
            ['nama_hak' => 'AMIRA FOOD & SNACK', 'nomor_permohonan' => 'DID2025139864'],
            ['nama_hak' => 'GEGE COOKING', 'nomor_permohonan' => 'JID2025139865'],
            ['nama_hak' => 'ACIL ITUN', 'nomor_permohonan' => 'DID2025139867'],
            ['nama_hak' => 'KHAIRIYAH RIZKI', 'nomor_permohonan' => 'DID2025139869'],
            ['nama_hak' => 'NAUFAL COLLECTION PKY EVERY MOTIF IS A STORY', 'nomor_permohonan' => 'DID2025139880'],
            ['nama_hak' => 'KAPAKAT ITAH', 'nomor_permohonan' => 'KID2025136864'],
            ['nama_hak' => 'KAPAKAT ITAH', 'nomor_permohonan' => 'KID2025136863'],
            ['nama_hak' => 'KAPAKAT ITAH + LOGO', 'nomor_permohonan' => 'KID2025136859'],
            ['nama_hak' => '“KOPERASI KELURAHAN MERAH PUTIH JELAPAT”', 'nomor_permohonan' => 'KID2025132186'],
            ['nama_hak' => 'LABUTINA NOODLE', 'nomor_permohonan' => 'DID2025120153'],
            ['nama_hak' => 'Papioo', 'nomor_permohonan' => 'DID2025119157'],
            ['nama_hak' => 'Mangat.Ind', 'nomor_permohonan' => 'DID2025116835'],
            ['nama_hak' => 'TR COLLECTION', 'nomor_permohonan' => 'DID2025116599'],
            ['nama_hak' => 'NAM CRAFT HANDMADE (NCH)', 'nomor_permohonan' => 'DID2025113502'],
            ['nama_hak' => 'UDK Usaha Dare Karuhei', 'nomor_permohonan' => 'DID2025113133'],
            ['nama_hak' => 'A2 COLLECTION', 'nomor_permohonan' => 'DID2025111023'],
            ['nama_hak' => 'TEKO BANTUL', 'nomor_permohonan' => 'DID2025099386'],
            ['nama_hak' => 'JBD', 'nomor_permohonan' => 'KID2025095868'],
            ['nama_hak' => 'JAWET SAMA AREP', 'nomor_permohonan' => 'DID2025095865'],
            ['nama_hak' => 'UWEI PAMBELOM', 'nomor_permohonan' => 'KID2025095864'],
            ['nama_hak' => 'SOPIAH', 'nomor_permohonan' => 'DID2025091150'],
            ['nama_hak' => 'TAHU BAKSO IJJO', 'nomor_permohonan' => 'DID2025090682'],
            ['nama_hak' => 'Lamiang Tambi Pky', 'nomor_permohonan' => 'DID2025079639'],
            ['nama_hak' => 'SOZA', 'nomor_permohonan' => 'DID2025067359'],
            ['nama_hak' => 'DANUM MAHASUR', 'nomor_permohonan' => 'DID2025061957'],
            ['nama_hak' => 'Ikon Pulang Pisau Mandau', 'nomor_permohonan' => 'JID2025057296'],
            ['nama_hak' => 'TOKOKOPINAKI', 'nomor_permohonan' => 'JID2025054884'],
            ['nama_hak' => 'IKHIAAAE', 'nomor_permohonan' => 'DID2025054860'],
            ['nama_hak' => 'ISA PUTUT BATUAH', 'nomor_permohonan' => 'DID2025051915'],
            ['nama_hak' => 'NORBISA + LOGO', 'nomor_permohonan' => 'DID2025049555'],
            ['nama_hak' => 'ESAH KITCHEN + LOGO EK', 'nomor_permohonan' => 'JID2025049553'],
            ['nama_hak' => 'AG COLLECTION', 'nomor_permohonan' => 'DID2025046868'],
            ['nama_hak' => 'Tepung Ikan Gabus Kalimantan', 'nomor_permohonan' => 'DID2025044831'],
            ['nama_hak' => 'BORNEO JOK Interior Car Leather Specialis + LOGO', 'nomor_permohonan' => 'JID2025044900'],
            ['nama_hak' => 'ai tea (Teh Hitam Karamunting) Karamunting Black Tea + Lukisan', 'nomor_permohonan' => 'DID2025043485'],
            ['nama_hak' => 'KLINTING', 'nomor_permohonan' => 'JID2025042102'],
            ['nama_hak' => 'KLINIK ORCHID NUSANTARA', 'nomor_permohonan' => 'JID2025017731'],
            ['nama_hak' => '1945', 'nomor_permohonan' => 'DID2025010608'],
        ];

        DB::transaction(function () use ($data) {
            // Seeder ini hanya menambahkan data; tidak mengosongkan atau menghapus tabel.
            DB::table('perpustakaan_ki')->insert(
                array_map(function ($item) {
                    return $item + [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $data)
            );
        });
    }
}
