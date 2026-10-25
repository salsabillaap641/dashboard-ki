@extends('layouts.app')

@section('title', 'Tambah Data Perpustakaan KI')

@section('content')
<style>
    .library-form-page{max-width:900px;margin:0 auto;color:#26364f}
    .library-form-heading{margin-bottom:24px}
    .library-form-heading h1{margin:0 0 8px;font-size:26px;font-weight:750}
    .library-form-heading p{margin:0;color:#64748b;font-size:14px}
    .library-form-card{background:#fff;border:1px solid #e2e8f0;border-radius:15px;box-shadow:0 6px 22px rgba(15,35,60,.05);overflow:hidden}
    .library-form-card-head{padding:20px 26px;border-bottom:1px solid #edf1f6}
    .library-form-card-head h2{margin:0 0 5px;font-size:17px;font-weight:750}
    .library-form-card-head p{margin:0;color:#64748b;font-size:13px}
    .library-form-body{padding:26px}
    .library-form-group{margin-bottom:20px}
    .library-form-group label{display:block;font-size:13px;font-weight:700;margin-bottom:8px}
    .library-form-group input,.library-form-group select{width:100%;box-sizing:border-box;padding:12px;border:1px solid #dbe3ed;border-radius:8px;font:inherit;background:#fff;color:#26364f}
    .library-form-group input:focus,.library-form-group select:focus{outline:none;border-color:#4777ad;box-shadow:0 0 0 3px rgba(71,119,173,.12)}
    .library-form-error{font-size:12px;color:#dc2626;margin-top:6px}
    .library-form-actions{display:flex;justify-content:space-between;gap:12px;border-top:1px solid #edf1f6;padding-top:20px;margin-top:8px}
    .library-form-btn{display:inline-block;padding:11px 16px;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;cursor:pointer;border:1px solid #dbe3ed;background:#fff;color:#475569}
    .library-form-btn-primary{background:#1e4775;color:#fff;border-color:#1e4775}
    @media(max-width:600px){.library-form-body{padding:18px}.library-form-card-head{padding:18px}.library-form-actions{flex-wrap:wrap}}
</style>

<div class="library-form-page">
    <div class="library-form-heading">
        <h1>Tambah Data Perpustakaan KI</h1>
        <p>Masukkan nama HAKI, nomor permohonan, dan jenis KI sesuai dokumen yang tersedia.</p>
    </div>

    <div class="library-form-card">
        <div class="library-form-card-head">
            <h2>Informasi Hak Kekayaan Intelektual</h2>
            <p>Lengkapi seluruh kolom berikut untuk menyimpan data.</p>
        </div>

        <div class="library-form-body">
            @if ($errors->any())
                <div style="padding:12px 14px;margin-bottom:18px;border-radius:8px;background:#fee2e2;color:#991b1b;font-size:13px;">
                    Periksa kembali data yang dimasukkan.
                </div>
            @endif

            <form action="{{ route('perpustakaan-ki.store') }}" method="POST">
                @csrf

                <div class="library-form-group">
                    <label for="nama_hak">Nama HAKI <span style="color:#dc2626">*</span></label>
                    <input type="text" id="nama_hak" name="nama_hak" value="{{ old('nama_hak') }}" placeholder="Masukkan nama HAKI" required>
                    @error('nama_hak') <div class="library-form-error">{{ $message }}</div> @enderror
                </div>

                <div class="library-form-group">
                    <label for="nomor_permohonan">Nomor Permohonan <span style="color:#dc2626">*</span></label>
                    <input type="text" id="nomor_permohonan" name="nomor_permohonan" value="{{ old('nomor_permohonan') }}" placeholder="Masukkan nomor permohonan" required>
                    @error('nomor_permohonan') <div class="library-form-error">{{ $message }}</div> @enderror
                </div>

                <div class="library-form-group">
                    <label for="jenis_ki_id">Jenis KI <span style="color:#dc2626">*</span></label>
                    <select id="jenis_ki_id" name="jenis_ki_id" required>
                        <option value="">-- Pilih Jenis KI --</option>
                        @foreach ($jenisKi as $jenis)
                            <option value="{{ $jenis->id }}" {{ (string) old('jenis_ki_id') === (string) $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_ki_id') <div class="library-form-error">{{ $message }}</div> @enderror
                </div>

                <div class="library-form-actions">
                    <a href="{{ route('perpustakaan-ki.index') }}" class="library-form-btn">Kembali</a>
                    <button type="submit" class="library-form-btn library-form-btn-primary">Simpan ke Perpustakaan KI</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
