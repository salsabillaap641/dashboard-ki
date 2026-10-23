@extends('layouts.app')

@section('title', 'Data KI')

@section('content')
    <style>
        .data-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .ki-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 1100px;
        }

        .ki-table th,
        .ki-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: top;
        }

        .ki-table th {
            background: #f3f4f6;
            white-space: nowrap;
        }

        .ki-table tbody tr:hover {
            background: #f9fafb;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-terdaftar {
            background: #dcfce7;
            color: #166534;
        }

        .status-proses {
            background: #fef3c7;
            color: #92400e;
        }

        .status-potensi {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .pagination-info {
            margin-top: 16px;
            color: #6b7280;
            font-size: 13px;
        }

        .pagination-links {
            margin-top: 16px;
        }
    </style>

    <div style="margin-bottom: 24px;">
        <h1 style="margin-bottom: 8px;">Data Kekayaan Intelektual</h1>
        <p style="color: #6b7280; margin: 0;">
            Daftar data KI yang tersimpan di dalam database.
        </p>
    </div>

    <div class="data-card">

        @if (session('success'))
    <div style="padding:12px 16px;background:#dcfce7;color:#166534;border-radius:7px;margin-bottom:16px;">
        {{ session('success') }}
    </div>
@endif

        <form action="{{ route('data-ki.index') }}" method="GET" style="margin-bottom: 24px;">

            <div
                style="display:grid;
                grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
                gap:12px;">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama KI atau pemilik..."
                    style="padding:11px;border:1px solid #d1d5db;border-radius:7px;">

                <select name="jenis_ki_id" style="padding:11px;border:1px solid #d1d5db;border-radius:7px;">
                    <option value="">Semua Jenis KI</option>
                    @foreach ($jenisKI as $jenis)
                        <option value="{{ $jenis->id }}" @selected(request('jenis_ki_id') == $jenis->id)>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>

                <select name="kabupaten_id" style="padding:11px;border:1px solid #d1d5db;border-radius:7px;">
                    <option value="">Semua Kabupaten/Kota</option>
                    @foreach ($daftarKabupaten as $kabupaten)
                        <option value="{{ $kabupaten->id }}" @selected(request('kabupaten_id') == $kabupaten->id)>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>

                <select name="status" style="padding:11px;border:1px solid #d1d5db;border-radius:7px;">
                    <option value="">Semua Status</option>
                    <option value="terdaftar" @selected(request('status') == 'terdaftar')>
                        Terdaftar
                    </option>
                    <option value="proses" @selected(request('status') == 'proses')>
                        Proses
                    </option>
                    <option value="potensi" @selected(request('status') == 'potensi')>
                        Potensi
                    </option>
                </select>
            </div>

            <div style="display:flex;gap:10px;margin-top:12px;">
                <button type="submit"
                    style="padding:10px 18px;background:#166534;color:white;border:0;border-radius:7px;cursor:pointer;">
                    Cari / Filter
                </button>

                <a href="{{ route('data-ki.index') }}"
                    style="padding:10px 18px;background:#f3f4f6;color:#374151;border-radius:7px;text-decoration:none;">
                    Reset
                </a>
            </div>
        </form>

        <div style="margin-bottom: 18px;">
            <strong>Total Data KI: {{ $dataKI->total() }}</strong>
        </div>

        <div class="table-wrapper">
            <table class="ki-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama KI</th>
                        <th>Jenis KI</th>
                        <th>Kabupaten/Kota</th>
                        <th>Pemilik</th>
                        <th>Status</th>
                        <th>Tahun</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                        <th>Perpustakaan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataKI as $ki)
                        <tr>
                            <td>
                                {{ $dataKI->firstItem() + $loop->index }}
                            </td>

                            <td>{{ $ki->nama_ki }}</td>

                            <td>
                                {{ $ki->jenisKi->nama_jenis ?? '-' }}
                            </td>

                            <td>
                                {{ $ki->kabupaten->nama_kabupaten ?? '-' }}
                            </td>

                            <td>{{ $ki->pemilik }}</td>

                            <td>
                                <span class="status status-{{ $ki->status }}">
                                    {{ ucfirst($ki->status) }}
                                </span>
                            </td>

                            <td>{{ $ki->tahun }}</td>

                            <td>
                                {{ $ki->tanggal_pengajuan ? \Carbon\Carbon::parse($ki->tanggal_pengajuan)->format('d-m-Y') : '-' }}
                            </td>

                            <td>{{ $ki->keterangan ?: '-' }}</td>


                            <td style="white-space:nowrap;">
                                <a href="{{ route('data-ki.show', $ki->id) }}"
                                    style="display:inline-block;padding:7px 10px;background:#e0f2fe;color:#075985;border-radius:6px;text-decoration:none;margin-right:4px;">
                                    Detail
                                </a>
                                <a href="{{ route('data-ki.edit', $ki->id) }}"
                                    style="display:inline-block;padding:7px 10px;background:#dbeafe;color:#1d4ed8;border-radius:6px;text-decoration:none;">
                                    Edit
                                </a>

                                <form action="{{ route('data-ki.destroy', $ki->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Yakin ingin menghapus data KI ini? Data yang dihapus tidak dapat dikembalikan.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        style="padding:7px 10px;background:#fee2e2;color:#b91c1c;border:0;border-radius:6px;cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </td>

<td style="white-space:nowrap;">
    @if ($ki->status === 'terdaftar')
        @if ($ki->sudah_di_perpustakaan)
            <span style="color:#15803d;font-size:12px;font-weight:600;">
                ✓ Sudah di Perpustakaan
            </span>
        @else
            <a
                href="{{ route('perpustakaan-ki.create', ['data_ki_id' => $ki->id]) }}"
                style="display:inline-block;padding:8px 11px;background:#1c426c;color:white;border-radius:7px;text-decoration:none;font-size:12px;"
            >
                + Tambahkan ke Perpustakaan
            </a>
        @endif
    @else
        <span style="color:#9ca3af;font-size:12px;">
            Belum terdaftar
        </span>
    @endif
</td>



                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center; padding: 30px;">
                                Belum ada data KI yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="pagination-info">
            Menampilkan {{ $dataKI->firstItem() ?? 0 }}
            – {{ $dataKI->lastItem() ?? 0 }}
            dari {{ $dataKI->total() }} data
        </div>

        <div class="pagination-links" style="display:flex; justify-content:flex-end; gap:8px; align-items:center;">

            @if ($dataKI->onFirstPage())
                <span style="color:#9ca3af;">‹ Sebelumnya</span>
            @else
                <a href="{{ $dataKI->previousPageUrl() }}" style="color:#166534; text-decoration:none;">
                    ‹ Sebelumnya
                </a>
            @endif

            <span style="padding:7px 12px; background:#166534; color:white; border-radius:6px;">
                {{ $dataKI->currentPage() }}
            </span>

            @if ($dataKI->hasMorePages())
                <a href="{{ $dataKI->nextPageUrl() }}" style="color:#166534; text-decoration:none;">
                    Berikutnya ›
                </a>
            @else
                <span style="color:#9ca3af;">Berikutnya ›</span>
            @endif
        </div>

    </div>
@endsection
