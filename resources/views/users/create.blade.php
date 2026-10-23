
@extends('layouts.app')

@section('content')
<style>
    .user-form-page {
        max-width: 900px;
        margin: 0 auto;
        color: #263750;
    }

    .user-form-header {
        margin-bottom: 24px;
    }

    .user-form-header h2 {
        font-size: 26px;
        font-weight: 750;
        margin: 0 0 8px;
    }

    .user-form-header p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .user-form-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 4px 16px rgba(15, 35, 60, .05);
    }

    .user-form-section-title {
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 22px;
        padding-bottom: 14px;
        border-bottom: 2px solid #ffc928;
    }

    .user-form-group {
        margin-bottom: 20px;
    }

    .user-form-group label {
        display: block;
        font-size: 14px;
        font-weight: 650;
        margin-bottom: 8px;
    }

    .user-form-group input,
    .user-form-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        color: #263750;
        background: #fff;
        font-size: 14px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .user-form-group input:focus,
    .user-form-group select:focus {
        border-color: #344568;
        box-shadow: 0 0 0 3px rgba(52, 69, 104, .1);
    }

    .user-form-group input::placeholder {
        color: #a0a9b7;
    }

    .user-form-help {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
    }

    .user-form-error {
        padding: 12px 16px;
        border-radius: 7px;
        background: #fff0f0;
        color: #b42318;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .user-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #edf0f4;
        padding-top: 22px;
        margin-top: 10px;
    }

    .btn-user-save,
    .btn-user-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 20px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        border: none;
    }

    .btn-user-save {
        background: #344568;
        color: #fff;
    }

    .btn-user-save:hover {
        background: #243654;
    }

    .btn-user-cancel {
        background: #f1f5f9;
        color: #475569;
    }

    .btn-user-cancel:hover {
        background: #e2e8f0;
    }

    .user-form-note {
        background: #fff9e6;
        border-left: 4px solid #ffc928;
        padding: 12px 15px;
        border-radius: 5px;
        font-size: 13px;
        line-height: 1.6;
        color: #66531b;
        margin-bottom: 24px;
    }

    @media (max-width: 600px) {
        .user-form-card {
            padding: 20px 16px;
        }

        .user-form-header h2 {
            font-size: 22px;
        }

        .user-form-actions {
            flex-direction: column-reverse;
        }

        .btn-user-save,
        .btn-user-cancel {
            width: 100%;
            box-sizing: border-box;
        }
    }
</style>

<div class="user-form-page">
    <div class="user-form-header">
        <h2>Tambah User</h2>
        <p>Tambahkan akun pengguna baru untuk mengakses Dashboard Kekayaan Intelektual.</p>
    </div>

    <div class="user-form-card">
        <div class="user-form-note">
            Isi data pengguna dengan benar. Username akan digunakan untuk login
            dan password minimal terdiri dari 8 karakter.
        </div>

        @if($errors->any())
            <div class="user-form-error">
                <strong>Data belum dapat disimpan:</strong>
                <ul style="margin:8px 0 0; padding-left:20px">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <h3 class="user-form-section-title">Informasi Pengguna</h3>

            <div class="user-form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="user-form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       value="{{ old('username') }}"
                       placeholder="Masukkan username untuk login"
                       autocomplete="off" required>
                <small class="user-form-help">
                    Username harus unik dan tidak boleh sama dengan pengguna lain.
                </small>
            </div>

            <div class="user-form-group">
                <label for="role">Role Pengguna</label>
                <select name="role" id="role" required onchange="toggleKabupaten()">
                    <option value="kabupaten"
                        @selected(old('role', 'kabupaten') === 'kabupaten')>
                        Kabupaten/Kota
                    </option>
                    <option value="master"
                        @selected(old('role') === 'master')>
                        Master
                    </option>
                </select>
            </div>

            <div class="user-form-group" id="kabupaten-field">
                <label for="kabupaten_id">Kabupaten/Kota</label>
                <select name="kabupaten_id" id="kabupaten_id">
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @foreach($kabupaten as $kab)
                        <option value="{{ $kab->id }}"
                            @selected(old('kabupaten_id') == $kab->id)>
                            {{ $kab->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
                <small class="user-form-help">
                    Akun Kabupaten/Kota hanya dapat menginput data potensi KI
                    untuk wilayah yang dipilih.
                </small>
            </div>

            <h3 class="user-form-section-title" style="margin-top:30px">
                Keamanan Akun
            </h3>

            <div class="user-form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimal 8 karakter"
                       minlength="8" autocomplete="new-password" required>
            </div>

            <div class="user-form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Masukkan ulang password"
                       minlength="8" autocomplete="new-password" required>
            </div>

            <div class="user-form-actions">
                <a href="{{ route('users.index') }}" class="btn-user-cancel">
                    Batal
                </a>
                <button type="submit" class="btn-user-save">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleKabupaten() {
        const role = document.getElementById('role').value;
        const field = document.getElementById('kabupaten-field');
        const select = document.getElementById('kabupaten_id');

        field.style.display = role === 'kabupaten' ? 'block' : 'none';
        select.required = role === 'kabupaten';

        if (role === 'master') {
            select.value = '';
        }
    }

    toggleKabupaten();
</script>
@endsection
