@extends('layouts.app')

@section('title', 'Edit Kontak Person Kanwil')

@section('content')
<style>
    .contact-edit-wrap{max-width:900px;margin:0 auto;color:#26364f}
    .contact-edit-heading{margin-bottom:24px}
    .contact-edit-heading h1{font-size:27px;margin:0 0 8px;font-weight:750}
    .contact-edit-heading p{color:#64748b;margin:0;font-size:14px}
    .contact-edit-card{background:#fff;border:1px solid #e2e8f0;border-radius:15px;overflow:hidden;box-shadow:0 6px 22px rgba(15,35,60,.05)}
    .contact-edit-head{padding:20px 26px;border-bottom:1px solid #edf1f6}
    .contact-edit-head h2{font-size:17px;margin:0 0 5px}
    .contact-edit-head p{font-size:13px;color:#64748b;margin:0}
    .contact-edit-body{padding:26px}
    .contact-field{margin-bottom:20px}
    .contact-field label{display:block;font-size:13px;font-weight:700;margin-bottom:8px}
    .contact-field input,.contact-field textarea{width:100%;box-sizing:border-box;border:1px solid #dbe3ed;border-radius:8px;padding:12px;font:inherit;color:#26364f}
    .contact-field textarea{min-height:110px;resize:vertical}
    .contact-field input:focus,.contact-field textarea:focus{outline:none;border-color:#4777ad;box-shadow:0 0 0 3px rgba(71,119,173,.12)}
    .contact-error{font-size:12px;color:#dc2626;margin-top:6px}
    .contact-edit-actions{display:flex;justify-content:space-between;gap:12px;border-top:1px solid #edf1f6;padding-top:20px}
    .contact-edit-btn{border:1px solid #dbe3ed;border-radius:8px;padding:11px 16px;background:#fff;color:#475569;text-decoration:none;font-size:13px;font-weight:700;cursor:pointer}
    .contact-edit-btn.primary{background:#173d68;color:#fff;border-color:#173d68}
    @media(max-width:600px){.contact-edit-body{padding:18px}.contact-edit-head{padding:18px}}
</style>

<div class="contact-edit-wrap">
    <div class="contact-edit-heading">
        <h1>Edit Kontak Person Kanwil</h1>
        <p>Perubahan di halaman ini akan terlihat oleh seluruh pengguna, termasuk pengunjung tanpa login.</p>
    </div>

    <div class="contact-edit-card">
        <div class="contact-edit-head">
            <h2>Informasi Kontak</h2>
            <p>Isi alamat dan nomor admin yang aktif. Email dan jam layanan bersifat opsional.</p>
        </div>

        <div class="contact-edit-body">
            <form action="{{ route('kontak-person.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="contact-field">
                    <label for="alamat">Alamat Kantor <span style="color:#dc2626">*</span></label>
                    <textarea id="alamat" name="alamat" required>{{ old('alamat', $kontak->alamat) }}</textarea>
                    @error('alamat') <div class="contact-error">{{ $message }}</div> @enderror
                </div>

                <div class="contact-field">
                    <label for="nomor_admin">Nomor Admin / WhatsApp <span style="color:#dc2626">*</span></label>
                    <input id="nomor_admin" name="nomor_admin" type="text" value="{{ old('nomor_admin', $kontak->nomor_admin) }}" placeholder="Contoh: 081234567890" required>
                    @error('nomor_admin') <div class="contact-error">{{ $message }}</div> @enderror
                </div>

                <div class="contact-field">
                    <label for="email">Email (opsional)</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $kontak->email) }}" placeholder="Contoh: admin@kantor.go.id">
                    @error('email') <div class="contact-error">{{ $message }}</div> @enderror
                </div>

                <div class="contact-field">
                    <label for="jam_layanan">Jam Layanan (opsional)</label>
                    <input id="jam_layanan" name="jam_layanan" type="text" value="{{ old('jam_layanan', $kontak->jam_layanan) }}" placeholder="Contoh: Senin–Jumat, 08.00–16.00 WIB">
                    @error('jam_layanan') <div class="contact-error">{{ $message }}</div> @enderror
                </div>

                <div class="contact-edit-actions">
                    <a href="{{ route('kontak-person.index') }}" class="contact-edit-btn">Kembali</a>
                    <button type="submit" class="contact-edit-btn primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
