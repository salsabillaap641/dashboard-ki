@extends('layouts.app')

@section('title', 'Dashboard KI Kalteng')

@section('content')

    @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
            const labels = @json($chartLabels);

            const terdaftar = @json($chartTerdaftar);

            const proses = @json($chartProses);

            const potensi = @json($chartPotensi);


            const ctx = document
                .getElementById('kiChart')
                .getContext('2d');


            new Chart(ctx, {

                type: 'bar',

                data: {

                    labels: labels,

                    datasets: [

                        {
                            label: 'Terdaftar',

                            data: terdaftar,

                            borderWidth: 1
                        },

                        {
                            label: 'Proses',

                            data: proses,

                            borderWidth: 1
                        },

                        {
                            label: 'Potensi',

                            data: potensi,

                            borderWidth: 1
                        }

                    ]

                },

                options: {

                    responsive: true,

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {

                                stepSize: 1

                            }

                        }

                    }

                }

            });
        </script>
@endpush

    @push('styles')
<style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background: #f5f7fa;

            color: #1f2937;
        }


        
.container {
    width: 100%;
    max-width: none;
    margin: 0;
}


        .dashboard-container {
    width: 100%;
    max-width: none;
    margin: 0;
}


        .header {
            margin-bottom: 25px;
        }


        .header h1 {
            margin: 0;

            color: #123b67;
        }


        .header p {
            color: #6b7280;

            margin-top: 8px;
        }


        /* KPI */

        .kpi-container {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 20px;
        }


        .kpi-card {
            background: white;

            border-radius: 12px;

            padding: 22px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);
        }


        .kpi-title {
            color: #6b7280;

            font-size: 14px;

            margin-bottom: 10px;
        }


        .kpi-number {
            font-size: 32px;

            font-weight: bold;

            color: #123b67;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {

            .kpi-container {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        @media (max-width: 500px) {

            .kpi-container {
                grid-template-columns: 1fr;
            }

        }

        .table-container {
            background: white;

            margin-top: 30px;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);

            overflow-x: auto;
        }


        .table-container h2 {
            margin-top: 0;

            color: #123b67;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            margin-top: 20px;
        }


        th,
        td {
            padding: 14px;

            text-align: left;

            border-bottom: 1px solid #e5e7eb;
        }


        th {
            background: #f8fafc;

            font-size: 14px;
        }


        td {
            font-size: 14px;
        }


        tbody tr:hover {
            background: #f8fafc;
        }

        .filter-container {
            background: white;

            padding: 20px;

            margin-bottom: 25px;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);
        }


        .filter-container label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            font-size: 14px;
        }


        .filter-container select {
            width: 250px;

            padding: 10px 12px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            background: white;

            font-size: 14px;

            cursor: pointer;
        }

        .filter-container form {
            display: flex;

            align-items: end;

            gap: 15px;

            flex-wrap: wrap;
        }


        .filter-group {
            display: flex;

            flex-direction: column;

            gap: 7px;
        }


        .filter-group label {
            font-size: 14px;

            font-weight: bold;
        }


        .filter-group select {
            width: 220px;

            padding: 10px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            background: white;
        }


        .filter-container button {
            padding: 10px 18px;

            border: none;

            border-radius: 8px;

            background: #123b67;

            color: white;

            cursor: pointer;
        }


        .filter-container a {
            padding: 10px 18px;

            border: 1px solid #d1d5db;

            border-radius: 8px;

            text-decoration: none;

            color: #374151;

            background: white;
        }

        .chart-container {
            background: white;

            margin-top: 30px;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);
        }


        .chart-container h2 {
            margin-top: 0;

            color: #123b67;

            font-size: 20px;
        }

        .detail-container {
            background: white;

            margin-top: 30px;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0, 0, 0, 0.05);
        }


        .detail-container h2 {
            margin-top: 0;

            color: #123b67;
        }


        .table-wrapper {
            overflow-x: auto;
        }


        .status {
            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }


        .status.terdaftar {
            background: #dcfce7;

            color: #166534;
        }


        .status.proses {
            background: #fef3c7;

            color: #92400e;
        }


        .status.potensi {
            background: #dbeafe;

            color: #1e40af;
        }

    </style>
@endpush
    

        <div class="container">

            <!-- HEADER -->

            <div class="header">

                <h1>Dashboard KI Kalteng</h1>

                <p>
                    Dashboard Data Kekayaan Intelektual
                    Kalimantan Tengah
                </p>

            </div>

            <div class="filter-container">

                <form method="GET" action="/">

                    <div class="filter-group">

                        <label for="jenis_ki_id">
                            Jenis Kekayaan Intelektual
                        </label>

                        <select name="jenis_ki_id" id="jenis_ki_id">

                            <option value="">
                                Semua Jenis KI
                            </option>

                            @foreach ($jenisKI as $jenis)
                                <option value="{{ $jenis->id }}" {{ $jenisKiId == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="filter-group">

                        <label for="kabupaten_id">
                            Kabupaten/Kota
                        </label>

                        <select name="kabupaten_id" id="kabupaten_id">

                            <option value="">
                                Semua Kabupaten/Kota
                            </option>

                            @foreach ($daftarKabupaten as $kab)
                                <option value="{{ $kab->id }}" {{ $kabupatenId == $kab->id ? 'selected' : '' }}>
                                    {{ $kab->nama_kabupaten }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <button type="submit">
                        Terapkan Filter
                    </button>


                    <a href="/">
                        Reset
                    </a>

                </form>

            </div>


            <!-- KPI -->

            <div class="kpi-container">


                <!-- TOTAL -->

                <div class="kpi-card">

                    <div class="kpi-title">
                        Total KI
                    </div>

                    <div class="kpi-number">
                        {{ $totalKI }}
                    </div>

                </div>


                <!-- TERDAFTAR -->

                <div class="kpi-card">

                    <div class="kpi-title">
                        Sudah Terdaftar
                    </div>

                    <div class="kpi-number">
                        {{ $terdaftar }}
                    </div>

                </div>


                <!-- PROSES -->

                <div class="kpi-card">

                    <div class="kpi-title">
                        Dalam Proses
                    </div>

                    <div class="kpi-number">
                        {{ $proses }}
                    </div>

                </div>


                <!-- POTENSI -->

                <div class="kpi-card">

                    <div class="kpi-title">
                        Potensi KI
                    </div>

                    <div class="kpi-number">
                        {{ $potensi }}
                    </div>

                </div>


            </div>
            <div class="chart-container">

                <h2>Jumlah KI per Kabupaten/Kota</h2>

                <canvas id="kiChart"></canvas>

            </div>
            <div class="table-container">

                <h2>KI per Kabupaten/Kota</h2>

                <table>

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Kabupaten/Kota</th>

                            <th>Terdaftar</th>

                            <th>Proses</th>

                            <th>Potensi</th>

                            <th>Total</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($kabupaten as $index => $kab)
                            @php

                                $terdaftarKab = $kab->dataKi->where('status', 'terdaftar')->count();

                                $prosesKab = $kab->dataKi->where('status', 'proses')->count();

                                $potensiKab = $kab->dataKi->where('status', 'potensi')->count();

                                $totalKab = $terdaftarKab + $prosesKab + $potensiKab;

                            @endphp

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    {{ $kab->nama_kabupaten }}
                                </td>

                                <td>
                                    {{ $terdaftarKab }}
                                </td>

                                <td>
                                    {{ $prosesKab }}
                                </td>

                                <td>
                                    {{ $potensiKab }}
                                </td>

                                <td>
                                    {{ $totalKab }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>


        </div>

        
    @endsection
