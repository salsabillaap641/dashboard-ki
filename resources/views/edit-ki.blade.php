
@extends('layouts.app')

@section('title', 'Edit Data KI')

@section('content')
<style>
    .edit-card {
        background: white;
        padding: 24px;
        border-radius: 12px;
        max-width: 850px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
    }

    .edit-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    .field input,
    .field select,
    .field textarea {
        box-sizing: border-box;
        width: 100%;
        padding: 11px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font: inherit;
    }

    .field textarea {
        min-height: 100px;
    }

    .save-btn {
        background: #166534;
        color: white;
        border: none;
        padding: 11px 18px;
        border-radius: 7px;
        cursor: pointer;
    }

    .back-link {
        color: #166534;
        text-decoration: none;
        margin-left: 12px;
    }

    @media (max-width: 600px) {
        .edit-grid {
            grid-template-columns: 1fr;
        }

        .field.full {
            grid-column: auto;
        }
    }
</style>

<h1>Edit Data KI</h1>
<p style="color:#6b7280;">Perbarui informasi Kekayaan Intelektual.</p>

<div class="edit-card">
    @if ($errors->any())
        <div style="color:#b91c1c;margin-bottom:16px;">
            <strong>Periksa kembali data yang diisi:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data-ki.update', $ki->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="edit-grid">
            <div class="field full">
                <label for="nama_ki">Nama KI *</label>
                <input id="nama_ki" name="nama_ki"
                       value="{{ old('nama_ki', $ki->nama_ki) }}"
                       required>
            </div>

            <div class="field">
                <label for="jenis_ki_id">Jenis KI *</label>
                <select id="jenis_ki_id" name="jenis_ki_id" required>
                    @foreach ($jenisKI as $jenis)
                        <option value="{{ $jenis->id }}"
                            @selected(old('jenis_ki_id', $ki->jenis_ki_id) == $jenis->id)>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="kabupaten_id">Kabupaten/Kota *</label>
                <select id="kabupaten_id" name="kabupaten_id" required>
                    @foreach ($daftarKabupaten as $kabupaten)
                        <option value="{{ $kabupaten->id }}"
                            @selected(old('kabupaten_id', $ki->kabupaten_id) == $kabupaten->id)>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="pemilik">Pemilik *</label>
                <input id="pemilik" name="pemilik"
                       value="{{ old('pemilik', $ki->pemilik) }}"
                       required>
            </div>

            <div class="field">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    @foreach ([
                        'terdaftar' => 'Terdaftar',
                        'proses' => 'Proses',
                        'potensi' => 'Potensi'
                    ] as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('status', $ki->status) == $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="tahun">Tahun *</label>
                <input type="number" id="tahun" name="tahun"
                       min="1900" max="2100"
                       value="{{ old('tahun', $ki->tahun) }}" required>
            </div>

            <div class="field">
                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                <input type="date" id="tanggal_pengajuan"
                       name="tanggal_pengajuan"
                       value="{{ old('tanggal_pengajuan', $ki->tanggal_pengajuan) }}">
            </div>

            <div class="field full">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan">{{ old('keterangan', $ki->keterangan) }}</textarea>
            </div>
        </div>

        <div style="margin-top:22px;">
            <button class="save-btn" type="submit">Simpan Perubahan</button>
            <a class="back-link" href="{{ route('data-ki.index') }}">Batal</a>
        </div>
    </form>
</div>
@endsection
