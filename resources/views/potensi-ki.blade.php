@extends('layouts.app')

@section('title', 'Potensi KI Kalimantan Tengah')

@push('styles')
<style>
    .potensi-page { max-width: 1250px; margin: 0 auto; }
    .potensi-hero { position: relative; overflow: hidden; padding: 30px; border-radius: 18px; color: #fff; background: linear-gradient(120deg,#12365d,#1d6794); margin-bottom: 22px; }
    .potensi-hero:after { content: 'KI'; position: absolute; right: 38px; top: 10px; font-size: 125px; font-weight: 900; color: rgba(255,255,255,.08); line-height: 1; }
    .potensi-eyebrow { text-transform: uppercase; letter-spacing: 1.6px; font-size: 11px; font-weight: 800; color: #b9e2ff; }
    .potensi-hero h1 { margin: 10px 0 8px; font-size: clamp(25px,3vw,36px); position: relative; z-index: 1; }
    .potensi-hero p { margin: 0; color: #e0effb; max-width: 700px; line-height: 1.6; font-size: 14px; position: relative; z-index: 1; }
    .potensi-count { display: inline-flex; align-items: center; gap: 8px; margin-top: 20px; padding: 10px 14px; border: 1px solid #ffffff35; border-radius: 10px; background: #ffffff16; font-size: 13px; position: relative; z-index: 1; }
    .potensi-count strong { font-size: 20px; }
    .potensi-filter { display: grid; grid-template-columns: minmax(200px,1fr) minmax(200px,.7fr) auto auto; gap: 10px; padding: 16px; background: #fff; border: 1px solid #e6edf5; border-radius: 14px; margin-bottom: 18px; box-shadow: 0 4px 15px #16304f08; }
    .potensi-filter input,.potensi-filter select { min-width: 0; width: 100%; padding: 11px 12px; border: 1px solid #dce4ee; border-radius: 8px; background: white; color: #263449; font: inherit; font-size: 13px; }
    .potensi-filter button { border: 0; border-radius: 8px; padding: 0 18px; background: #173d68; color: #fff; font-weight: 700; cursor: pointer; }
    .potensi-reset { display:flex; align-items:center; justify-content:center; text-decoration:none; padding:0 14px; border:1px solid #dce4ee; border-radius:8px; color:#475569; font-size:13px; }
    .potensi-section-head { display:flex; align-items:flex-end; justify-content:space-between; gap:12px; margin: 20px 0 14px; }
    .potensi-section-head h2 { margin:0; font-size:19px; color:#173d68; }
    .potensi-section-head p { margin:5px 0 0; font-size:12px; color:#8292a8; }
    .potensi-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:15px; }
    .potensi-card { position:relative; min-width:0; padding:20px; background:#fff; border:1px solid #e6edf5; border-radius:15px; box-shadow:0 4px 15px #16304f08; transition:transform .18s ease, box-shadow .18s ease; }
    .potensi-card:hover { transform:translateY(-3px); box-shadow:0 10px 24px #16304f12; }
    .potensi-card-top { display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:16px; }
    .potensi-symbol { width:42px; height:42px; display:grid; place-items:center; border-radius:12px; background:#edf5ff; color:#2468a4; font-size:21px; font-weight:800; }
    .potensi-chip { display:inline-block; padding:5px 9px; border-radius:20px; background:#fff4df; color:#9a5a00; font-size:10px; font-weight:800; }
    .potensi-card h3 { margin:0 0 14px; color:#213d5d; font-size:16px; line-height:1.45; overflow-wrap:anywhere; }
    .potensi-meta { display:flex; align-items:center; gap:8px; color:#66768b; font-size:12px; }
    .potensi-meta + .potensi-meta { margin-top:8px; }
    .potensi-empty { padding:38px 20px; text-align:center; background:#fff; border:1px dashed #cbd7e5; border-radius:14px; color:#64748b; }
    .potensi-empty strong { display:block; color:#334155; margin-bottom:6px; }
    @media(max-width:950px) { .potensi-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } .potensi-filter { grid-template-columns:1fr 1fr; } .potensi-filter button,.potensi-reset { min-height:42px; } }
    @media(max-width:560px) { .potensi-hero { padding:23px; } .potensi-grid,.potensi-filter { grid-template-columns:1fr; } .potensi-hero:after { right:12px; font-size:90px; } }
</style>
@endpush

@section('content')
<div class="potensi-page">
    <section class="potensi-hero">
        <div class="potensi-eyebrow">Sistem Informasi Kekayaan Intelektual</div>
        <h1>Jelajahi Potensi KI<br>Kalimantan Tengah</h1>
        <p>Kenali beragam potensi kekayaan intelektual dari kabupaten dan kota di Kalimantan Tengah. Halaman ini menampilkan informasi umum tanpa membuka detail pengajuan.</p>
        <div class="potensi-count"><strong>{{ number_format($jumlahPotensi, 0, ',', '.') }}</strong> potensi KI ditampilkan</div>
    </section>

    <form class="potensi-filter" method="GET" action="{{ route('potensi-ki.index') }}">
        <input type="search" name="search" value="{{ $search }}" placeholder="Cari nama potensi KI..." aria-label="Cari nama potensi KI">
        <select name="kabupaten_id" aria-label="Filter kabupaten/kota">
            <option value="">Semua Kabupaten/Kota</option>
            @foreach ($daftarKabupaten as $kabupaten)
                <option value="{{ $kabupaten->id }}" @selected((string) $kabupatenId === (string) $kabupaten->id)>{{ $kabupaten->nama_kabupaten }}</option>
            @endforeach
        </select>
        <button type="submit">Cari Potensi</button>
        <a class="potensi-reset" href="{{ route('potensi-ki.index') }}">Reset</a>
    </form>

    <div class="potensi-section-head">
        <div>
            <h2>Potensi yang Dikenal</h2>
            <p>Nama potensi dan wilayah asalnya</p>
        </div>
    </div>

    @if ($potensi->isNotEmpty())
        <div class="potensi-grid">
            @foreach ($potensi as $item)
                <article class="potensi-card">
                    <div class="potensi-card-top">
                        <div class="potensi-symbol">✦</div>
                        <span class="potensi-chip">POTENSI KI</span>
                    </div>
                    <h3>{{ $item->nama_ki }}</h3>
                    <div class="potensi-meta"><span aria-hidden="true">⌖</span><span>{{ $item->nama_kabupaten }}</span></div>
                    @if (!empty($item->nama_jenis))
                        <div class="potensi-meta"><span aria-hidden="true">◇</span><span>{{ $item->nama_jenis }}</span></div>
                    @endif
                </article>
            @endforeach
        </div>
    @else
        <div class="potensi-empty">
            <strong>Belum ada potensi KI yang dapat ditampilkan.</strong>
            Coba ubah kata kunci atau pilih kabupaten/kota lainnya.
        </div>
    @endif
</div>
@endsection
