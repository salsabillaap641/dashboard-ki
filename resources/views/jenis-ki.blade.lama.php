
@extends('layouts.app')

@section('content')
<style>
    .ki-page {
        color: #344568;
        font-family: Arial, sans-serif;
    }

    .ki-banner {
        min-height: 190px;
        padding: 22px 38px;
        margin-bottom: 0;
        background: linear-gradient(120deg, #f7f7f7, #ffffff);
        border-top: 3px solid #ffc928;
        position: relative;
        overflow: hidden;
    }

    .ki-banner h1 {
        color: #191919;
        font-size: clamp(26px, 4vw, 42px);
        font-weight: 800;
        margin: 0 0 30px;
    }

    .ki-breadcrumb {
        font-size: 16px;
        font-weight: 600;
    }

    .ki-breadcrumb a {
        color: #344568;
        text-decoration: none;
    }

    .ki-layout {
        display: grid;
        grid-template-columns: 300px minmax(0, 1fr);
        gap: 28px;
        padding: 0 20px;
    }

    .ki-sidebar {
        border: 1px solid #ddd;
        align-self: start;
    }

    .ki-tab {
        display: block;
        width: 100%;
        padding: 21px 25px;
        border: 0;
        border-bottom: 1px solid #ddd;
        background: #fff;
        color: #344568;
        text-align: left;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .ki-tab:last-child {
        border-bottom: 0;
    }

    .ki-tab:hover {
        background: #fff9e6;
    }

    .ki-tab.active {
        background: #fff;
        border-left: 4px solid #ffc928;
        box-shadow: inset 0 0 0 1px #4385ff;
    }

    .ki-content {
        padding: 25px 0;
        min-width: 0;
    }

    .ki-content h2 {
        font-size: 23px;
        font-weight: 800;
        margin: 0 0 22px;
        padding-bottom: 15px;
        border-bottom: 3px solid #ffc928;
        color: #344568;
    }

    .ki-content h3 {
        font-size: 17px;
        margin: 25px 0 5px;
        font-weight: 700;
    }

    .ki-content p,
    .ki-content li {
        font-size: 16px;
        line-height: 1.75;
    }

    .ki-content p {
        margin-top: 0;
    }

    .ki-content ul {
        padding-left: 24px;
    }

    @media (max-width: 768px) {
        .ki-banner {
            padding: 20px;
            min-height: 140px;
        }

        .ki-layout {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 0 15px;
        }

        .ki-sidebar {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ki-tab {
            padding: 14px 12px;
            font-size: 14px;
            border-right: 1px solid #ddd;
        }

        .ki-content {
            padding-top: 25px;
        }
    }
</style>

<div class="ki-page">
    <div class="ki-banner">
        <h1>KEKAYAAN INTELEKTUAL</h1>
        <div class="ki-breadcrumb">
            <a href="/">Beranda</a>
            &nbsp; › &nbsp; Kekayaan Intelektual
        </div>
    </div>

    <div class="ki-layout">
        <aside class="ki-sidebar">
            <button class="ki-tab active" data-ki="paten">Paten</button>
            <button class="ki-tab" data-ki="merek">Merek</button>
            <button class="ki-tab" data-ki="desain">Desain Industri</button>
            <button class="ki-tab" data-ki="cipta">Hak Cipta</button>
            <button class="ki-tab" data-ki="indikasi">Indikasi Geografis</button>
            <button class="ki-tab" data-ki="rahasia">Rahasia Dagang</button>
            <button class="ki-tab" data-ki="dtlst">DTLST</button>
        </aside>

        <main class="ki-content">
            <div id="ki-description">
                <h2>Pengenalan Paten</h2>

                <h3>Apakah Paten itu?</h3>
                <p>
                    Paten adalah hak eksklusif yang diberikan oleh negara
                    kepada inventor atas invensi di bidang teknologi untuk
                    jangka waktu tertentu, untuk melaksanakan sendiri invensi
                    tersebut atau memberikan persetujuan kepada pihak lain
                    untuk melaksanakannya.
                </p>

                <h3>Pengertian Invensi</h3>
                <p>
                    Invensi adalah ide inventor yang dituangkan ke dalam
                    suatu kegiatan pemecahan masalah yang spesifik di bidang
                    teknologi, dapat berupa produk atau proses, atau
                    penyempurnaan dan pengembangan produk atau proses.
                </p>

                <h3>Paten Sederhana</h3>
                <p>
                    Paten sederhana diberikan untuk invensi baru berupa
                    produk atau alat yang memiliki kegunaan praktis,
                    termasuk pengembangan produk atau proses yang telah ada,
                    sesuai dengan ketentuan peraturan perundang-undangan.
                </p>
            </div>
        </main>
    </div>
</div>

<script>
    const kiContents = {
        paten: `
            <h2>Pengenalan Paten</h2>
            <h3>Apakah Paten itu?</h3>
            <p>Paten adalah hak eksklusif yang diberikan oleh negara kepada inventor atas invensi di bidang teknologi untuk jangka waktu tertentu, untuk melaksanakan sendiri invensi tersebut atau memberikan persetujuan kepada pihak lain untuk melaksanakannya.</p>
            <h3>Pengertian Invensi</h3>
            <p>Invensi adalah ide inventor yang dituangkan ke dalam suatu kegiatan pemecahan masalah yang spesifik di bidang teknologi, dapat berupa produk atau proses, atau penyempurnaan dan pengembangan produk atau proses.</p>
            <h3>Paten Sederhana</h3>
            <p>Paten sederhana diberikan untuk invensi baru berupa produk atau alat yang memiliki kegunaan praktis, sesuai dengan ketentuan peraturan perundang-undangan.</p>
        `,
        merek: `
            <h2>Pengenalan Merek</h2>
            <h3>Apakah Merek itu?</h3>
            <p>Merek adalah tanda yang dapat ditampilkan secara grafis untuk membedakan barang dan/atau jasa yang diproduksi oleh orang atau badan hukum dalam kegiatan perdagangan.</p>
            <h3>Fungsi Merek</h3>
            <p>Merek membantu konsumen mengenali asal suatu produk atau jasa serta membedakannya dari produk atau jasa milik pihak lain.</p>
            <h3>Contoh Merek</h3>
            <p>Nama usaha, logo, atau tanda lain yang memenuhi persyaratan perlindungan merek dapat diajukan untuk memperoleh perlindungan hukum.</p>
        `,
        desain: `
            <h2>Pengenalan Desain Industri</h2>
            <h3>Apakah Desain Industri itu?</h3>
            <p>Desain Industri adalah kreasi tentang bentuk, konfigurasi, atau komposisi garis atau warna, atau gabungan daripadanya, yang memberikan kesan estetis dan dapat diwujudkan dalam pola tiga dimensi atau dua dimensi serta dapat dipakai untuk menghasilkan suatu produk.</p>
            <h3>Contoh Desain Industri</h3>
            <p>Bentuk dan tampilan luar furnitur, kemasan produk, peralatan rumah tangga, atau produk lain yang memiliki kesan estetis.</p>
        `,
        cipta: `
            <h2>Pengenalan Hak Cipta</h2>
            <h3>Apakah Hak Cipta itu?</h3>
            <p>Hak Cipta adalah hak eksklusif pencipta yang timbul secara otomatis berdasarkan prinsip deklaratif setelah suatu ciptaan diwujudkan dalam bentuk nyata.</p>
            <h3>Contoh Ciptaan</h3>
            <p>Buku, tulisan, lagu, musik, karya fotografi, film, program komputer, dan karya lain yang dilindungi sesuai ketentuan hukum.</p>
            <h3>Fungsi Perlindungan</h3>
            <p>Hak Cipta memberikan perlindungan hukum atas hak pencipta dan pemegang hak terkait terhadap penggunaan ciptaan sesuai ketentuan yang berlaku.</p>
        `,
        indikasi: `
            <h2>Pengenalan Indikasi Geografis</h2>
            <h3>Apakah Indikasi Geografis itu?</h3>
            <p>Indikasi Geografis adalah tanda yang menunjukkan daerah asal suatu barang dan/atau produk yang karena faktor lingkungan geografis, termasuk faktor alam, faktor manusia, atau kombinasi keduanya, memberikan reputasi, kualitas, dan karakteristik tertentu pada barang atau produk yang dihasilkan.</p>
            <h3>Contoh</h3>
            <p>Produk lokal yang kualitas, reputasi, atau karakteristiknya berkaitan dengan daerah asalnya dan memenuhi persyaratan perlindungan Indikasi Geografis.</p>
        `,
        rahasia: `
            <h2>Pengenalan Rahasia Dagang</h2>
            <h3>Apakah Rahasia Dagang itu?</h3>
            <p>Rahasia Dagang adalah informasi yang tidak diketahui oleh umum di bidang teknologi dan/atau bisnis, mempunyai nilai ekonomi karena berguna dalam kegiatan usaha, dan dijaga kerahasiaannya oleh pemiliknya.</p>
            <h3>Contoh</h3>
            <p>Formula produk, metode produksi, metode pengolahan, atau informasi bisnis tertentu yang memenuhi persyaratan sebagai Rahasia Dagang.</p>
            <h3>Perlindungan</h3>
            <p>Pemilik perlu menjaga informasi tetap rahasia agar perlindungannya sesuai dengan ketentuan yang berlaku.</p>
        `,
        dtlst: `
            <h2>Pengenalan DTLST</h2>
            <h3>Apakah DTLST itu?</h3>
            <p>Desain Tata Letak Sirkuit Terpadu (DTLST) adalah kreasi berupa rancangan peletakan tiga dimensi dari berbagai elemen, sekurang-kurangnya satu elemen aktif, serta sebagian atau semua interkoneksi dalam suatu sirkuit terpadu, dan peletakan tiga dimensi tersebut dimaksudkan untuk persiapan pembuatan sirkuit terpadu.</p>
            <h3>Contoh</h3>
            <p>Rancangan tata letak elemen dan hubungan antarbagian pada suatu sirkuit terpadu atau chip elektronik.</p>
        `
    };

    document.querySelectorAll('.ki-tab').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.ki-tab').forEach(tab => {
                tab.classList.remove('active');
            });

            this.classList.add('active');

            const selected = this.dataset.ki;
            document.getElementById('ki-description').innerHTML =
                kiContents[selected];
        });
    });
</script>
@endsection
