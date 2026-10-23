@extends('layouts.app')

@section('title', 'Rekap KI | KI Kalteng')

@push('styles')
<style>
    .rekap-page{max-width:1400px;margin:0 auto;color:#243247}
    .rekap-heading{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;margin-bottom:24px}
    .rekap-eyebrow{color:#1d5b91;text-transform:uppercase;letter-spacing:.12em;font-size:11px;font-weight:800;margin:0 0 8px}
    .rekap-title{font-size:clamp(25px,3vw,32px);line-height:1.2;margin:0 0 8px;color:#172b46;font-weight:800}
    .rekap-subtitle{margin:0;color:#6b7789;font-size:14px;line-height:1.6}
    .rekap-period{background:#eaf2fb;color:#1b527f;padding:10px 14px;border-radius:12px;font-size:13px;font-weight:700;white-space:nowrap}
    .rekap-alert{border-radius:12px;padding:13px 16px;margin-bottom:18px;font-size:14px}
    .rekap-alert.success{background:#eaf8f0;border:1px solid #b9e6ca;color:#17663a}
    .rekap-alert.error{background:#fff0f0;border:1px solid #f1c2c2;color:#a22b2b}
    .rekap-alert ul{margin:8px 0 0;padding-left:20px}
    .rekap-card{background:#fff;border:1px solid #e4eaf1;border-radius:16px;box-shadow:0 6px 22px rgba(24,48,78,.05);overflow:hidden;margin-bottom:22px}
    .rekap-card-head{padding:19px 22px;border-bottom:1px solid #edf1f6}
    .rekap-card-head h2{font-size:16px;margin:0;color:#1c304b;font-weight:800}
    .rekap-card-head p{margin:5px 0 0;color:#7a8798;font-size:12px}
    .rekap-card-body{padding:22px}
    .rekap-form-grid{display:grid;grid-template-columns:repeat(12,minmax(0,1fr));gap:17px}
    .rekap-field{grid-column:span 4;min-width:0}
    .rekap-field label{display:block;margin-bottom:8px;color:#43536a;font-size:12px;font-weight:800}
    .rekap-field input,.rekap-field select{display:block;width:100%;height:44px;padding:0 12px;border:1px solid #d9e1eb;border-radius:9px;background:#fff;color:#243247;font:inherit;font-size:13px;outline:none}
    .rekap-field input:focus,.rekap-field select:focus{border-color:#3978b7;box-shadow:0 0 0 3px rgba(57,120,183,.13)}
    .rekap-actions{display:flex;align-items:center;gap:10px;margin-top:22px;flex-wrap:wrap}
    .rekap-btn{display:inline-flex;align-items:center;justify-content:center;min-height:42px;padding:0 17px;border:1px solid transparent;border-radius:9px;font:inherit;font-size:13px;font-weight:800;text-decoration:none;cursor:pointer}
    .rekap-btn.primary{background:#1d5b91;color:#fff}.rekap-btn.primary:hover{background:#174873}
    .rekap-btn.secondary{background:#fff;color:#37516d;border-color:#dbe3ec}
    .rekap-filter{display:flex;align-items:flex-end;gap:12px;flex-wrap:wrap}
    .rekap-filter .rekap-field{flex:1 1 220px}
    .rekap-table-wrap{width:100%;overflow-x:auto;margin-top:20px}
    .rekap-table{width:100%;border-collapse:separate;border-spacing:0;font-size:13px}
    .rekap-table th{background:#f5f8fc;color:#627188;font-size:11px;letter-spacing:.04em;text-transform:uppercase;font-weight:800;padding:14px 15px;border-bottom:1px solid #e5ebf2;text-align:left;white-space:nowrap}
    .rekap-table td{padding:14px 15px;border-bottom:1px solid #edf1f5;color:#34445a;vertical-align:middle}
    .rekap-table tbody tr:hover td{background:#fafcff}
    .rekap-table .num{text-align:right;font-variant-numeric:tabular-nums;font-weight:800;color:#1b3656}
    .rekap-badge{display:inline-flex;align-items:center;padding:6px 9px;border-radius:99px;font-size:11px;font-weight:800;white-space:nowrap}
    .rekap-badge.registered{background:#e7f7ee;color:#197044}.rekap-badge.process{background:#fff3d8;color:#8b5b08}
    .rekap-empty{text-align:center;padding:38px 20px!important;color:#7b8798!important}
    .rekap-note{margin:14px 0 0;color:#7a8798;font-size:12px;line-height:1.6}
    @media(max-width:800px){.rekap-field{grid-column:span 6}}
    @media(max-width:600px){.rekap-heading{display:block}.rekap-period{display:inline-block;margin-top:14px}.rekap-card-head,.rekap-card-body{padding:17px}.rekap-field{grid-column:span 12}}
</style>
@endpush

@section('content')
<div class="rekap-page">
    <header class="rekap-heading">
        <div>
            <p class="rekap-eyebrow">Dashboard KI Kalteng</p>
            <h1 class="rekap-title">Rekap KI</h1>
            <p class="rekap-subtitle">Catat jumlah KI Terdaftar dan Dalam Proses sesuai data yang berlaku pada tanggal tertentu.</p>
        </div>
        <div class="rekap-period">
            Data terbaru: {{ $tanggalTerbaru ? \Carbon\Carbon::parse($tanggalTerbaru)->translatedFormat('d F Y') : 'Belum tersedia' }}
        </div>
    </header>

    @if(session('success'))
        <div class="rekap-alert success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="rekap-alert error">
            <strong>Data belum dapat disimpan:</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <section class="rekap-card">
        <div class="rekap-card-head">
            <h2>Input / Perbarui Rekap</h2>
            <p>Masukkan jumlah saat ini, bukan jumlah tambahan. Untuk kombinasi tanggal, kabupaten, jenis, dan status yang sama, angka lama akan diperbarui.</p>
        </div>
        <div class="rekap-card-body">
            <form action="{{ route('rekap-ki.store') }}" method="POST">
                @csrf
                <div class="rekap-form-grid">
                    <div class="rekap-field">
                        <label for="tanggal_data">Tanggal data berlaku</label>
                        <input type="date" name="tanggal_data" id="tanggal_data" value="{{ old('tanggal_data', $tanggal) }}" required>
                    </div>
                    <div class="rekap-field">
                        <label for="kabupaten_id">Kabupaten/Kota</label>
                        <select name="kabupaten_id" id="kabupaten_id" required>
                            <option value="">Pilih kabupaten/kota</option>
                            @foreach($kabupaten as $item)
                                <option value="{{ $item->id }}" @selected(old('kabupaten_id') == $item->id)>{{ $item->nama_kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rekap-field">
                        <label for="jenis_ki_id">Jenis KI</label>
                        <select name="jenis_ki_id" id="jenis_ki_id" required>
                            <option value="">Pilih jenis KI</option>
                            @foreach($jenisKi as $item)
                                <option value="{{ $item->id }}" @selected(old('jenis_ki_id') == $item->id)>{{ $item->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="rekap-field">
                        <label for="status">Status KI</label>
                        <select name="status" id="status" required>
                            <option value="">Pilih status</option>
                            <option value="terdaftar" @selected(old('status') === 'terdaftar')>Terdaftar</option>
                            <option value="proses" @selected(old('status') === 'proses')>Dalam Proses</option>
                        </select>
                    </div>
                    <div class="rekap-field">
                        <label for="jumlah">Jumlah saat ini</label>
                        <input type="number" name="jumlah" id="jumlah" min="0" step="1" value="{{ old('jumlah', 0) }}" required>
                    </div>
                </div>
                <div class="rekap-actions">
                    <button type="submit" class="rekap-btn primary">Simpan / Perbarui Angka</button>
                </div>
            </form>
        </div>
    </section>

    <section class="rekap-card">
        <div class="rekap-card-head">
            <h2>Riwayat Rekap Berdasarkan Tanggal</h2>
            <p>Data tanggal sebelumnya tetap tersimpan untuk ditelusuri.</p>
        </div>
        <div class="rekap-card-body">
            <form action="{{ route('rekap-ki.index') }}" method="GET" class="rekap-filter">
                <div class="rekap-field">
                    <label for="filter_tanggal">Pilih tanggal</label>
                    <input type="date" name="tanggal" id="filter_tanggal" value="{{ $tanggal }}" required>
                </div>
                <button type="submit" class="rekap-btn secondary">Tampilkan Riwayat</button>
            </form>

            <div class="rekap-table-wrap">
                <table class="rekap-table">
                    <thead>
                        <tr><th>No.</th><th>Tanggal Data</th><th>Kabupaten/Kota</th><th>Jenis KI</th><th>Status</th><th style="text-align:right">Jumlah saat itu</th></tr>
                    </thead>
                    <tbody>
                        @forelse($rekap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal_data->format('d-m-Y') }}</td>
                                <td>{{ $item->kabupaten->nama_kabupaten ?? '-' }}</td>
                                <td>{{ $item->jenisKi->nama_jenis ?? '-' }}</td>
                                <td>
                                    @if($item->status === 'terdaftar')
                                        <span class="rekap-badge registered">Terdaftar</span>
                                    @else
                                        <span class="rekap-badge process">Dalam Proses</span>
                                    @endif
                                </td>
                                <td class="num">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="rekap-empty">Belum ada data rekap pada tanggal ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="rekap-note">Catatan: dashboard menggunakan seluruh data pada tanggal rekap paling baru. Data pada tanggal yang lebih lama tetap menjadi riwayat dan tidak dijumlahkan ke total terbaru.</p>
        </div>
    </section>
</div>
@endsection
