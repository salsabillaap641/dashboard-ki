<?php

namespace Database\Seeders;

use App\Models\JenisKi;
use App\Models\Kabupaten;
use App\Models\PerpustakaanKi;
use Illuminate\Database\Seeder;
use RuntimeException;

class PerpustakaanMerekSeeder extends Seeder
{
    public function run(): void
    {
        // Semua baris dari dokumen sumber dimasukkan apa adanya, termasuk nama yang berulang.
        $dataMerek = json_decode(<<<'JSON'
[
    {
        "nama_hak": "UMIFIKA",
        "nomor_hak": "820261020562239"
    },
    {
        "nama_hak": "Gaya Tanpa Batas Usia",
        "nomor_hak": "820261004149423"
    },
    {
        "nama_hak": "KENZI SNACK",
        "nomor_hak": "820260925842293"
    },
    {
        "nama_hak": "AHZA KNIFE",
        "nomor_hak": "820260925842429"
    },
    {
        "nama_hak": "WARUNG ECA",
        "nomor_hak": "820260925842614"
    },
    {
        "nama_hak": "DF",
        "nomor_hak": "820260925841555"
    },
    {
        "nama_hak": "MS. COLLECTION",
        "nomor_hak": "820260904328264"
    },
    {
        "nama_hak": "PANCA NATURE",
        "nomor_hak": "820260831568117"
    },
    {
        "nama_hak": "UEIIKARUHEI + LOGO UK",
        "nomor_hak": "820260831567373"
    },
    {
        "nama_hak": "ARSY SNACK",
        "nomor_hak": "820260831567545"
    },
    {
        "nama_hak": "AZ-ZAHRA",
        "nomor_hak": "820260831566979"
    },
    {
        "nama_hak": "CHI-CHI BORNEO",
        "nomor_hak": "820260805758018"
    },
    {
        "nama_hak": "KOPKEL MERAH PUTIH KKMP BUKIT TUNGGAL KEC. JEKAN RAYA",
        "nomor_hak": "820260730907417"
    },
    {
        "nama_hak": "Semat Scarves",
        "nomor_hak": "820260709638550"
    },
    {
        "nama_hak": "Central Kalimantan Choreographer Meeting (CKCM)",
        "nomor_hak": "820260701350203"
    },
    {
        "nama_hak": "Titik Kumpul Ruang Karya dan Cerita IKM Kalteng",
        "nomor_hak": "820260701251226"
    },
    {
        "nama_hak": "KOPKEL MERAH PUTIH KKMP Lanjas + Gambar/Lukisan",
        "nomor_hak": "820260628747430"
    },
    {
        "nama_hak": "KDMP LAMPEONG I",
        "nomor_hak": "820260627698093"
    },
    {
        "nama_hak": "\"BANGKIT BERKAH\" KDMP BUKIT INDAH",
        "nomor_hak": "820260620622079"
    },
    {
        "nama_hak": "Putra Putri Budaya Kalimantan Tengah",
        "nomor_hak": "820260610001867"
    },
    {
        "nama_hak": "BINTANG NINGGI II MEKAR BERSAMA",
        "nomor_hak": "820260601583544"
    },
    {
        "nama_hak": "BAITUL ILMI + LOGO",
        "nomor_hak": "820260531538503"
    },
    {
        "nama_hak": "SRI TAMBUN",
        "nomor_hak": "820260505144904"
    },
    {
        "nama_hak": "KREASI PASTIKA",
        "nomor_hak": "820260502635756"
    },
    {
        "nama_hak": "RUMAH KELAKAI FLAMBOYAN 108",
        "nomor_hak": "820260502623964"
    },
    {
        "nama_hak": "KPOP PТ КЕКAL JAYA PLASTIK + Gambar/Logo",
        "nomor_hak": "820260422155877"
    },
    {
        "nama_hak": "AW",
        "nomor_hak": "820260317798057"
    },
    {
        "nama_hak": "AMANG JALI",
        "nomor_hak": "820260223809878"
    },
    {
        "nama_hak": "Happy Days",
        "nomor_hak": "820260219215424"
    },
    {
        "nama_hak": "INDARISUCI",
        "nomor_hak": "820260217961497"
    },
    {
        "nama_hak": "99C",
        "nomor_hak": "820260208841564"
    },
    {
        "nama_hak": "HASI (HAKUMPUL SELI)",
        "nomor_hak": "820260128309799"
    },
    {
        "nama_hak": "MONENG GALERI",
        "nomor_hak": "820260128238978"
    },
    {
        "nama_hak": "B42J",
        "nomor_hak": "820260125715582"
    },
    {
        "nama_hak": "KOSEPAT",
        "nomor_hak": "820260122317112"
    },
    {
        "nama_hak": "GARUMA + LOGO KUCING",
        "nomor_hak": "820260121207565"
    },
    {
        "nama_hak": "CA Product",
        "nomor_hak": "820260120884814"
    },
    {
        "nama_hak": "HOME MADE AL AMIN",
        "nomor_hak": "820260110416833"
    },
    {
        "nama_hak": "BALEMBA",
        "nomor_hak": "820251225469764"
    },
    {
        "nama_hak": "PALAPAS EPAT BY SMKN 4 BUSANA",
        "nomor_hak": "820251223144801"
    },
    {
        "nama_hak": "MAK GW",
        "nomor_hak": "820251218485037"
    },
    {
        "nama_hak": "DINIE COLLECTION",
        "nomor_hak": "820251218481031"
    },
    {
        "nama_hak": "BINTANG JAYA ITAH",
        "nomor_hak": "820251218481449"
    },
    {
        "nama_hak": "MELA BAHALAP",
        "nomor_hak": "820251218483099"
    },
    {
        "nama_hak": "DAPOER MBULL",
        "nomor_hak": "820251218483752"
    },
    {
        "nama_hak": "AQUATOP",
        "nomor_hak": "820251218481316"
    },
    {
        "nama_hak": "NEZA",
        "nomor_hak": "820251218484566"
    },
    {
        "nama_hak": "PUTERA PERDANA (PP)",
        "nomor_hak": "820251218480641"
    },
    {
        "nama_hak": "CINDAGIFT",
        "nomor_hak": "820251218482590"
    },
    {
        "nama_hak": "CALINTS",
        "nomor_hak": "820251218482806"
    },
    {
        "nama_hak": "CAMILAN ACIL MILA",
        "nomor_hak": "820251218484134"
    },
    {
        "nama_hak": "NADIA.R",
        "nomor_hak": "820251218481794"
    },
    {
        "nama_hak": "MBA ALIF Rasa Asli Kriuk pasti + Logo",
        "nomor_hak": "820251218484393"
    },
    {
        "nama_hak": "FASTIK",
        "nomor_hak": "820251218484467"
    },
    {
        "nama_hak": "ESTER SOY Susu Sehat Murni Susu Kedelai SSM + Gambar",
        "nomor_hak": "820251218480234"
    },
    {
        "nama_hak": "AMIRA FOOD & SNACK",
        "nomor_hak": "820251218483241"
    },
    {
        "nama_hak": "GEGE COOKING",
        "nomor_hak": "820251218481700"
    },
    {
        "nama_hak": "ACIL ITUN",
        "nomor_hak": "820251218480567"
    },
    {
        "nama_hak": "KHAIRIYAH RIZKI",
        "nomor_hak": "820251218480465"
    },
    {
        "nama_hak": "NAUFAL COLLECTION PKY EVERY MOTIF IS A STORY",
        "nomor_hak": "820251218483599"
    },
    {
        "nama_hak": "KAPAKAT ITAH",
        "nomor_hak": "820251211549378"
    },
    {
        "nama_hak": "KAPAKAT ITAH",
        "nomor_hak": "820251211548722"
    },
    {
        "nama_hak": "KAPAKAT ITAH + LOGO",
        "nomor_hak": "820251211548599"
    },
    {
        "nama_hak": "“KOPERASI KELURAHAN MERAH PUTIH JELAPAT”",
        "nomor_hak": "820251203328833"
    },
    {
        "nama_hak": "LABUTINA NOODLE",
        "nomor_hak": "820251111161723"
    },
    {
        "nama_hak": "Papioo",
        "nomor_hak": "820251107779242"
    },
    {
        "nama_hak": "Mangat.Ind",
        "nomor_hak": "820251104186961"
    },
    {
        "nama_hak": "TR COLLECTION",
        "nomor_hak": "820251103078323"
    },
    {
        "nama_hak": "NAM CRAFT HANDMADE (NCH)",
        "nomor_hak": "820251027037089"
    },
    {
        "nama_hak": "UDK Usaha Dare Karuhei",
        "nomor_hak": "820251027035285"
    },
    {
        "nama_hak": "A2 COLLECTION",
        "nomor_hak": "820251022362885"
    },
    {
        "nama_hak": "TEKO BANTUL",
        "nomor_hak": "820250924484962"
    },
    {
        "nama_hak": "JBD",
        "nomor_hak": "820250917398821"
    },
    {
        "nama_hak": "JAWET SAMA AREP",
        "nomor_hak": "820250917400048"
    },
    {
        "nama_hak": "UWEI PAMBELOM",
        "nomor_hak": "820250917398974"
    },
    {
        "nama_hak": "SOPIAH",
        "nomor_hak": "820250905710354"
    },
    {
        "nama_hak": "TAHU BAKSO IJJO",
        "nomor_hak": "820250904579802"
    },
    {
        "nama_hak": "Lamiang Tambi Pky",
        "nomor_hak": "820250808552709"
    },
    {
        "nama_hak": "SOZA",
        "nomor_hak": "820250714251434"
    },
    {
        "nama_hak": "DANUM MAHASUR",
        "nomor_hak": "820250701317164"
    },
    {
        "nama_hak": "Ikon Pulang Pisau Mandau",
        "nomor_hak": "820250619651363"
    },
    {
        "nama_hak": "TOKOKOPINAKI",
        "nomor_hak": "820250616005966"
    },
    {
        "nama_hak": "IKHIAAAE",
        "nomor_hak": "820250616992400"
    },
    {
        "nama_hak": "ISA PUTUT BATUAH",
        "nomor_hak": "820250610030683"
    },
    {
        "nama_hak": "NORBISA + LOGO",
        "nomor_hak": "820250602213417"
    },
    {
        "nama_hak": "ESAH KITCHEN + LOGO EK",
        "nomor_hak": "820250602213139"
    },
    {
        "nama_hak": "AG COLLECTION",
        "nomor_hak": "820250526288912"
    },
    {
        "nama_hak": "Tepung Ikan Gabus Kalimantan",
        "nomor_hak": "820250521500544"
    },
    {
        "nama_hak": "BORNEO JOK Interior Car Leather Specialis + LOGO",
        "nomor_hak": "820250521514151"
    },
    {
        "nama_hak": "ai tea (Teh Hitam Karamunting) Karamunting Black Tea + Lukisan",
        "nomor_hak": "820250517965254"
    },
    {
        "nama_hak": "KLINTING",
        "nomor_hak": "820250514519222"
    },
    {
        "nama_hak": "KLINIK ORCHID NUSANTARA",
        "nomor_hak": "820250226527761"
    },
    {
        "nama_hak": "1945",
        "nomor_hak": "820250206744407"
    }
]
JSON, true, 512, JSON_THROW_ON_ERROR);

        $jenisMerek = JenisKi::whereRaw('LOWER(nama_jenis) LIKE ?', ['%merek%'])->first();
        if (!$jenisMerek) {
            throw new RuntimeException("Jenis KI 'Merek' tidak ditemukan di tabel jenis_ki.");
        }

        // Kabupaten sementara diisi Palangka Raya. Ubah menjadi null jika kolom kabupaten_id nullable.
        $palangkaRaya = Kabupaten::whereRaw('LOWER(nama_kabupaten) LIKE ?', ['%palangka raya%'])->first();
        if (!$palangkaRaya) {
            throw new RuntimeException("Kabupaten/Kota Palangka Raya tidak ditemukan di tabel kabupaten.");
        }

        foreach ($dataMerek as $item) {
            // Idempotent: menjalankan seeder ulang tidak menggandakan nomor hak yang sama.
            // Baris berbeda tetap dipertahankan, tidak digabung berdasarkan nama.
            PerpustakaanKi::firstOrCreate(
                ['nomor_hak' => $item['nomor_hak']],
                [
                    'data_ki_id' => null,
                    'nama_hak' => $item['nama_hak'],
                    'jenis_ki_id' => $jenisMerek->id,
                    'kabupaten_id' => $palangkaRaya->id,
                ]
            );
        }
    }
}
