@extends('layouts.app')

@section('title', 'Tambah Data Perpustakaan KI')

@section('content')
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    >

    <style>
        .library-page {
            max-width: 1000px;
            margin: 0 auto;
        }

        .library-heading {
            margin-bottom: 24px;
        }

        .library-heading h1 {
            color: #26364f;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .library-heading p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .library-form-card {
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(31, 51, 79, 0.06);
            overflow: hidden;
        }

        .library-form-header {
            padding: 22px 28px;
            border-bottom: 1px solid #edf0f5;
            background: #fff;
        }

        .library-form-header h2 {
            margin: 0 0 6px;
            color: #26364f;
            font-size: 18px;
            font-weight: 700;
        }

        .library-form-header p {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.6;
        }

        .library-form-body {
            padding: 28px;
        }

        .library-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px 22px;
        }

        .library-field {
            display: flex;
            flex-direction: column;
            gap: 9px;
            min-width: 0;
        }

        .library-field.full {
            grid-column: 1 / -1;
        }

        .library-field label {
            color: #34445c;
            font-size: 14px;
            font-weight: 600;
        }

        .library-field .required {
            color: #dc2626;
        }

        .library-field input,
        .library-field select {
            width: 100%;
            min-height: 46px;
            box-sizing: border-box;
            padding: 11px 13px;
            border: 1px solid #d5dce6;
            border-radius: 8px;
            background: #fff;
            color: #26364f;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .library-field input::placeholder {
            color: #9ca3af;
        }

        .library-field input:focus,
        .library-field select:focus {
            border-color: #254d78;
            box-shadow: 0 0 0 3px rgba(37, 77, 120, .10);
        }

        .library-field small {
            color: #8490a2;
            font-size: 12px;
            line-height: 1.5;
        }

        .library-error {
            padding: 13px 16px;
            margin-bottom: 24px;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 13px;
        }

        .library-form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding-top: 26px;
            margin-top: 28px;
            border-top: 1px solid #edf0f5;
        }

        .library-actions-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .library-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 17px;
            box-sizing: border-box;
            border: 1px solid transparent;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s, border-color .2s;
        }

        .library-btn-primary {
            background: #1c426c;
            color: #fff;
        }

        .library-btn-primary:hover {
            background: #153454;
        }

        .library-btn-secondary {
            background: #fff;
            border-color: #d5dce6;
            color: #475569;
        }

        .library-btn-secondary:hover {
            background: #f8fafc;
        }

        /* Tampilan dropdown Select2 agar serasi dengan form */
        .library-field .select2-container {
            width: 100% !important;
            font-family: inherit;
            font-size: 14px;
        }

        .library-field .select2-container--default .select2-selection--single {
            height: 46px;
            border: 1px solid #d5dce6;
            border-radius: 8px;
            background: #fff;
        }

        .library-field .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 44px;
            padding-left: 13px;
            padding-right: 38px;
            color: #26364f;
        }

        .library-field .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af;
        }

        .library-field .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
            right: 8px;
        }

        /* Dropdown mengikuti lebar field dan tidak menutupi terlalu banyak form */
        .library-field .select2-container--open {
            z-index: 2100;
        }

        .select2-dropdown {
            border: 1px solid #d5dce6;
            border-radius: 8px;
            overflow: hidden;
            z-index: 2100;
            box-sizing: border-box;
        }

        .select2-container--default .select2-results > .select2-results__options {
            max-height: 180px;
            overflow-y: auto;
        }

        .select2-container--default .select2-results__option {
            padding: 8px 12px;
            font-family: inherit;
            font-size: 14px;
            line-height: 1.4;
        }

        .select2-container--default .select2-search--dropdown {
            padding: 8px;
            background: #fff;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            width: 100%;
            padding: 9px 11px;
            border: 1px solid #d5dce6;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background: #1c426c;
        }

        @media (max-width: 640px) {
            .library-heading h1 {
                font-size: 23px;
            }

            .library-form-header,
            .library-form-body {
                padding: 20px;
            }

            .library-form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .library-field.full {
                grid-column: auto;
            }

            .library-form-actions {
                align-items: stretch;
                flex-direction: column-reverse;
            }

            .library-actions-right {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

    <div class="library-page">

        <div class="library-heading">
            <h1>Tambah Data Perpustakaan KI</h1>
            <p>
                Tambahkan informasi hak kekayaan intelektual
                ke dalam katalog Perpustakaan KI Kalimantan Tengah.
            </p>
        </div>

        <div class="library-form-card">

            <div class="library-form-header">
                <h2>Informasi Hak Kekayaan Intelektual</h2>
                <p>Lengkapi seluruh kolom bertanda bintang (*) untuk menyimpan data.</p>
            </div>

            <div class="library-form-body">

                @if ($errors->any())
                    <div class="library-error">
                        <strong>Data belum dapat disimpan.</strong>
                        <ul style="margin:8px 0 0;padding-left:20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('perpustakaan-ki.store') }}" method="POST">
                    @csrf

                    <div style="display:grid;gap:20px;">

                        <div class="library-field">
                            <label for="data_ki_id">
                                Pilih Data KI Terdaftar <span class="required">*</span>
                            </label>

                            <select id="data_ki_id" name="data_ki_id" required>
                                <option value="">Pilih nama KI</option>

                                @foreach ($dataKI as $ki)
                                    <option value="{{ $ki->id }}" data-nama="{{ $ki->nama_ki }}"
                                        data-pemilik="{{ $ki->pemilik }}"
                                        data-jenis="{{ $ki->jenisKi->nama_jenis ?? '-' }}"
                                        data-kabupaten="{{ $ki->kabupaten->nama_kabupaten ?? '-' }}"
                                        data-tanggal="{{ $ki->tanggal_pengajuan ? \Carbon\Carbon::parse($ki->tanggal_pengajuan)->format('d-m-Y') : '-' }}"
                                        data-tahun="{{ $ki->tahun ?? '-' }}" @selected(old('data_ki_id', $selectedDataKI?->id) == $ki->id)>
                                        {{ $ki->nama_ki }}
                                    </option>
                                @endforeach
                            </select>
                           
                                <div id="konfirmasiKI"
                                    style="display:none;margin-top:24px;padding:22px;border:1px solid #dbe4ef;border-radius:12px;background:#f8fafc;">

                                    <div style="margin-bottom:20px;">
                                        <h3 style="margin:0 0 5px;color:#26364f;font-size:17px;">
                                            Konfirmasi Data KI
                                        </h3>
                                        <p style="margin:0;color:#64748b;font-size:13px;">
                                            Pastikan informasi sesuai dengan dokumen resmi.
                                        </p>
                                    </div>

                                    <div
                                        style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">

                                        <div>
                                            <small>Nama KI</small>
                                            <div id="infoNama" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Pemilik</small>
                                            <div id="infoPemilik" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Jenis KI</small>
                                            <div id="infoJenis" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Kabupaten/Kota</small>
                                            <div id="infoKabupaten" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Tanggal Pengajuan</small>
                                            <div id="infoTanggal" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Tahun</small>
                                            <div id="infoTahun" class="info-ki">-</div>
                                        </div>

                                        <div>
                                            <small>Status</small>
                                            <div class="info-ki">
                                                <span
                                                    style="padding:5px 9px;background:#dcfce7;color:#166534;border-radius:20px;">
                                                    Terdaftar
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <style>
                                    #konfirmasiKI small {
                                        display: block;
                                        margin-bottom: 5px;
                                        color: #64748b;
                                        font-size: 12px;
                                    }

                                    #konfirmasiKI .info-ki {
                                        color: #26364f;
                                        font-size: 14px;
                                        font-weight: 600;
                                        overflow-wrap: anywhere;
                                    }
                                </style>
                           
                            <small>Hanya menampilkan data dengan status terdaftar yang belum masuk katalog.</small>
                        </div>

                        <div class="library-field">
                            <label for="nomor_hak">
                                Nomor Hak <span class="required">*</span>
                            </label>

                            <input type="text" id="nomor_hak" name="nomor_hak" value="{{ old('nomor_hak') }}"
                                placeholder="Masukkan nomor hak atau pencatatan" maxlength="255" required>
                        </div>

                    </div>

                    <div class="library-form-actions">
                        <a href="{{ route('perpustakaan-ki.index') }}" class="library-btn library-btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="library-btn library-btn-primary">
                            Simpan ke Perpustakaan KI
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- jQuery harus dimuat sebelum Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('data_ki_id');
            if (dropdown && window.jQuery && jQuery.fn.select2) {
                jQuery(dropdown).select2({
                    placeholder: 'Pilih atau ketik nama KI',
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0,
                    dropdownAutoWidth: false,
                    language: {
                        noResults: function () {
                            return 'Nama KI tidak ditemukan';
                        },
                        searching: function () {
                            return 'Mencari...';
                        }
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('data_ki_id');
            const panel = document.getElementById('konfirmasiKI');

            if (!dropdown || !panel) return;

            function tampilkanInformasiKI() {
                const option = dropdown.options[dropdown.selectedIndex];

                if (!option || !option.value) {
                    panel.style.display = 'none';
                    return;
                }

                document.getElementById('infoNama').textContent =
                    option.dataset.nama || '-';

                document.getElementById('infoPemilik').textContent =
                    option.dataset.pemilik || '-';

                document.getElementById('infoJenis').textContent =
                    option.dataset.jenis || '-';

                document.getElementById('infoKabupaten').textContent =
                    option.dataset.kabupaten || '-';

                document.getElementById('infoTanggal').textContent =
                    option.dataset.tanggal || '-';

                document.getElementById('infoTahun').textContent =
                    option.dataset.tahun || '-';

                panel.style.display = 'block';
            }

            dropdown.addEventListener('change', tampilkanInformasiKI);

            // Tampilkan juga jika nama KI sudah terpilih otomatis.
            tampilkanInformasiKI();
        });
        
    </script>

@endsection
