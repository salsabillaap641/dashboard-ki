@extends('layouts.app')

@section('title', 'Jenis-Jenis KI')

@section('content')
<style>
    .jenis-page{max-width:1200px;margin:0 auto}
    .jenis-hero{background:linear-gradient(135deg,#173d68,#236b9b);color:#fff;padding:30px;border-radius:18px;margin-bottom:24px}
    .jenis-hero h1{font-size:28px;font-weight:800;margin:0 0 8px}
    .jenis-hero p{margin:0;color:#dbeafe;line-height:1.7;max-width:780px}
    .jenis-tabs{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;margin-bottom:22px}
    .jenis-tabs a{display:flex;align-items:center;gap:12px;padding:16px;background:#fff;border:1px solid #dbe4ef;border-radius:12px;text-decoration:none;color:#24476b;font-size:14px;font-weight:700;box-shadow:0 3px 12px rgba(20,50,80,.04);transition:.18s ease}
    .jenis-tabs a:hover{background:#eaf3fc;border-color:#9dbbda;transform:translateY(-2px)}
    .jenis-tabs a.active{background:#173d68;border-color:#173d68;color:#fff}
    .jenis-tabs .tab-number{display:flex;align-items:center;justify-content:center;flex:0 0 34px;height:34px;border-radius:10px;background:#dcecff;color:#1d5b91;font-size:12px;font-weight:800}
    .jenis-tabs a.active .tab-number{background:#fff;color:#173d68}
    .jenis-card{display:none;background:#fff;border:1px solid #e6edf5;border-radius:16px;margin-bottom:22px;overflow:hidden;box-shadow:0 4px 18px rgba(20,50,80,.05);scroll-margin-top:20px}
    .jenis-card.active{display:block}
    .jenis-card-head{padding:22px 24px;background:#f5f9fd;border-bottom:1px solid #e6edf5;display:flex;align-items:center;gap:14px}
    .jenis-number{width:44px;height:44px;flex:0 0 44px;border-radius:13px;background:#dcecff;color:#1d5b91;display:flex;align-items:center;justify-content:center;font-weight:800}
    .jenis-card-head h2{margin:0;color:#173d68;font-size:21px}
    .jenis-card-head p{margin:4px 0 0;color:#718096;font-size:13px}
    .jenis-card-body{padding:24px}
    .jenis-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
    .jenis-info{border:1px solid #e8eef5;border-radius:12px;padding:17px;background:#fff;min-width:0}
    .jenis-info.full{grid-column:1/-1}
    .jenis-info h3{font-size:14px;margin:0 0 10px;color:#24476b}
    .jenis-info p{font-size:14px;line-height:1.75;color:#475569;margin:0;white-space:pre-line}
    .jenis-info ol,.jenis-info ul{padding-left:20px;margin:0;color:#475569;font-size:14px;line-height:1.8}
    .jenis-info li{margin-bottom:3px}
    .jenis-link{display:inline-flex;align-items:center;gap:7px;margin:5px 8px 0 0;padding:9px 12px;background:#eaf3fc;color:#1d5b91;border-radius:8px;text-decoration:none;font-size:13px;font-weight:700;overflow-wrap:anywhere}
    .jenis-link:hover{background:#d8eafa}
    .jenis-note{margin-top:18px;padding:13px 15px;background:#fff8e8;color:#8a5a0a;border-radius:10px;font-size:12px;line-height:1.6}
    @media(max-width:720px){.jenis-hero{padding:22px}.jenis-hero h1{font-size:23px}.jenis-card-body{padding:15px}.jenis-card-head{padding:17px}.jenis-grid{grid-template-columns:1fr}.jenis-info.full{grid-column:auto}}
</style>

<div class="jenis-page">
    <div class="jenis-hero">
        <h1>Kenali Jenis-Jenis Kekayaan Intelektual</h1>
        <p>Informasi pengertian, masa perlindungan, prosedur, persyaratan, biaya, dan tautan pendaftaran berdasarkan materi informasi KI yang disediakan.</p>
    </div>

    <nav class="jenis-tabs" aria-label="Navigasi jenis KI">
        <a href="#merek" class="active" aria-current="true"><span class="tab-number">01</span><span>Merek</span></a>
        <a href="#hak-cipta"><span class="tab-number">02</span><span>Hak Cipta</span></a>
        <a href="#paten"><span class="tab-number">03</span><span>Paten dan Paten Sederhana</span></a>
        <a href="#ig"><span class="tab-number">04</span><span>Indikasi Geografis</span></a>
        <a href="#rahasia-dagang"><span class="tab-number">05</span><span>Rahasia Dagang</span></a>
        <a href="#desain-industri"><span class="tab-number">06</span><span>Desain Industri</span></a>
        <a href="#dtlst"><span class="tab-number">07</span><span>DTLST</span></a>
    </nav>

    {{-- MEREK --}}
    <section class="jenis-card active" id="merek">
        <div class="jenis-card-head"><div class="jenis-number">01</div><div><h2>Merek</h2><p>Tanda pembeda untuk barang atau jasa</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian Merek</h3><p>Merek adalah sebuah tanda untuk membedakan suatu produk barang atau jasa. Merek bisa berupa kata, logo, suara, bentuk 3 dimensi, atau hologram.</p></div>
            <div class="jenis-info"><h3>Masa Perlindungan</h3><p>Merek terdaftar mendapatkan perlindungan hukum selama 10 tahun sejak tanggal penerimaan permohonan pendaftaran Merek. Perlindungan dapat diperpanjang 10 tahun ke depan.</p></div>
            <div class="jenis-info"><h3>Prosedur Pendaftaran</h3><ol><li>Registrasi akun.</li><li>Klik tambah untuk membuat Permohonan Baru.</li><li>Isi seluruh formulir yang tersedia.</li><li>Unggah data dukung yang dibutuhkan.</li><li>Dapatkan kode billing dan lakukan pembayaran (pembayaran maksimal pukul 23.59 WIB pada hari yang sama).</li><li>Jika semua dirasa sudah benar, klik selesai.</li><li>Permohonan diterima oleh DJKI.</li></ol></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran — Umum</h3><ol><li>KTP (PDF).</li><li>Etiket/Label Merek (JPG).</li><li>Tanda tangan elektronik pemohon (JPG/JPEG).</li></ol></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran — UMKM</h3><ol><li>KTP (PDF).</li><li>Etiket/Label Merek (JPG).</li><li>Tanda tangan elektronik pemohon (JPG/JPEG).</li><li>Surat rekomendasi UKM binaan atau surat keterangan UKM binaan dinas (asli).</li><li>Surat pernyataan UMK bermaterai.</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Umum: Rp2.800.000/kelas.\nUMK: Rp500.000/kelas.</p></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://merek.dgip.go.id/" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="http://bit.ly/4h6yvkI" target="_blank" rel="noopener">Form pendaftaran ↗</a><a class="jenis-link" href="https://pdki-indonesia.dgip.go.id/" target="_blank" rel="noopener">Cek Merek terdaftar ↗</a><a class="jenis-link" href="https://skm.dgip.go.id/" target="_blank" rel="noopener">Cek klasifikasi kelas ↗</a></div>
        </div></div>
    </section>

    {{-- HAK CIPTA --}}
    <section class="jenis-card" id="hak-cipta">
        <div class="jenis-card-head"><div class="jenis-number">02</div><div><h2>Hak Cipta</h2><p>Hak eksklusif pencipta atas karya yang diwujudkan</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian Hak Cipta</h3><p>Hak Cipta adalah hak eksklusif pencipta yang timbul secara otomatis setelah karya diwujudkan dalam bentuk nyata dan dipublikasikan.</p></div>
            <div class="jenis-info full"><h3>Masa Perlindungan</h3><ol><li>Buku, lagu/musik, lukisan, tari, drama, peta, seni motif, dan karya sejenis: seumur hidup pencipta + 70 tahun.</li><li>Fotografi, sinematografi, program komputer, terjemahan/adaptasi atau modifikasi karya cipta lainnya: 50 tahun sejak pertama kali dipublikasikan.</li><li>Seni terapan: 25 tahun sejak ciptaan pertama kali dipublikasikan.</li></ol></div>
            <div class="jenis-info"><h3>Prosedur Pencatatan</h3><ol><li>Registrasi akun.</li><li>Pilih pengajuan pencatatan ciptaan.</li><li>Isi seluruh formulir yang tersedia.</li><li>Unggah dokumen pendukung/contoh ciptaan.</li><li>Lakukan pembayaran.</li><li>Permohonan Hak Cipta diproses melalui verifikasi otomatis.</li><li>Unduh surat pencatatan ciptaan.</li></ol></div>
            <div class="jenis-info"><h3>Syarat Pencatatan</h3><p>Data dukung yang diunggah:</p><ol><li>Surat permohonan pencatatan ciptaan.</li><li>Surat pernyataan.</li><li>Surat pengalihan Hak Cipta (jika pencipta dan pemohon berbeda).</li><li>Contoh ciptaan.</li><li>KTP pemohon dan pencipta.</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Ciptaan lagu/musik: Rp0/permohonan.\nCiptaan selain lagu/musik: Rp200.000/pencatatan.</p></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://hakcipta.dgip.go.id/" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="https://bit.ly/4nGT1Lb" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

    {{-- PATEN --}}
    <section class="jenis-card" id="paten">
        <div class="jenis-card-head"><div class="jenis-number">03</div><div><h2>Paten dan Paten Sederhana</h2><p>Perlindungan invensi di bidang teknologi</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian</h3><p>Paten adalah hak eksklusif inventor atas invensi di bidang teknologi untuk selama waktu tertentu melaksanakan sendiri atau memberikan persetujuan kepada pihak lain untuk melaksanakan invensinya.\n\nPaten Sederhana: invensi berupa produk atau alat yang baru dan mempunyai nilai kegunaan praktis karena bentuk, konfigurasi, konstruksi, atau komponennya dapat memperoleh perlindungan hukum dalam bentuk paten sederhana.</p></div>
            <div class="jenis-info"><h3>Masa Perlindungan</h3><ol><li>Paten: 20 tahun sejak tanggal penerimaan permohonan Paten.</li><li>Paten sederhana: 10 tahun sejak tanggal penerimaan permohonan Paten sederhana.</li></ol></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran</h3><ol><li>Deskripsi permohonan Paten dalam Bahasa Indonesia.</li><li>Klaim.</li><li>Abstrak.</li><li>Gambar invensi (PDF) dan gambar untuk publikasi (JPG).</li><li>Surat pernyataan kepemilikan invensi oleh inventor.</li><li>Surat pengalihan hak (jika inventor dan pemohon berbeda atau pemohon badan hukum).</li><li>Surat kuasa (jika diajukan melalui konsultan).</li><li>Surat keterangan UMK (jika pemohon usaha mikro atau kecil).</li><li>SK Akta Pendirian (jika pemohon lembaga pendidikan atau litbang pemerintah).</li></ol></div>
            <div class="jenis-info"><h3>Prosedur</h3><p>Materi memuat diagram “Prosedur Pendaftaran Paten” dan “Alur Pendaftaran Paten Sederhana”. Rincian alur visual mengikuti diagram pada dokumen sumber.</p></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p><strong>Paten:</strong></p><ul><li>UMK, lembaga pendidikan, dan litbang pemerintah: Rp350.000/permohonan.</li><li>Umum: Rp1.250.000/permohonan.</li></ul><p style="margin-top:10px"><strong>Paten Sederhana:</strong></p><ul><li>UMK, lembaga pendidikan, dan litbang pemerintah: Rp200.000/permohonan.</li><li>Umum: Rp800.000/permohonan.</li></ul></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://paten.dgip.go.id/" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="http://bit.ly/3IXd3Sg" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

    {{-- IG --}}
    <section class="jenis-card" id="ig">
        <div class="jenis-card-head"><div class="jenis-number">04</div><div><h2>Indikasi Geografis</h2><p>Tanda asal barang/produk yang memiliki karakteristik geografis</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian</h3><p>Indikasi Geografis adalah suatu tanda yang menunjukkan daerah asal suatu barang dan/atau produk yang karena faktor lingkungan geografis, termasuk faktor alam, faktor manusia atau kombinasi keduanya, memberikan reputasi, kualitas, dan karakteristik tertentu pada barang dan/atau produk yang dihasilkan. Tanda dapat berupa etiket atau label yang dilekatkan pada barang. Tanda juga dapat berupa nama tempat, daerah, wilayah, kata, gambar, huruf, atau kombinasi unsur-unsur tersebut.</p></div>
            <div class="jenis-info"><h3>Masa Perlindungan</h3><p>Indikasi Geografis dilindungi selama terjaganya reputasi, kualitas, dan karakteristik yang menjadi dasar diberikannya pelindungan Indikasi Geografis pada suatu produk.</p></div>
            <div class="jenis-info"><h3>Siapa yang Berhak Mengajukan?</h3><p>Permohonan pendaftaran diajukan oleh:</p><ol><li>Lembaga yang mewakili masyarakat di kawasan geografis tertentu yang mengusahakan barang/produk berupa sumber daya alam, barang kerajinan tangan, atau hasil industri.</li><li>Pemerintah daerah provinsi atau kabupaten/kota.</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Permohonan pendaftaran: Rp1.450.000/permohonan.</p></div>
            <div class="jenis-info"><h3>Prosedur</h3><p>Materi sumber memuat diagram “Prosedur Pendaftaran Indikasi Geografis”. Ikuti alur visual pada dokumen sumber.</p></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://bit.ly/3KId2Cf" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

    {{-- RAHASIA DAGANG --}}
    <section class="jenis-card" id="rahasia-dagang">
        <div class="jenis-card-head"><div class="jenis-number">05</div><div><h2>Rahasia Dagang</h2><p>Informasi teknologi/bisnis yang dijaga kerahasiaannya</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian dan Lingkup Perlindungan</h3><p>Rahasia Dagang adalah informasi yang tidak diketahui oleh umum di bidang teknologi dan/atau bisnis, mempunyai nilai ekonomi karena berguna dalam kegiatan usaha, dan dijaga kerahasiaannya oleh pemilik Rahasia Dagang.\n\nLingkup perlindungan meliputi metode produksi, metode pengolahan, metode penjualan, atau informasi lain di bidang teknologi dan/atau bisnis yang memiliki nilai ekonomi dan tidak diketahui masyarakat umum.</p></div>
            <div class="jenis-info full"><h3>Pelanggaran Rahasia Dagang terjadi apabila</h3><ol><li>Seseorang dengan sengaja mengungkapkan Rahasia Dagang, mengingkari kesepakatan atau mengingkari kewajiban tertulis/tidak tertulis untuk menjaga Rahasia Dagang.</li><li>Seseorang memperoleh atau menguasai Rahasia Dagang dengan cara yang bertentangan dengan peraturan perundang-undangan yang berlaku.</li></ol></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran</h3><p>Data dukung yang diunggah:</p><ol><li>Perjanjian Lisensi Rahasia Dagang.</li><li>Identitas pemberi.</li><li>Akta badan hukum.</li><li>Surat bukti kepemilikan Rahasia Dagang.</li><li>Surat pernyataan pencatatan perjanjian lisensi KI.</li><li>Identitas penerima.</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Menurut tabel pada materi sumber:</p><ul><li>Pencatatan pengalihan hak Rahasia Dagang: usaha mikro/kecil, lembaga pendidikan, dan litbang pemerintah Rp200.000/permohonan; umum Rp400.000/permohonan.</li><li>Pencatatan perjanjian lisensi Rahasia Dagang: usaha mikro/kecil, lembaga pendidikan, dan litbang pemerintah Rp150.000/permohonan; umum Rp250.000/permohonan.</li><li>Petikan lisensi Rahasia Dagang: Rp300.000/permohonan.</li></ul></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://rd.dgip.go.id/" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="https://bit.ly/3KzQ00z" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

    {{-- DESAIN INDUSTRI --}}
    <section class="jenis-card" id="desain-industri">
        <div class="jenis-card-head"><div class="jenis-number">06</div><div><h2>Desain Industri</h2><p>Kreasi bentuk/komposisi yang memberi kesan estetis</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian</h3><p>Desain Industri adalah suatu kreasi tentang bentuk, konfigurasi atau komposisi garis atau warna, atau garis dan warna, atau gabungannya yang berbentuk tiga dimensi atau dua dimensi, memberikan kesan estetis, dapat diwujudkan dalam pola tiga dimensi atau dua dimensi, serta dapat dipakai untuk menghasilkan produk, barang, komoditas industri atau kerajinan tangan.</p></div>
            <div class="jenis-info"><h3>Masa Perlindungan</h3><p>10 tahun sejak tanggal penerimaan. Pemegang hak memiliki hak eksklusif untuk melaksanakan haknya dan melarang orang lain tanpa persetujuannya membuat, memakai, menjual, mengimpor, mengekspor, dan/atau mengedarkan produk terkait.</p></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran</h3><ol><li>Gambar Desain Industri.</li><li>Uraian Desain Industri.</li><li>Surat pernyataan kepemilikan Desain Industri.</li><li>Surat kuasa (jika diajukan melalui konsultan).</li><li>Surat pernyataan pengalihan hak (jika pemohon dan pendesain berbeda).</li><li>Surat keterangan UMK (jika pemohon usaha mikro atau kecil).</li><li>SK Akta Pendirian (jika pemohon lembaga pendidikan atau litbang pemerintah).</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Satu Desain Industri:\n- UMK, lembaga pendidikan, dan litbang pemerintah: Rp250.000/permohonan.\n- Umum: Rp800.000/permohonan.\n\nSatu Kesatuan (Set):\n- UMK, lembaga pendidikan, dan litbang pemerintah: Rp550.000/permohonan.\n- Umum: Rp1.250.000/permohonan.</p></div>
            <div class="jenis-info"><h3>Prosedur</h3><p>Materi sumber memuat diagram “Prosedur Pendaftaran Desain Industri”. Ikuti alur visual pada dokumen sumber.</p></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://desainindustri.dgip.go.id/" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="https://bit.ly/4gY69sx" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

    {{-- DTLST --}}
    <section class="jenis-card" id="dtlst">
        <div class="jenis-card-head"><div class="jenis-number">07</div><div><h2>Desain Tata Letak Sirkuit Terpadu (DTLST)</h2><p>Kreasi rancangan peletakan elemen dalam sirkuit terpadu</p></div></div>
        <div class="jenis-card-body"><div class="jenis-grid">
            <div class="jenis-info full"><h3>Pengertian</h3><p>Desain Tata Letak Sirkuit Terpadu adalah kreasi berupa rancangan peletakan tiga dimensi dari berbagai elemen, sekurang-kurangnya satu elemen aktif, serta sebagian atau semua interkoneksi dalam suatu sirkuit terpadu, yang dimaksudkan untuk persiapan pembuatan sirkuit terpadu.\n\nSirkuit terpadu adalah produk jadi atau setengah jadi yang memiliki berbagai elemen, sekurang-kurangnya satu elemen aktif, yang sebagian atau seluruhnya saling berkaitan dan dibentuk secara terpadu di dalam bahan semikonduktor untuk menghasilkan fungsi elektronik.</p></div>
            <div class="jenis-info"><h3>Masa Perlindungan</h3><p>10 tahun sejak pertama kali DTLST dieksploitasi secara komersial atau sejak tanggal penerimaan permohonan pendaftaran.</p></div>
            <div class="jenis-info"><h3>DTLST yang dapat didaftarkan</h3><p>DTLST dapat didaftarkan jika orisinal, merupakan hasil karya mandiri pendesain, dan pada saat dibuat tidak merupakan sesuatu yang umum bagi para pendesain.</p></div>
            <div class="jenis-info"><h3>Syarat Pendaftaran</h3><ol><li>File DTLST.</li><li>Gambar dan uraian DTLST.</li><li>Surat pernyataan kepemilikan DTLST.</li><li>Surat pengalihan hak DTLST (jika pemohon dan pendesain bukan orang yang sama).</li><li>Surat keterangan mengenai tanggal eksploitasi pertama secara komersial (jika sudah komersial).</li><li>Surat kuasa (jika menggunakan konsultan KI).</li></ol></div>
            <div class="jenis-info"><h3>Biaya Pendaftaran</h3><p>Permohonan pendaftaran DTLST:</p><ul><li>Usaha mikro, usaha kecil, lembaga pendidikan, dan lembaga penelitian dan pengembangan pemerintah: Rp400.000/permohonan.</li><li>Umum: Rp700.000/permohonan.</li></ul></div>
            <div class="jenis-info"><h3>Tautan</h3><a class="jenis-link" href="https://dtlst.dgip.go.id/login" target="_blank" rel="noopener">Registrasi akun ↗</a><a class="jenis-link" href="https://bit.ly/46UMOE6" target="_blank" rel="noopener">Form pendaftaran ↗</a></div>
        </div></div>
    </section>

   

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.jenis-tabs a');
    const cards = document.querySelectorAll('.jenis-card');

    function showJenis(id, updateHash = false) {
        const target = document.getElementById(id);
        if (!target || !target.classList.contains('jenis-card')) return;

        cards.forEach(card => card.classList.toggle('active', card === target));
        tabs.forEach(tab => {
            const active = tab.getAttribute('href') === '#' + id;
            tab.classList.toggle('active', active);
            if (active) tab.setAttribute('aria-current', 'true');
            else tab.removeAttribute('aria-current');
        });

        if (updateHash && window.location.hash !== '#' + id) {
            history.replaceState(null, '', '#' + id);
        }
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function (event) {
            event.preventDefault();
            showJenis(this.getAttribute('href').slice(1), true);
        });
    });

    const initialId = window.location.hash ? window.location.hash.slice(1) : 'merek';
    showJenis(initialId);
});
</script>
@endsection
