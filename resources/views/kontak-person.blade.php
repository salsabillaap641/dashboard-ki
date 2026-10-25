@extends('layouts.app')

@section('title', 'Kontak Person Kanwil')

@section('content')
<style>
    .contact-wrap{max-width:900px;margin:0 auto;color:#26364f}
    .contact-heading{margin-bottom:24px}
    .contact-heading h1{font-size:27px;margin:0 0 8px;font-weight:750}
    .contact-heading p{color:#64748b;margin:0;font-size:14px}
    .contact-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;box-shadow:0 6px 22px rgba(15,35,60,.05)}
    .contact-card-head{background:#173d68;color:#fff;padding:24px 28px}
    .contact-card-head h2{margin:0 0 6px;font-size:19px}
    .contact-card-head p{margin:0;color:#dbe7f5;font-size:13px}
    .contact-body{padding:26px 28px}
    .contact-row{display:flex;gap:16px;padding:18px 0;border-bottom:1px solid #edf1f6}
    .contact-row:last-child{border-bottom:0}
    .contact-icon{width:44px;height:44px;flex:0 0 44px;display:flex;align-items:center;justify-content:center;border-radius:12px;background:#eef4fb;color:#173d68;font-size:21px}
    .contact-label{font-size:12px;color:#64748b;margin-bottom:5px}
    .contact-value{font-size:15px;line-height:1.6;white-space:pre-line;overflow-wrap:anywhere}
    .contact-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:22px}
    .contact-btn{display:inline-block;padding:10px 15px;border-radius:8px;background:#173d68;color:#fff;text-decoration:none;font-size:13px;font-weight:700}
    .contact-btn.secondary{background:#fff;color:#173d68;border:1px solid #dbe3ed}
    .contact-alert{padding:12px 14px;border-radius:8px;background:#dcfce7;color:#166534;margin-bottom:18px;font-size:13px}
    @media(max-width:600px){.contact-body{padding:18px}.contact-card-head{padding:20px}}
</style>

<div class="contact-wrap">
    <div class="contact-heading">
        <h1>Kontak Person Kanwil</h1>
        <p>Informasi alamat dan kontak admin Kantor Wilayah Kementerian Hukum Kalimantan Tengah.</p>
    </div>

    @if(session('success'))
        <div class="contact-alert">{{ session('success') }}</div>
    @endif

    <div class="contact-card">
        <div class="contact-card-head">
            <h2>Kantor Wilayah Kementerian Hukum Kalimantan Tengah</h2>
            <p>Hubungi kami untuk pertanyaan atau informasi terkait Sistem Informasi Kekayaan Intelektual.</p>
        </div>

        <div class="contact-body">
            <div class="contact-row">
                <div class="contact-icon">⌖</div>
                <div>
                    <div class="contact-label">Alamat Kantor</div>
                    <div class="contact-value">{{ $kontak?->alamat ?: 'Informasi alamat belum diisi.' }}</div>
                </div>
            </div>
            <div class="contact-row">
                <div class="contact-icon">☎</div>
                <div>
                    <div class="contact-label">Nomor Admin / WhatsApp</div>
                    <div class="contact-value">{{ $kontak?->nomor_admin ?: 'Nomor admin belum diisi.' }}</div>
                    @if($kontak?->nomor_admin)
                        @php($nomorWhatsApp = preg_replace('/\D+/', '', $kontak->nomor_admin))
                        <div class="contact-actions">
                            <a class="contact-btn" href="https://wa.me/{{ str_starts_with($nomorWhatsApp, '0') ? '62'.substr($nomorWhatsApp, 1) : $nomorWhatsApp }}" target="_blank" rel="noopener">Hubungi via WhatsApp</a>
                            <a class="contact-btn secondary" href="tel:{{ $kontak->nomor_admin }}">Telepon</a>
                        </div>
                    @endif
                </div>
            </div>
            @if($kontak?->email)
                <div class="contact-row">
                    <div class="contact-icon">✉</div>
                    <div>
                        <div class="contact-label">Email</div>
                        <div class="contact-value">{{ $kontak->email }}</div>
                        <div class="contact-actions"><a class="contact-btn secondary" href="mailto:{{ $kontak->email }}">Kirim Email</a></div>
                    </div>
                </div>
            @endif
            @if($kontak?->jam_layanan)
                <div class="contact-row">
                    <div class="contact-icon">◷</div>
                    <div>
                        <div class="contact-label">Jam Layanan</div>
                        <div class="contact-value">{{ $kontak->jam_layanan }}</div>
                    </div>
                </div>
            @endif

            @auth
                @if(auth()->user()->role === 'master')
                    <div class="contact-actions">
                        <a class="contact-btn" href="{{ route('kontak-person.edit') }}">Edit Informasi Kontak</a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
