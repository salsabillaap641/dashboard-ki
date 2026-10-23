@extends('layouts.app')

@section('title', 'Detail Data KI')

@section('content')
    <div style="margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
        <div>
            <h1 style="margin-bottom:8px;">Detail Data Kekayaan Intelektual</h1>
            <p style="color:#6b7280;margin:0;">Informasi lengkap data KI yang tersimpan di database.</p>
        </div>
        <a href="{{ route('data-ki.index') }}" style="padding:10px 16px;background:#f3f4f6;color:#374151;border-radius:7px;text-decoration:none;">← Kembali ke Data KI</a>
    </div>

    <div style="background:white;padding:24px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);max-width:900px;">
        <h2 style="margin:0 0 20px;color:#1f2937;">{{ $ki->nama_ki }}</h2>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;">
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Jenis KI</div><div style="font-weight:600;">{{ $ki->jenisKi->nama_jenis ?? '-' }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Kabupaten/Kota</div><div style="font-weight:600;">{{ $ki->kabupaten->nama_kabupaten ?? '-' }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Pemilik</div><div style="font-weight:600;">{{ $ki->pemilik ?: '-' }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Nomor Kontak</div><div style="font-weight:600;">{{ $ki->nomor_kontak ?: '-' }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Status</div><div style="font-weight:600;">{{ ucfirst($ki->status ?? '-') }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Tahun</div><div style="font-weight:600;">{{ $ki->tahun ?: '-' }}</div></div>
            <div><div style="font-size:12px;color:#6b7280;margin-bottom:5px;">Tanggal Pengajuan</div><div style="font-weight:600;">{{ $ki->tanggal_pengajuan ? \Carbon\Carbon::parse($ki->tanggal_pengajuan)->format('d-m-Y') : '-' }}</div></div>
        </div>

        <div style="margin-top:24px;padding-top:20px;border-top:1px solid #e5e7eb;">
            <div style="font-size:12px;color:#6b7280;margin-bottom:7px;">Keterangan</div>
            <div style="white-space:pre-line;line-height:1.7;">{{ $ki->keterangan ?: '-' }}</div>
        </div>

        <div style="margin-top:24px;padding-top:20px;border-top:1px solid #e5e7eb;">
            <div style="font-size:12px;color:#6b7280;margin-bottom:7px;">Bukti Pendukung</div>
            @if ($ki->bukti_pendukung)
                <a href="{{ asset('storage/' . $ki->bukti_pendukung) }}" target="_blank" rel="noopener noreferrer" style="color:#166534;font-weight:600;text-decoration:underline;">Lihat / Unduh Bukti Pendukung</a>
            @else
                <span style="color:#6b7280;">Belum ada bukti pendukung.</span>
            @endif
        </div>

        <div style="margin-top:28px;display:flex;gap:10px;flex-wrap:wrap;">
            <a href="{{ route('data-ki.edit', $ki->id) }}" style="padding:10px 16px;background:#166534;color:white;border-radius:7px;text-decoration:none;">Edit Data</a>
            <a href="{{ route('data-ki.index') }}" style="padding:10px 16px;background:#f3f4f6;color:#374151;border-radius:7px;text-decoration:none;">Kembali</a>
        </div>
    </div>
@endsection
