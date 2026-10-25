@extends('layouts.app')
@section('title', 'Detail Perpustakaan KI')
@section('content')
<div style="max-width:900px;margin:auto;">
<div style="margin-bottom:24px;"><a href="{{ route('perpustakaan-ki.index') }}" style="color:#1c426c;text-decoration:none;">← Kembali ke Perpustakaan KI</a><h1 style="color:#26364f;margin-bottom:8px;">Detail Perpustakaan KI</h1><p style="color:#6b7280;">Informasi nama HAKI dan nomor permohonan.</p></div>
<div style="background:white;padding:28px;border-radius:14px;border:1px solid #e8edf3;"><h2 style="color:#1c426c;margin-top:0;">{{ $item->nama_hak }}</h2><table style="width:100%;border-collapse:collapse;"><tr><td style="padding:12px 0;width:35%;">Nama HAKI</td><td style="padding:12px 0;">{{ $item->nama_hak }}</td></tr><tr><td style="padding:12px 0;">Nomor Permohonan</td><td style="padding:12px 0;">{{ $item->nomor_permohonan ?: '-' }}</td></tr></table></div></div>
@endsection
