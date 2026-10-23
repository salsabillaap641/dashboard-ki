@extends('layouts.app')

@section('title', 'Dashboard KI Kalteng')

@push('styles')
    <style>
        .last-update-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
        }

        .last-update-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            flex-shrink: 0;
        }

        .dashboard {
            width: 100%;
            max-width: none;
            margin: 0;
        }

        .dashboard-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 16px;
            margin-bottom: 22px;
        }

        .dashboard-heading h1 {
            margin: 0;
            color: #173d68;
            font-size: 30px;
            font-weight: 750;
            letter-spacing: -.5px;
        }

        .dashboard-heading p {
            margin: 7px 0 0;
            color: #718096;
            font-size: 14px;
        }

        .dashboard-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #2563eb;
            background: #eff6ff;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .panel {
            background: #fff;
            border: 1px solid #e9eef5;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(22, 48, 79, .045);
        }

        .filter-panel {
            padding: 19px 20px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: minmax(190px, 1fr) minmax(190px, 1fr) auto auto;
            gap: 14px;
            align-items: end;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 0;
        }

        .filter-field label {
            font-size: 12px;
            font-weight: 700;
            color: #34445c;
        }

        .filter-field select {
            width: 100%;
            min-height: 43px;
            border: 1px solid #dce4ee;
            border-radius: 8px;
            padding: 10px 12px;
            background: #fff;
            color: #263449;
            font: inherit;
            font-size: 13px;
        }

        .filter-btn {
            min-height: 43px;
            padding: 0 18px;
            border: 0;
            border-radius: 8px;
            background: #173d68;
            color: #fff;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
        }

        .filter-reset {
            min-height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 17px;
            border: 1px solid #dce4ee;
            border-radius: 8px;
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .filter-btn:hover {
            background: #102f52;
        }

        .filter-reset:hover {
            background: #f8fafc;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .kpi-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            min-width: 0;
        }

        .kpi-icon {
            width: 49px;
            height: 49px;
            flex: 0 0 49px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            font-size: 23px;
            font-weight: 800;
        }

        .kpi-icon.blue {
            background: #e8f2ff;
            color: #2474d8;
        }

        .kpi-icon.green {
            background: #e4f9ed;
            color: #159455;
        }

        .kpi-icon.amber {
            background: #fff4d8;
            color: #d97706;
        }

        .kpi-icon.purple {
            background: #f2eaff;
            color: #8954d8;
        }

        .kpi-title {
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .kpi-number {
            color: #173d68;
            font-size: 29px;
            font-weight: 800;
            line-height: 1.15;
        }

        .kpi-note {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 11px;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.8fr) minmax(300px, .9fr);
            gap: 16px;
            margin-bottom: 20px;
            align-items: stretch;
        }

        .chart-panel.potensi-chart-panel {
            grid-column: 1 / -1;
        }

        .chart-panel {
            padding: 21px 22px;
            min-width: 0;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .panel-heading h2 {
            margin: 0;
            color: #173d68;
            font-size: 17px;
            font-weight: 750;
        }

        .panel-heading p {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .chart-area {
            position: relative;
            height: 310px;
        }

        .donut-area {
            position: relative;
            height: 260px;
        }

        .table-panel {
            padding: 21px 22px;
            margin-bottom: 20px;
        }

        .table-action {
            padding: 9px 13px;
            border-radius: 8px;
            background: #173d68;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            white-space: nowrap;
        }

        .dashboard-table th {
            background: #f7f9fc;
            color: #526176;
            font-size: 11px;
            font-weight: 700;
            text-align: left;
            padding: 13px 12px;
            border-bottom: 1px solid #e8edf4;
        }

        .dashboard-table td {
            color: #475569;
            font-size: 12px;
            padding: 13px 12px;
            border-bottom: 1px solid #edf1f6;
        }

        .dashboard-table tbody tr:hover {
            background: #f8fbff;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .number-cell {
            color: #173d68 !important;
            font-weight: 800;
        }

        .status-pill {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-pill.terdaftar {
            background: #dcfce7;
            color: #166534;
        }

        .status-pill.proses {
            background: #fef3c7;
            color: #92400e;
        }

        .status-pill.potensi {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .empty-row {
            text-align: center !important;
            color: #94a3b8 !important;
            padding: 28px !important;
        }

        @media (max-width:1100px) {
            .kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .analytics-grid {
                grid-template-columns: minmax(0, 1.4fr) minmax(280px, 1fr);
            }
        }

        @media (max-width:760px) {
            .dashboard-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-heading h1 {
                font-size: 25px;
            }

            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .analytics-grid {
                grid-template-columns: 1fr;
            }

            .chart-area {
                height: 280px;
            }

            .donut-area {
                height: 250px;
            }

            .chart-panel,
            .table-panel {
                padding: 17px;
            }
        }

        @media (max-width:480px) {
            .kpi-grid {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .kpi-card {
                padding: 16px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-btn,
            .filter-reset {
                width: 100%;
            }
        }


        .ki-slider {
            position: relative;
            width: 100%;
            min-height: 310px;
            margin: 24px 0;
            overflow: hidden;
            border-radius: 18px;
            background: linear-gradient(115deg, #102f55, #174a78 65%, #2475a5);
            color: #fff;
            box-shadow: 0 10px 30px rgba(15, 45, 80, .12);
        }

        .ki-slide {
            display: none;
            min-height: 310px;
            box-sizing: border-box;
            padding: 34px 76px 48px 38px;
            grid-template-columns: minmax(0, 1.5fr) minmax(180px, .7fr);
            align-items: center;
            gap: 28px;
            animation: kiFade .45s ease;
        }

        .ki-slide.active {
            display: grid;
        }

        .ki-slide-content {
            min-width: 0;
            position: relative;
            z-index: 2;
        }

        .ki-eyebrow {
            display: inline-block;
            margin-bottom: 12px;
            color: #a8dcff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .ki-slide h2 {
            margin: 0 0 12px;
            color: #fff;
            font-size: clamp(23px, 2.3vw, 34px);
            line-height: 1.2;
            letter-spacing: -.6px;
        }

        .ki-slide p {
            max-width: 560px;
            margin: 0;
            color: #d8e8f7;
            font-size: 14px;
            line-height: 1.7;
        }

        .ki-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-top: 24px;
        }

        .ki-stats>div,
        .ki-growth-card,
        .ki-region-card {
            padding: 13px 15px;
            border: 1px solid rgba(255, 255, 255, .17);
            border-radius: 11px;
            background: rgba(255, 255, 255, .09);
            backdrop-filter: blur(8px);
        }

        .ki-stats span,
        .ki-growth-card span,
        .ki-region-card span {
            display: block;
            color: #d8e8f7;
            font-size: 11px;
        }

        .ki-stats strong {
            display: block;
            margin-top: 7px;
            color: #fff;
            font-size: 25px;
        }

        .ki-growth {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .ki-growth-card {
            min-width: 145px;
        }

        .ki-growth-card strong,
        .ki-region-card strong {
            display: block;
            margin: 7px 0;
            color: #fff;
            font-size: 26px;
        }

        .ki-growth-card small,
        .ki-region-card small {
            color: #bfe4ff;
            font-size: 11px;
        }

        .ki-region-card {
            margin-top: 22px;
            max-width: 370px;
        }

        .ki-region-card strong {
            font-size: 21px;
        }

        .ki-visual {
            min-height: 190px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .ki-circle,
        .region-ring {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 50%;
        }

        .circle-one {
            width: 205px;
            height: 205px;
            background: rgba(255, 255, 255, .035);
        }

        .circle-two {
            width: 145px;
            height: 145px;
            background: rgba(119, 205, 255, .09);
        }

        .ki-visual-icon {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, .8);
            border-radius: 25px;
            background: rgba(255, 255, 255, .12);
            color: #fff;
            font-size: 36px;
            font-weight: 900;
            transform: rotate(-7deg);
        }

        .ki-visual-caption {
            position: absolute;
            bottom: 0;
            color: #bfe4ff;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .mini-bar {
            position: absolute;
            bottom: 25px;
            width: 24px;
            border-radius: 6px 6px 0 0;
            background: linear-gradient(#9bdcff, #3e9ddd);
        }

        .bar-a {
            height: 45px;
            left: 12%;
        }

        .bar-b {
            height: 75px;
            left: 29%;
        }

        .bar-c {
            height: 60px;
            left: 46%;
        }

        .bar-d {
            height: 110px;
            left: 63%;
        }

        .bar-e {
            height: 145px;
            left: 80%;
        }

        .growth-line {
            position: absolute;
            top: 15px;
            right: 10%;
            color: #a8dcff;
            font-size: 45px;
        }

        .region-ring.ring-one {
            width: 210px;
            height: 210px;
            border-style: dashed;
        }

        .region-ring.ring-two {
            width: 145px;
            height: 145px;
            background: rgba(255, 255, 255, .06);
        }

        .region-symbol {
            color: #fff;
            font-size: 90px;
            line-height: 1;
        }

        .ki-arrow {
            position: absolute;
            top: 45%;
            z-index: 3;
            width: 36px;
            height: 36px;
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            color: #fff;
            font-size: 25px;
            line-height: 1;
            cursor: pointer;
            transition: background .2s;
        }

        .ki-arrow:hover {
            background: rgba(255, 255, 255, .28);
        }

        .ki-prev {
            left: 12px;
        }

        .ki-next {
            right: 12px;
        }

        .ki-dots {
            position: absolute;
            bottom: 17px;
            left: 0;
            right: 0;
            z-index: 4;
            display: flex;
            justify-content: center;
            gap: 7px;
        }

        .ki-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            border: 0;
            border-radius: 10px;
            background: rgba(255, 255, 255, .4);
            cursor: pointer;
            transition: width .2s, background .2s;
        }

        .ki-dot.active {
            width: 23px;
            background: #fff;
        }

        @keyframes kiFade {
            from {
                opacity: .4;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 850px) {
            .ki-slide {
                grid-template-columns: 1fr;
                padding: 28px 55px 48px 24px;
                gap: 10px;
            }

            .ki-visual {
                display: none;
            }

            .ki-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {

            .ki-slider,
            .ki-slide {
                min-height: 360px;
            }

            .ki-stats strong {
                font-size: 21px;
            }

            .ki-growth-card {
                min-width: 0;
                flex: 1;
            }
        }
    
    .jenis-ki-panel { margin-top: 24px; }
    .jenis-ki-chart-area { position: relative; height: 390px; padding: 8px 16px 0; }
    .jenis-ki-summary { display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:12px; padding:0 18px 20px; }
    .jenis-ki-summary-item { display:flex; flex-direction:column; gap:8px; padding:14px 16px; background:#f7faff; border:1px solid #e8eef7; border-radius:12px; }
    .jenis-ki-name { color:#64748b; font-size:12px; font-weight:600; }
    .jenis-ki-summary-item strong { color:#173d68; font-size:22px; font-weight:800; }
    @media(max-width:640px) { .jenis-ki-chart-area { height:300px; padding:8px 8px 0; } .jenis-ki-summary { padding:0 12px 16px; grid-template-columns:repeat(2,minmax(0,1fr)); } }

</style>
@endpush

@section('content')
    <div class="dashboard">
        <div class="dashboard-heading">
            <div>
                <h1>Dashboard KI Kalteng</h1>
                <p>Ringkasan data Kekayaan Intelektual Kalimantan Tengah</p>
            </div>

            <div class="last-update-badge">
                <span class="last-update-dot"></span>
                <span>
                    Last Update:
                    {{ now()->translatedFormat('d F Y') }}
                    pukul {{ now()->format('H:i') }} WIB
                </span>
            </div>

        </div>


        <div class="ki-slider" id="kiSlider">

            <!-- SLIDE 1: STATISTIK KI -->
            <section class="ki-slide active">
                <div class="ki-slide-content">
                    <span class="ki-eyebrow">SISTEM INFORMASI KEKAYAAN INTELEKTUAL</span>
                    <h2>Kenali Potensi KI<br>Kalimantan Tengah</h2>
                    <p>Ringkasan perkembangan Kekayaan Intelektual di wilayah Kalimantan Tengah.</p>

                    <div class="ki-stats">
                        <div>
                            <span>Total KI</span>
                            <strong>{{ number_format($totalKI, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span>Terdaftar</span>
                            <strong>{{ number_format($terdaftar, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span>Dalam Proses</span>
                            <strong>{{ number_format($proses, 0, ',', '.') }}</strong>
                        </div>
                        <div>
                            <span>Potensi KI</span>
                            <strong>{{ number_format($potensi, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="ki-visual">
                    <div class="ki-circle circle-one"></div>
                    <div class="ki-circle circle-two"></div>
                    <div class="ki-visual-icon">KI</div>
                    <span class="ki-visual-caption">KALTENG</span>
                </div>
            </section>

            <!-- SLIDE 2: PERKEMBANGAN -->
            <section class="ki-slide">
                <div class="ki-slide-content">
                    <span class="ki-eyebrow">PERKEMBANGAN DATA</span>
                    <h2>Terus Dorong Pertumbuhan<br>Kekayaan Intelektual</h2>
                    <p>Statistik penambahan data berdasarkan waktu pencatatan di sistem.</p>

                    <div class="ki-growth">
                        <div class="ki-growth-card">
                            <span>Ditambahkan Hari Ini</span>
                            <strong>{{ $kiHariIni ?? '-' }}</strong>
<small>Belum tersedia data tanggal pencatatan</small>
                        </div>
                        <div class="ki-growth-card">
                            <span>Ditambahkan Bulan Ini</span>
                            <strong>{{ $kiBulanIni ?? '-' }}</strong>
<small>Belum tersedia data tanggal pencatatan</small>
                        </div>
                    </div>
                </div>

                <div class="ki-visual growth-visual">
                    <div class="mini-bar bar-a"></div>
                    <div class="mini-bar bar-b"></div>
                    <div class="mini-bar bar-c"></div>
                    <div class="mini-bar bar-d"></div>
                    <div class="mini-bar bar-e"></div>
                    <div class="growth-line">↗</div>
                    <span class="ki-visual-caption">DATA BERTUMBUH</span>
                </div>
            </section>

            <!-- SLIDE 3: SEBARAN WILAYAH -->
            <section class="ki-slide">
                <div class="ki-slide-content">
                    <span class="ki-eyebrow">SEBARAN KEKAYAAN INTELEKTUAL</span>
                    <h2>Angkat Potensi Unggulan<br>Daerah Kita</h2>
                    <p>Identifikasi wilayah dengan pencatatan KI terbanyak untuk mendukung pemetaan potensi daerah.</p>

                    <div class="ki-region-card">
                        <span>Kabupaten/Kota dengan data KI terbanyak</span>
                        <strong>
                            {{ $kabupatenTerbanyak->nama_kabupaten ?? 'Belum tersedia' }}
                        </strong>
                        <small>
                            {{ isset($kabupatenTerbanyak->total)
                                ? number_format($kabupatenTerbanyak->total, 0, ',', '.') . ' data KI'
                                : 'Belum ada data' }}
                        </small>
                    </div>
                </div>

                <div class="ki-visual region-visual">
                    <div class="region-ring ring-one"></div>
                    <div class="region-ring ring-two"></div>
                    <div class="region-symbol">⌖</div>
                    <span class="ki-visual-caption">KI KALTENG</span>
                </div>
            </section>

            <!-- NAVIGASI -->
            <button type="button" class="ki-arrow ki-prev" aria-label="Slide sebelumnya"
                onclick="geserSlideKI(-1)">‹</button>

            <button type="button" class="ki-arrow ki-next" aria-label="Slide berikutnya"
                onclick="geserSlideKI(1)">›</button>

            <div class="ki-dots">
                <button type="button" class="ki-dot active" aria-label="Slide 1" onclick="pilihSlideKI(0)"></button>
                <button type="button" class="ki-dot" aria-label="Slide 2" onclick="pilihSlideKI(1)"></button>
                <button type="button" class="ki-dot" aria-label="Slide 3" onclick="pilihSlideKI(2)"></button>
            </div>
        </div>


        <section class="panel filter-panel">
            <form class="filter-form" method="GET" action="{{ url('/') }}">
                <div class="filter-field">
                    <label for="jenis_ki_id">Jenis Kekayaan Intelektual</label>
                    <select name="jenis_ki_id" id="jenis_ki_id">
                        <option value="">Semua Jenis KI</option>
                        @foreach ($jenisKI as $jenis)
                            <option value="{{ $jenis->id }}"
                                {{ (string) $jenisKiId === (string) $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-field">
                    <label for="kabupaten_id">Kabupaten/Kota</label>
                    <select name="kabupaten_id" id="kabupaten_id">
                        <option value="">Semua Kabupaten/Kota</option>
                        @foreach ($daftarKabupaten as $kab)
                            <option value="{{ $kab->id }}"
                                {{ (string) $kabupatenId === (string) $kab->id ? 'selected' : '' }}>
                                {{ $kab->nama_kabupaten }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="filter-btn" type="submit">Terapkan Filter</button>
                <a class="filter-reset" href="{{ url('/') }}">Reset</a>
            </form>
        </section>

        @php
            $totalAman = max((int) $totalKI, 0);
            $persenTerdaftar = $totalAman ? round(($terdaftar / $totalAman) * 100, 1) : 0;
            $persenProses = $totalAman ? round(($proses / $totalAman) * 100, 1) : 0;
            $persenPotensi = $totalAman ? round(($potensi / $totalAman) * 100, 1) : 0;
        @endphp

        <section class="kpi-grid">
            <div class="panel kpi-card">
                <div class="kpi-icon blue">▰</div>
                <div>
                    <div class="kpi-title">Total KI</div>
                    <div class="kpi-number">{{ number_format($totalKI, 0, ',', '.') }}</div>
                    <div class="kpi-note">Terdaftar + dalam proses</div>
                </div>
            </div>
            <div class="panel kpi-card">
                <div class="kpi-icon green">✓</div>
                <div>
                    <div class="kpi-title">Sudah Terdaftar</div>
                    <div class="kpi-number">{{ number_format($terdaftar, 0, ',', '.') }}</div>
                    <div class="kpi-note">{{ number_format($persenTerdaftar, 1, ',', '.') }}% dari total KI</div>
                </div>
            </div>
            <div class="panel kpi-card">
                <div class="kpi-icon amber">◷</div>
                <div>
                    <div class="kpi-title">Dalam Proses</div>
                    <div class="kpi-number">{{ number_format($proses, 0, ',', '.') }}</div>
                    <div class="kpi-note">{{ number_format($persenProses, 1, ',', '.') }}% dari total KI</div>
                </div>
            </div>
            <div class="panel kpi-card">
                <div class="kpi-icon purple">✦</div>
                <div>
                    <div class="kpi-title">Potensi KI</div>
                    <div class="kpi-number">{{ number_format($potensi, 0, ',', '.') }}</div>
                    <div class="kpi-note">Dihitung terpisah dari total KI terverifikasi</div>
                </div>
            </div>
        </section>

        <section class="analytics-grid">
            <div class="panel chart-panel">
                <div class="panel-heading">
                    <div>
                        <h2>KI Terverifikasi per Kabupaten/Kota</h2>
                        <p>Jumlah KI terdaftar dan dalam proses berdasarkan rekap terverifikasi</p>
                    </div>
                </div>
                <div class="chart-area"><canvas id="kiChart"></canvas></div>
            </div>
            <div class="panel chart-panel">
                <div class="panel-heading">
                    <div>
                        <h2>Status KI</h2>
                        <p>Komposisi KI terverifikasi: terdaftar dan dalam proses</p>
                    </div>
                </div>
                <div class="donut-area"><canvas id="statusChart"></canvas></div>
            </div>
            <div class="panel chart-panel potensi-chart-panel">
                <div class="panel-heading">
                    <div>
                        <h2>Potensi KI per Kabupaten/Kota</h2>
                        <p>Jumlah KI potensi dari data aplikasi, terpisah dari data KI terverifikasi</p>
                    </div>
                </div>
                <div class="chart-area"><canvas id="potensiChart"></canvas></div>
            </div>
        </section>

        <section class="panel table-panel jenis-ki-panel">
            <div class="panel-heading">
                <div>
                    <h2>Jumlah KI per Jenis</h2>
                    <p>Jumlah KI terdaftar berdasarkan rekap data terbaru</p>
                </div>
            </div>
            <div class="chart-area jenis-ki-chart-area">
                <canvas id="jenisKiChart"></canvas>
            </div>
            <div class="jenis-ki-summary" id="jenisKiSummary">
                @forelse ($jenisKI as $jenis)
                    <div class="jenis-ki-summary-item">
                        <span class="jenis-ki-name">{{ $jenis->nama_jenis }}</span>
                        <strong>{{ number_format($jenis->total_terdaftar ?? 0, 0, ',', '.') }}</strong>
                    </div>
                @empty
                    <p class="empty-row">Belum ada data rekap KI.</p>
                @endforelse
            </div>
        </section>




    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let slideKIIndex = 0;
    let slideKITimer;

    function tampilkanSlideKI(index) {
        const slider = document.getElementById('kiSlider');
        if (!slider) return;

        const slides = slider.querySelectorAll('.ki-slide');
        const dots = slider.querySelectorAll('.ki-dot');

        slideKIIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === slideKIIndex);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === slideKIIndex);
        });
    }

    function geserSlideKI(arah) {
        tampilkanSlideKI(slideKIIndex + arah);
        mulaiOtomatisSlideKI();
    }

    function pilihSlideKI(index) {
        tampilkanSlideKI(index);
        mulaiOtomatisSlideKI();
    }

    function mulaiOtomatisSlideKI() {
        clearInterval(slideKITimer);
        slideKITimer = setInterval(() => {
            tampilkanSlideKI(slideKIIndex + 1);
        }, 6000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        tampilkanSlideKI(0);
        mulaiOtomatisSlideKI();
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($chartLabels);
            const terdaftar = @json($chartTerdaftar);
            const proses = @json($chartProses);
            const potensi = @json($chartPotensi);

            const barCanvas = document.getElementById('kiChart');
            if (barCanvas) {
                new Chart(barCanvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                                label: 'Terdaftar',
                                data: terdaftar,
                                backgroundColor: 'rgba(59, 130, 246, .72)',
                                borderColor: '#3b82f6',
                                borderWidth: 1,
                                borderRadius: 5,
                                maxBarThickness: 22
                            },
                            {
                                label: 'Proses',
                                data: proses,
                                backgroundColor: 'rgba(244, 86, 125, .68)',
                                borderColor: '#f4567d',
                                borderWidth: 1,
                                borderRadius: 5,
                                maxBarThickness: 22
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'rectRounded',
                                    boxWidth: 9,
                                    boxHeight: 9,
                                    padding: 18,
                                    color: '#64748b',
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#173d68',
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#64748b',
                                    maxRotation: 40,
                                    minRotation: 0,
                                    font: {
                                        size: 10
                                    }
                                },
                                border: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: '#94a3b8',
                                    font: {
                                        size: 10
                                    }
                                },
                                grid: {
                                    color: '#edf1f6'
                                },
                                border: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            const potensiCanvas = document.getElementById('potensiChart');
            if (potensiCanvas) {
                new Chart(potensiCanvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Potensi KI',
                            data: potensi,
                            backgroundColor: 'rgba(251, 146, 60, .72)',
                            borderColor: '#fb923c',
                            borderWidth: 1,
                            borderRadius: 5,
                            maxBarThickness: 28
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'rectRounded',
                                    boxWidth: 9,
                                    boxHeight: 9,
                                    padding: 18,
                                    color: '#64748b',
                                    font: { size: 11 }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#173d68',
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { color: '#64748b', maxRotation: 40, font: { size: 10 } },
                                border: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0, color: '#94a3b8', font: { size: 10 } },
                                grid: { color: '#edf1f6' },
                                border: { display: false }
                            }
                        }
                    }
                });
            }

            const statusCanvas = document.getElementById('statusChart');
            if (statusCanvas) {
                new Chart(statusCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sudah Terdaftar', 'Dalam Proses'],
                        datasets: [{
                            data: [{{ (int) $terdaftar }}, {{ (int) $proses }}],
                            backgroundColor: ['#2584e8', '#f4567d'],
                            borderColor: '#ffffff',
                            borderWidth: 4,
                            hoverOffset: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '68%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    boxWidth: 8,
                                    boxHeight: 8,
                                    padding: 14,
                                    color: '#64748b',
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#173d68',
                                padding: 12,
                                cornerRadius: 8
                            }
                        }
                    }
                });
            }
        });
    
    // Grafik jumlah KI per jenis, menggunakan rekap tanggal terbaru yang disiapkan controller.
    const jenisKiCanvas = document.getElementById('jenisKiChart');
    if (jenisKiCanvas) {
        const jenisKiLabels = @json($jenisKI->pluck('nama_jenis')->values());
        const jenisKiValues = @json($jenisKI->pluck('total_terdaftar')->map(fn ($value) => (int) ($value ?? 0))->values());

        new Chart(jenisKiCanvas, {
            type: 'bar',
            data: {
                labels: jenisKiLabels,
                datasets: [{
                    label: 'KI Terdaftar',
                    data: jenisKiValues,
                    backgroundColor: ['#3b82f6', '#f0528b', '#10b981', '#a855f7', '#f59e0b', '#06b6d4'],
                    borderRadius: 7,
                    maxBarThickness: 72
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Jumlah: ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: '#64748b', maxRotation: 25, minRotation: 0 }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#64748b',
                            precision: 0,
                            callback: value => new Intl.NumberFormat('id-ID').format(value)
                        },
                        grid: { color: '#e8eef5', borderDash: [4, 4] }
                    }
                }
            }
        });
    }

</script>
@endpush
