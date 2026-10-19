@extends('layouts.app')

@section('title', 'Dashboard KI Kalteng')

@push('styles')
<style>
    .dashboard { width:100%; max-width:none; margin:0; }
    .dashboard-heading { display:flex; justify-content:space-between; align-items:flex-end; gap:16px; margin-bottom:22px; }
    .dashboard-heading h1 { margin:0; color:#173d68; font-size:30px; font-weight:750; letter-spacing:-.5px; }
    .dashboard-heading p { margin:7px 0 0; color:#718096; font-size:14px; }
    .dashboard-kicker { display:inline-flex; align-items:center; gap:7px; color:#2563eb; background:#eff6ff; padding:7px 11px; border-radius:20px; font-size:12px; font-weight:700; white-space:nowrap; }
    .panel { background:#fff; border:1px solid #e9eef5; border-radius:15px; box-shadow:0 4px 16px rgba(22,48,79,.045); }
    .filter-panel { padding:19px 20px; margin-bottom:20px; }
    .filter-form { display:grid; grid-template-columns: minmax(190px,1fr) minmax(190px,1fr) auto auto; gap:14px; align-items:end; }
    .filter-field { display:flex; flex-direction:column; gap:8px; min-width:0; }
    .filter-field label { font-size:12px; font-weight:700; color:#34445c; }
    .filter-field select { width:100%; min-height:43px; border:1px solid #dce4ee; border-radius:8px; padding:10px 12px; background:#fff; color:#263449; font:inherit; font-size:13px; }
    .filter-btn { min-height:43px; padding:0 18px; border:0; border-radius:8px; background:#173d68; color:#fff; font-weight:700; font-size:13px; cursor:pointer; }
    .filter-reset { min-height:43px; display:flex; align-items:center; justify-content:center; padding:0 17px; border:1px solid #dce4ee; border-radius:8px; color:#475569; text-decoration:none; font-size:13px; font-weight:600; }
    .filter-btn:hover { background:#102f52; } .filter-reset:hover { background:#f8fafc; }
    .kpi-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; margin-bottom:20px; }
    .kpi-card { display:flex; align-items:center; gap:15px; padding:20px; min-width:0; }
    .kpi-icon { width:49px; height:49px; flex:0 0 49px; display:grid; place-items:center; border-radius:13px; font-size:23px; font-weight:800; }
    .kpi-icon.blue { background:#e8f2ff; color:#2474d8; } .kpi-icon.green { background:#e4f9ed; color:#159455; } .kpi-icon.amber { background:#fff4d8; color:#d97706; } .kpi-icon.purple { background:#f2eaff; color:#8954d8; }
    .kpi-title { color:#64748b; font-size:13px; font-weight:600; margin-bottom:5px; }
    .kpi-number { color:#173d68; font-size:29px; font-weight:800; line-height:1.15; }
    .kpi-note { margin-top:5px; color:#94a3b8; font-size:11px; }
    .analytics-grid { display:grid; grid-template-columns:minmax(0,1.8fr) minmax(300px,.9fr); gap:16px; margin-bottom:20px; align-items:stretch; }
    .chart-panel { padding:21px 22px; min-width:0; }
    .panel-heading { display:flex; justify-content:space-between; align-items:flex-start; gap:12px; margin-bottom:16px; }
    .panel-heading h2 { margin:0; color:#173d68; font-size:17px; font-weight:750; }
    .panel-heading p { margin:5px 0 0; color:#94a3b8; font-size:12px; }
    .chart-area { position:relative; height:310px; }
    .donut-area { position:relative; height:260px; }
    .table-panel { padding:21px 22px; margin-bottom:20px; }
    .table-action { padding:9px 13px; border-radius:8px; background:#173d68; color:#fff; font-size:12px; font-weight:700; text-decoration:none; white-space:nowrap; }
    .table-wrap { width:100%; overflow-x:auto; }
    .dashboard-table { width:100%; border-collapse:collapse; margin-top:12px; white-space:nowrap; }
    .dashboard-table th { background:#f7f9fc; color:#526176; font-size:11px; font-weight:700; text-align:left; padding:13px 12px; border-bottom:1px solid #e8edf4; }
    .dashboard-table td { color:#475569; font-size:12px; padding:13px 12px; border-bottom:1px solid #edf1f6; }
    .dashboard-table tbody tr:hover { background:#f8fbff; }
    .dashboard-table tbody tr:last-child td { border-bottom:0; }
    .number-cell { color:#173d68 !important; font-weight:800; }
    .status-pill { display:inline-block; padding:5px 9px; border-radius:20px; font-size:11px; font-weight:700; }
    .status-pill.terdaftar { background:#dcfce7; color:#166534; } .status-pill.proses { background:#fef3c7; color:#92400e; } .status-pill.potensi { background:#dbeafe; color:#1d4ed8; }
    .empty-row { text-align:center !important; color:#94a3b8 !important; padding:28px !important; }
    @media (max-width:1100px) { .kpi-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } .analytics-grid { grid-template-columns:minmax(0,1.4fr) minmax(280px,1fr); } }
    @media (max-width:760px) { .dashboard-heading { align-items:flex-start; flex-direction:column; } .dashboard-heading h1 { font-size:25px; } .filter-form { grid-template-columns:1fr 1fr; } .analytics-grid { grid-template-columns:1fr; } .chart-area { height:280px; } .donut-area { height:250px; } .chart-panel,.table-panel { padding:17px; } }
    @media (max-width:480px) { .kpi-grid { grid-template-columns:1fr; gap:11px; } .kpi-card { padding:16px; } .filter-form { grid-template-columns:1fr; } .filter-btn,.filter-reset { width:100%; } }
</style>
@endpush

@section('content')
<div class="dashboard">
    <div class="dashboard-heading">
        <div>
            <h1>Dashboard KI Kalteng</h1>
            <p>Ringkasan data Kekayaan Intelektual Kalimantan Tengah</p>
        </div>
        <div class="dashboard-kicker">● Data terintegrasi</div>
    </div>

    <section class="panel filter-panel">
        <form class="filter-form" method="GET" action="{{ url('/') }}">
            <div class="filter-field">
                <label for="jenis_ki_id">Jenis Kekayaan Intelektual</label>
                <select name="jenis_ki_id" id="jenis_ki_id">
                    <option value="">Semua Jenis KI</option>
                    @foreach ($jenisKI as $jenis)
                        <option value="{{ $jenis->id }}" {{ (string)$jenisKiId === (string)$jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-field">
                <label for="kabupaten_id">Kabupaten/Kota</label>
                <select name="kabupaten_id" id="kabupaten_id">
                    <option value="">Semua Kabupaten/Kota</option>
                    @foreach ($daftarKabupaten as $kab)
                        <option value="{{ $kab->id }}" {{ (string)$kabupatenId === (string)$kab->id ? 'selected' : '' }}>{{ $kab->nama_kabupaten }}</option>
                    @endforeach
                </select>
            </div>
            <button class="filter-btn" type="submit">Terapkan Filter</button>
            <a class="filter-reset" href="{{ url('/') }}">Reset</a>
        </form>
    </section>

    @php
        $totalAman = max((int)$totalKI, 0);
        $persenTerdaftar = $totalAman ? round(($terdaftar / $totalAman) * 100, 1) : 0;
        $persenProses = $totalAman ? round(($proses / $totalAman) * 100, 1) : 0;
        $persenPotensi = $totalAman ? round(($potensi / $totalAman) * 100, 1) : 0;
    @endphp

    <section class="kpi-grid">
        <div class="panel kpi-card"><div class="kpi-icon blue">▰</div><div><div class="kpi-title">Total KI</div><div class="kpi-number">{{ number_format($totalKI, 0, ',', '.') }}</div><div class="kpi-note">Seluruh data KI</div></div></div>
        <div class="panel kpi-card"><div class="kpi-icon green">✓</div><div><div class="kpi-title">Sudah Terdaftar</div><div class="kpi-number">{{ number_format($terdaftar, 0, ',', '.') }}</div><div class="kpi-note">{{ number_format($persenTerdaftar, 1, ',', '.') }}% dari total KI</div></div></div>
        <div class="panel kpi-card"><div class="kpi-icon amber">◷</div><div><div class="kpi-title">Dalam Proses</div><div class="kpi-number">{{ number_format($proses, 0, ',', '.') }}</div><div class="kpi-note">{{ number_format($persenProses, 1, ',', '.') }}% dari total KI</div></div></div>
        <div class="panel kpi-card"><div class="kpi-icon purple">✦</div><div><div class="kpi-title">Potensi KI</div><div class="kpi-number">{{ number_format($potensi, 0, ',', '.') }}</div><div class="kpi-note">{{ number_format($persenPotensi, 1, ',', '.') }}% dari total KI</div></div></div>
    </section>

    <section class="analytics-grid">
        <div class="panel chart-panel">
            <div class="panel-heading"><div><h2>Jumlah KI per Kabupaten/Kota</h2><p>Perbandingan KI terdaftar, dalam proses, dan potensi</p></div></div>
            <div class="chart-area"><canvas id="kiChart"></canvas></div>
        </div>
        <div class="panel chart-panel">
            <div class="panel-heading"><div><h2>Status KI</h2><p>Komposisi status dari seluruh data KI</p></div></div>
            <div class="donut-area"><canvas id="statusChart"></canvas></div>
        </div>
    </section>

    <section class="panel table-panel">
        <div class="panel-heading"><div><h2>Data KI per Kabupaten/Kota</h2><p>Ringkasan jumlah KI berdasarkan wilayah</p></div></div>
        <div class="table-wrap">
            <table class="dashboard-table">
                <thead><tr><th>No</th><th>Kabupaten/Kota</th><th>Terdaftar</th><th>Proses</th><th>Potensi</th><th>Total</th></tr></thead>
                <tbody>
                @forelse ($kabupaten as $index => $kab)
                    @php
                        $terdaftarKab = $kab->dataKi->where('status', 'terdaftar')->count();
                        $prosesKab = $kab->dataKi->where('status', 'proses')->count();
                        $potensiKab = $kab->dataKi->where('status', 'potensi')->count();
                        $totalKab = $terdaftarKab + $prosesKab + $potensiKab;
                    @endphp
                    <tr><td>{{ $index + 1 }}</td><td>{{ $kab->nama_kabupaten }}</td><td>{{ $terdaftarKab }}</td><td>{{ $prosesKab }}</td><td>{{ $potensiKab }}</td><td class="number-cell">{{ $totalKab }}</td></tr>
                @empty
                    <tr><td colspan="6" class="empty-row">Belum ada data kabupaten/kota.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel table-panel">
        <div class="panel-heading"><div><h2>Data Detail Kekayaan Intelektual</h2><p>Daftar data KI terbaru yang tercatat di sistem</p></div></div>
        <div class="table-wrap">
            <table class="dashboard-table">
                <thead><tr><th>No</th><th>Nama KI</th><th>Jenis KI</th><th>Kabupaten/Kota</th><th>Pemilik</th><th>Status</th><th>Tahun</th></tr></thead>
                <tbody>
                @forelse ($dataDetail as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td><td>{{ $data->nama_ki }}</td><td>{{ $data->jenisKi->nama_jenis ?? '-' }}</td><td>{{ $data->kabupaten->nama_kabupaten ?? '-' }}</td><td>{{ $data->pemilik }}</td>
                        <td><span class="status-pill {{ $data->status }}">{{ ucfirst($data->status) }}</span></td><td>{{ $data->tahun ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="empty-row">Tidak ada data ditemukan.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
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
                datasets: [
                    { label: 'Terdaftar', data: terdaftar, backgroundColor: 'rgba(59, 130, 246, .72)', borderColor: '#3b82f6', borderWidth: 1, borderRadius: 5, maxBarThickness: 22 },
                    { label: 'Proses', data: proses, backgroundColor: 'rgba(244, 86, 125, .68)', borderColor: '#f4567d', borderWidth: 1, borderRadius: 5, maxBarThickness: 22 },
                    { label: 'Potensi', data: potensi, backgroundColor: 'rgba(251, 146, 60, .68)', borderColor: '#fb923c', borderWidth: 1, borderRadius: 5, maxBarThickness: 22 }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { position: 'top', labels: { usePointStyle: true, pointStyle: 'rectRounded', boxWidth: 9, boxHeight: 9, padding: 18, color: '#64748b', font: { size: 11 } } }, tooltip: { backgroundColor: '#173d68', padding: 12, cornerRadius: 8 } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#64748b', maxRotation: 40, minRotation: 0, font: { size: 10 } }, border: { display: false } },
                    y: { beginAtZero: true, ticks: { precision: 0, color: '#94a3b8', font: { size: 10 } }, grid: { color: '#edf1f6' }, border: { display: false } }
                }
            }
        });
    }

    const statusCanvas = document.getElementById('statusChart');
    if (statusCanvas) {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                labels: ['Sudah Terdaftar', 'Dalam Proses', 'Potensi KI'],
                datasets: [{ data: [{{ (int)$terdaftar }}, {{ (int)$proses }}, {{ (int)$potensi }}], backgroundColor: ['#2584e8', '#f4567d', '#fb923c'], borderColor: '#ffffff', borderWidth: 4, hoverOffset: 7 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '68%',
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, pointStyle: 'circle', boxWidth: 8, boxHeight: 8, padding: 14, color: '#64748b', font: { size: 10 } } }, tooltip: { backgroundColor: '#173d68', padding: 12, cornerRadius: 8 } }
            }
        });
    }
});
</script>
@endpush
