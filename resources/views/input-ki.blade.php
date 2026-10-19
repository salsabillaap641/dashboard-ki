
@extends('layouts.app')

@section('title', 'Input Data KI')

@section('content')
<style>
    .form-card {
        background: white;
        width: 100%;
        max-width: none;
        box-sizing: border-box;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    /* Form mengikuti lebar area konten, termasuk saat sidebar ditutup */
    .form-card form,
    .form-grid {
        width: 100%;
        min-width: 0;
    }

    .form-group {
        min-width: 0;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        max-width: 100%;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-weight: 600;
        font-size: 14px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font: inherit;
        background: white;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-actions {
        margin-top: 22px;
        display: flex;
        gap: 10px;
    }

    .btn-save {
        background: #166534;
        color: white;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
    }

    .btn-reset {
        background: #f3f4f6;
        color: #374151;
        border: none;
        padding: 11px 20px;
        border-radius: 7px;
        cursor: pointer;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 12px 16px;
        border-radius: 7px;
        margin-bottom: 18px;
    }

    .error-text {
        color: #dc2626;
        font-size: 12px;
    }


.field-error {
    display: block;
    margin-top: 6px;
    color: #dc2626;
    font-size: 13px;
    line-height: 1.4;
}


    @media (max-width: 768px) {
        .form-card {
            padding: 18px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }
    }
</style>

<div style="margin-bottom: 24px;">
    <h1 style="margin-bottom: 8px;">Input Data KI</h1>
    <p style="color: #6b7280; margin: 0;">
        Tambahkan data Kekayaan Intelektual ke dalam sistem.
    </p>
</div>

<div class="form-card">

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-success"
             style="background: #fee2e2; color: #991b1b;">
            <strong>Data belum berhasil disimpan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data-ki.store') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group full">
                <label for="nama_ki">Nama Kekayaan Intelektual *</label>
                <input
                    type="text"
                    id="nama_ki"
                    name="nama_ki"
                    value="{{ old('nama_ki') }}"
                    placeholder="Masukkan nama KI"
                    required
                >
            </div>

            <div class="form-group">
                <label for="jenis_ki_id">Jenis KI *</label>
                <select id="jenis_ki_id" name="jenis_ki_id" required>
                    <option value="">-- Pilih Jenis KI --</option>
                    @foreach ($jenisKI as $jenis)
                        <option
                            value="{{ $jenis->id }}"
                            @selected(old('jenis_ki_id') == $jenis->id)
                        >
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kabupaten_id">Kabupaten/Kota *</label>
                <select id="kabupaten_id" name="kabupaten_id" required>
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @foreach ($daftarKabupaten as $kabupaten)
                        <option
                            value="{{ $kabupaten->id }}"
                            @selected(old('kabupaten_id') == $kabupaten->id)
                        >
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pemilik">Nama Pemilik *</label>
                <input
                    type="text"
                    id="pemilik"
                    name="pemilik"
                    value="{{ old('pemilik') }}"
                    placeholder="Masukkan nama pemilik"
                    required
                >
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="terdaftar"
                        @selected(old('status') == 'terdaftar')>
                        Terdaftar
                    </option>
                    <option value="proses"
                        @selected(old('status') == 'proses')>
                        Dalam Proses
                    </option>
                    <option value="potensi"
                        @selected(old('status') == 'potensi')>
                        Potensi
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun *</label>
                <input
                    type="number"
                    id="tahun"
                    name="tahun"
                    value="{{ old('tahun', date('Y')) }}"
                    min="1900"
                    max="2100"
                    required
                >
            </div>

            
<div class="form-group">
    <label for="tanggal_pengajuan">
        Tanggal Pengajuan *
    </label>

    <input
        type="date"
        id="tanggal_pengajuan"
        name="tanggal_pengajuan"
        value="{{ old('tanggal_pengajuan') }}"
        required
    >

    @error('tanggal_pengajuan')
        <small class="field-error">{{ $message }}</small>
    @enderror
</div>


            <div class="form-group full">
                <label for="keterangan">Keterangan</label>
                <textarea
                    id="keterangan"
                    name="keterangan"
                    placeholder="Tambahkan keterangan jika diperlukan"
                >{{ old('keterangan') }}</textarea>
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                Simpan Data
            </button>

            <button type="reset" class="btn-reset">
                Reset
            </button>
        </div>
    </form>
</div>
@endsection
