@extends('layouts.app')

@section('title', $sentra->exists ? 'Edit Sentra KI' : 'Tambah Sentra KI')

@section('content')
<div style="max-width:800px;margin:0 auto;background:#fff;border:1px solid #e6edf5;border-radius:15px;padding:26px;box-shadow:0 4px 16px rgba(22,48,79,.05)">
    <h1 style="margin:0 0 8px;color:#173d68;font-size:26px">{{ $sentra->exists ? 'Edit Sentra KI' : 'Tambah Sentra KI' }}</h1>
    <p style="margin:0 0 22px;color:#718096;font-size:14px">Lengkapi nama dan alamat sentra KI.</p>

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:12px 15px;border-radius:8px;margin-bottom:18px">
            <ul style="margin:0;padding-left:20px">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $sentra->exists ? route('sentra-ki.update', $sentra) : route('sentra-ki.store') }}">
        @csrf
        @if($sentra->exists) @method('PUT') @endif
        <div style="margin-bottom:18px">
            <label for="nama_sentra" style="display:block;font-weight:700;color:#34445c;margin-bottom:8px">Nama Sentra KI</label>
            <input id="nama_sentra" name="nama_sentra" type="text" maxlength="255" required value="{{ old('nama_sentra', $sentra->nama_sentra) }}" placeholder="Masukkan nama sentra KI" style="box-sizing:border-box;width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
        </div>
        <div style="margin-bottom:22px">
            <label for="alamat" style="display:block;font-weight:700;color:#34445c;margin-bottom:8px">Alamat Sentra KI</label>
            <textarea id="alamat" name="alamat" rows="5" maxlength="5000" required placeholder="Masukkan alamat lengkap sentra KI" style="box-sizing:border-box;width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px;resize:vertical">{{ old('alamat', $sentra->alamat) }}</textarea>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
            <button type="submit" style="padding:11px 18px;background:#173d68;color:white;border:0;border-radius:8px;font-weight:700;cursor:pointer">Simpan</button>
            <a href="{{ route('sentra-ki.index') }}" style="padding:11px 18px;background:#f1f5f9;color:#334155;border-radius:8px;text-decoration:none;font-weight:700">Batal</a>
        </div>
    </form>
</div>
@endsection
