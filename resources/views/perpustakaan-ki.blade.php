
@extends('layouts.app')

@section('title', 'Perpustakaan KI')

@section('content')
<style>
    .library-page {
        width: 100%;
    }

    .library-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .library-heading h1 {
        margin: 0 0 8px;
        font-size: 28px;
        color: #26364f;
        font-weight: 700;
    }

    .library-heading p {
        margin: 0;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .library-card {
        background: white;
        border: 1px solid #e8edf3;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 6px 24px rgba(31,51,79,.05);
    }

    .library-toolbar {
        display: grid;
        grid-template-columns: minmax(200px, 1.5fr) repeat(2, minmax(170px, 1fr));
        gap: 12px;
        margin-bottom: 14px;
    }

    .library-control {
        width: 100%;
        min-width: 0;
        min-height: 44px;
        box-sizing: border-box;
        padding: 10px 12px;
        border: 1px solid #d5dce6;
        border-radius: 8px;
        background: white;
        color: #26364f;
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }

    .library-control:focus {
        border-color: #254d78;
        box-shadow: 0 0 0 3px rgba(37,77,120,.1);
    }

    .library-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .library-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        min-height: 40px;
        padding: 10px 15px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        box-sizing: border-box;
    }

    .library-btn-primary {
        background: #1c426c;
        color: white;
    }

    .library-btn-primary:hover {
        background: #153454;
    }

    .library-btn-secondary {
        background: white;
        color: #475569;
        border-color: #d5dce6;
    }

    .library-btn-secondary:hover {
        background: #f8fafc;
    }

    .library-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .library-total {
        color: #26364f;
        font-size: 14px;
        font-weight: 700;
    }

    .library-note {
        color: #8490a2;
        font-size: 12px;
    }

    .library-table-wrap {
        overflow-x: auto;
        border: 1px solid #edf0f5;
        border-radius: 9px;
    }

    .library-table {
        width: 100%;
        min-width: 750px;
        border-collapse: collapse;
        font-size: 13px;
    }

    .library-table th {
        padding: 14px 15px;
        text-align: left;
        color: #34445c;
        background: #f3f5f8;
        border-bottom: 1px solid #e5eaf0;
        font-weight: 700;
        white-space: nowrap;
    }

    .library-table td {
        padding: 15px;
        color: #475569;
        border-bottom: 1px solid #edf0f5;
        vertical-align: middle;
    }

    .library-table tbody tr:last-child td {
        border-bottom: none;
    }

    .library-table tbody tr:hover {
        background: #f9fbfd;
    }

    .library-number {
        color: #8490a2;
        width: 48px;
    }

    .library-name {
        color: #26364f;
        font-weight: 600;
    }

    .library-badge {
        display: inline-block;
        padding: 5px 9px;
        background: #edf3fa;
        color: #1c426c;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
    }

    .library-empty {
        padding: 42px 20px !important;
        text-align: center;
    }

    .library-empty strong {
        display: block;
        color: #34445c;
        margin-bottom: 7px;
    }

    .library-empty span {
        color: #8490a2;
        font-size: 12px;
    }

    .library-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .library-pagination-info {
        color: #6b7280;
        font-size: 12px;
    }

    .library-pagination-links {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
    }

    .library-pagination-links a {
        color: #1c426c;
        text-decoration: none;
        font-weight: 600;
    }

    .library-pagination-links .disabled {
        color: #a0a9b7;
    }

    .library-current-page {
        padding: 7px 11px;
        color: white;
        background: #1c426c;
        border-radius: 6px;
    }

    .library-alert {
        padding: 12px 15px;
        background: #dcfce7;
        color: #166534;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    @media (max-width: 850px) {
        .library-toolbar {
            grid-template-columns: 1fr 1fr;
        }

        .library-toolbar input {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 560px) {
        .library-heading h1 {
            font-size: 23px;
        }

        .library-card {
            padding: 16px;
        }

        .library-toolbar {
            grid-template-columns: 1fr;
        }

        .library-toolbar input {
            grid-column: auto;
        }

        .library-actions > * {
            flex: 1;
        }

        .library-pagination {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="library-page">

    <div class="library-heading">
        <div>
            <h1>Perpustakaan KI</h1>
            <p>
                Katalog hak kekayaan intelektual berdasarkan jenis hak
                dan kabupaten/kota di Kalimantan Tengah.
            </p>
        </div>

        
@auth
    @if (auth()->user()->role === 'master')
        <a href="{{ route('perpustakaan-ki.create') }}"
           class="library-btn library-btn-primary">
            + Tambah Data KI
        </a>
    @endif
@endauth

    </div>

    <div class="library-card">

        @if (session('success'))
            <div class="library-alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('perpustakaan-ki.index') }}" method="GET">

            <div class="library-toolbar">
                <input
                    class="library-control"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau nomor hak..."
                >

                <select class="library-control" name="jenis_ki_id">
                    <option value="">Semua Jenis Hak</option>
                    @foreach ($jenisKI as $jenis)
                        <option value="{{ $jenis->id }}"
                            @selected(request('jenis_ki_id') == $jenis->id)>
                            {{ $jenis->nama_jenis }}
                        </option>
                    @endforeach
                </select>

                <select class="library-control" name="kabupaten_id">
                    <option value="">Semua Kabupaten/Kota</option>
                    @foreach ($daftarKabupaten as $kabupaten)
                        <option value="{{ $kabupaten->id }}"
                            @selected(request('kabupaten_id') == $kabupaten->id)>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="library-actions">
                <button type="submit" class="library-btn library-btn-primary">
                    Cari / Filter
                </button>

                <a href="{{ route('perpustakaan-ki.index') }}"
                   class="library-btn library-btn-secondary">
                    Reset
                </a>
            </div>
        </form>

        <div class="library-summary">
            <div class="library-total">
                Total Katalog: {{ $dataPerpustakaan->total() }} data
            </div>

            <div class="library-note">
                Data tersimpan di database Perpustakaan KI
            </div>
        </div>

        <div class="library-table-wrap">
            <table class="library-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Hak</th>
                        <th>Nomor Hak</th>
                        <th>Jenis Hak</th>
                        <th>Kabupaten/Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dataPerpustakaan as $item)
                        <tr>
                            <td class="library-number">
                                {{ $dataPerpustakaan->firstItem() + $loop->index }}
                            </td>

                            <td class="library-name">
                                {{ $item->nama_hak }}
                            </td>

                            <td>{{ $item->nomor_hak }}</td>

                            <td>
                                <span class="library-badge">
                                    {{ $item->jenisKi->nama_jenis ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $item->kabupaten->nama_kabupaten ?? '-' }}
                            </td>


<td style="white-space: nowrap;">
    <a href="{{ route('perpustakaan-ki.show', $item->id) }}"
       class="library-btn library-btn-secondary"
       style="min-height: 32px; padding: 6px 10px;">
        Detail
    </a>

    @auth
        @if (auth()->user()->role === 'master')
            <a href="{{ route('perpustakaan-ki.edit', $item->id) }}"
               style="display: inline-block; padding: 7px 12px;
                      background: #dbeafe; color: #1d4ed8;
                      border-radius: 6px; text-decoration: none;">
                Edit
            </a>

            <form action="{{ route('perpustakaan-ki.destroy', $item->id) }}"
                  method="POST"
                  style="display: inline-block;"
                  onsubmit="return confirm('Yakin ingin menghapus data ini dari Perpustakaan KI?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                        style="padding: 7px 12px; background: #fee2e2;
                               color: #b91c1c; border: 0;
                               border-radius: 6px; cursor: pointer;">
                    Hapus
                </button>
            </form>
        @endif
    @endauth
</td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="library-empty">
                                <strong>Belum ada data Perpustakaan KI</strong>
                                <span>
                                    Tambahkan data baru untuk mulai membangun katalog.
                                </span>
                            </td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>

        <div class="library-pagination">
            <div class="library-pagination-info">
                Menampilkan {{ $dataPerpustakaan->firstItem() ?? 0 }}
               –{{ $dataPerpustakaan->lastItem() ?? 0 }}
                dari {{ $dataPerpustakaan->total() }} data
            </div>

            <div class="library-pagination-links">
                @if ($dataPerpustakaan->onFirstPage())
                    <span class="disabled">‹ Sebelumnya</span>
                @else
                    <a href="{{ $dataPerpustakaan->previousPageUrl() }}">
                        ‹ Sebelumnya
                    </a>
                @endif

                <span class="library-current-page">
                    {{ $dataPerpustakaan->currentPage() }}
                </span>

                @if ($dataPerpustakaan->hasMorePages())
                    <a href="{{ $dataPerpustakaan->nextPageUrl() }}">
                        Berikutnya ›
                    </a>
                @else
                    <span class="disabled">Berikutnya ›</span>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
