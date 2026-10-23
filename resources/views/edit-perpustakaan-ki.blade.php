
@extends('layouts.app')

@section('title', 'Edit Data Perpustakaan KI')

@section('content')
<div style="width:100%;box-sizing:border-box;padding:24px;">
    <h1>Edit Data Perpustakaan KI</h1>
    <p>Perbarui nomor hak pada katalog Perpustakaan KI.</p>

    <div style="background:white;padding:24px;border-radius:12px;">
        <div style="margin-bottom:18px;">
            <label>Nama KI</label>
            <input type="text"
                value="{{ $perpustakaanKi->dataKi->nama_ki ?? $perpustakaanKi->nama_hak }}"
                readonly
                style="display:block;width:100%;padding:12px;margin-top:6px;background:#f8fafc;border:1px solid #ddd;border-radius:7px;">
        </div>

        <div style="margin-bottom:18px;">
            <label>Jenis KI</label>
            <input type="text"
                value="{{ $perpustakaanKi->jenisKi->nama_jenis ?? '-' }}"
                readonly
                style="display:block;width:100%;padding:12px;margin-top:6px;background:#f8fafc;border:1px solid #ddd;border-radius:7px;">
        </div>

        <div style="margin-bottom:18px;">
            <label>Kabupaten/Kota</label>
            <input type="text"
                value="{{ $perpustakaanKi->kabupaten->nama_kabupaten ?? '-' }}"
                readonly
                style="display:block;width:100%;padding:12px;margin-top:6px;background:#f8fafc;border:1px solid #ddd;border-radius:7px;">
        </div>

        <form action="{{ route('perpustakaan-ki.update', $perpustakaanKi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label for="nomor_hak">Nomor Hak *</label>
                <input
                    type="text"
                    id="nomor_hak"
                    name="nomor_hak"
                    value="{{ old('nomor_hak', $perpustakaanKi->nomor_hak) }}"
                    required
                    maxlength="255"
                    style="display:block;width:100%;box-sizing:border-box;padding:12px;margin-top:6px;border:1px solid #ddd;border-radius:7px;">

                @error('nomor_hak')
                    <small style="color:#dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <a href="{{ route('perpustakaan-ki.index') }}">Kembali</a>
            <button type="submit"
                style="padding:11px 18px;background:#1d4774;color:white;border:0;border-radius:7px;cursor:pointer;">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
