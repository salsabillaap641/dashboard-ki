@extends('layouts.app')

@section('title', 'Detail Pengajuan Potensi KI')

@section('content')
<style>
.detail-wrap{max-width:1000px;margin:auto;color:#263750}
.detail-card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:24px;margin-bottom:18px;box-shadow:0 3px 12px rgba(15,35,60,.04)}
.detail-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.detail-grid small{display:block;color:#64748b;margin-bottom:6px}
.detail-grid strong{overflow-wrap:anywhere}
.detail-status{display:inline-block;padding:6px 10px;border-radius:20px;background:#fff5d8;color:#805d00;font-weight:700;font-size:12px}
.detail-history{border-left:2px solid #dbe3ef;padding:0 0 16px 16px;margin-left:6px}
.detail-btn{display:inline-block;padding:10px 15px;border-radius:7px;text-decoration:none;font-weight:700;background:#344568;color:#fff}
@media(max-width:650px){.detail-grid{grid-template-columns:1fr}.detail-card{padding:18px}}
</style>
<div class="detail-wrap">
    <h1>Detail Pengajuan Potensi KI</h1>
    <p style="color:#64748b;margin-bottom:22px">Informasi lengkap pengajuan dan hasil penelaahan Master.</p>

    <div class="detail-card">
        <div class="detail-grid">
            <div><small>Nama Kekayaan Intelektual</small><strong>{{ $pengajuanKi->nama_ki }}</strong></div>
            <div><small>Jenis KI</small><strong>{{ $pengajuanKi->jenisKi->nama_jenis ?? $pengajuanKi->jenisKi->nama ?? '-' }}</strong></div>
            <div><small>Nama Pemilik</small><strong>{{ $pengajuanKi->pemilik }}</strong></div>
            <div><small>Nomor Kontak</small><strong>{{ $pengajuanKi->nomor_kontak ?: '-' }}</strong></div>
            <div><small>Kabupaten/Kota</small><strong>{{ $pengajuanKi->kabupaten->nama_kabupaten ?? '-' }}</strong></div>
            <div><small>Tahun</small><strong>{{ $pengajuanKi->tahun }}</strong></div>
            <div><small>Tanggal Pengajuan</small><strong>{{ $pengajuanKi->tanggal_pengajuan ? \Carbon\Carbon::parse($pengajuanKi->tanggal_pengajuan)->format('d-m-Y') : '-' }}</strong></div>
            <div><small>Status Pengajuan</small><span class="detail-status">{{ ucwords(str_replace('_',' ',$pengajuanKi->status_pengajuan ?? 'menunggu_penelaahan')) }}</span></div>
        </div>
        <div style="margin-top:22px"><small style="display:block;color:#64748b;margin-bottom:6px">Keterangan</small><p style="white-space:pre-wrap;line-height:1.7">{{ $pengajuanKi->keterangan ?: '-' }}</p></div>
        <div style="margin-top:22px"><small style="display:block;color:#64748b;margin-bottom:8px">Bukti Pendukung</small>
        @if($pengajuanKi->bukti_pendukung)
            <a class="detail-btn" href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($pengajuanKi->bukti_pendukung) }}" target="_blank" rel="noopener">Lihat / Unduh Bukti</a>
        @else <span>- Tidak ada bukti pendukung</span> @endif</div>
        <div style="margin-top:22px"><small style="display:block;color:#64748b;margin-bottom:6px">Catatan Master</small><p style="white-space:pre-wrap;line-height:1.7">{{ $pengajuanKi->catatan_admin ?: 'Belum ada catatan dari Master.' }}</p></div>
    </div>
    <div class="detail-card">
        <h3>Riwayat Pengajuan</h3>
        @forelse($pengajuanKi->riwayatPengajuan as $riwayat)
            <div class="detail-history">
                <strong>{{ ucwords(str_replace('_',' ',$riwayat->status_baru)) }}</strong>
                <div style="color:#64748b;font-size:12px;margin-top:5px">{{ $riwayat->user->name ?? 'Pengguna tidak tersedia' }} · {{ $riwayat->created_at?->format('d-m-Y H:i') }}</div>
                <p style="white-space:pre-wrap">{{ $riwayat->catatan ?: 'Tidak ada catatan.' }}</p>
            </div>
        @empty <p style="color:#64748b">Belum ada riwayat pengajuan.</p> @endforelse
    </div>
    <a class="detail-btn" href="{{ route('pengajuan-saya') }}">Kembali ke Pengajuan Saya</a>
</div>
@endsection
