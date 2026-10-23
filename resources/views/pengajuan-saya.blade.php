
@extends('layouts.app')

@section('content')
<style>
    .pengajuan-page {
        color: #263750;
    }

    .pengajuan-header {
        margin-bottom: 22px;
    }

    .pengajuan-header h2 {
        margin: 0 0 8px;
        font-size: 26px;
        font-weight: 750;
    }

    .pengajuan-header p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .pengajuan-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 35, 60, .04);
    }

    .pengajuan-table-wrap {
        overflow-x: auto;
    }

    .pengajuan-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .pengajuan-table th {
        background: #344568;
        color: #fff;
        padding: 14px;
        text-align: left;
        font-size: 13px;
        white-space: nowrap;
    }

    .pengajuan-table td {
        padding: 14px;
        border-bottom: 1px solid #edf0f4;
        font-size: 14px;
        vertical-align: top;
    }

    .pengajuan-table tbody tr:last-child td {
        border-bottom: none;
    }

    .pengajuan-table tbody tr:hover {
        background: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu_penelaahan {
        background: #fff5d8;
        color: #805d00;
    }

    .status-sedang_ditelaah {
        background: #e8eefb;
        color: #294575;
    }

    .status-perlu_perbaikan {
        background: #fff0f0;
        color: #b42318;
    }

    .status-diterima {
        background: #e8f7ed;
        color: #176534;
    }

    .status-ditolak {
        background: #f1f5f9;
        color: #475569;
    }

    .pengajuan-detail {
        color: #344568;
        font-weight: 700;
        text-decoration: none;
    }

    .pengajuan-detail:hover {
        text-decoration: underline;
    }

    .pengajuan-empty {
        padding: 38px 20px !important;
        text-align: center;
        color: #64748b;
    }

    .pengajuan-footer {
        padding: 16px 20px;
        border-top: 1px solid #edf0f4;
    }

    .pengajuan-alert {
        padding: 12px 16px;
        border-radius: 7px;
        background: #e8f7ed;
        color: #176534;
        margin-bottom: 18px;
    }

    .pengajuan-catatan {
        max-width: 250px;
        white-space: normal;
        line-height: 1.5;
        color: #475569;
    }
</style>

<div class="pengajuan-page">
    <div class="pengajuan-header">
        <h2>Pengajuan Saya</h2>
        <p>Pantau status dan hasil penelaahan Potensi Kekayaan Intelektual yang kamu ajukan.</p>
    </div>

    @if(session('success'))
        <div class="pengajuan-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="pengajuan-card">
        <div class="pengajuan-table-wrap">
            <table class="pengajuan-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Potensi KI</th>
                        <th>Jenis KI</th>
                        <th>Tahun</th>
                        <th>Status Pengajuan</th>
                        <th>Catatan Master</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pengajuan as $item)
                        @php
                            $status = $item->status_pengajuan ?? 'menunggu_penelaahan';
                        @endphp

                        <tr>
                            <td>{{ $pengajuan->firstItem() + $loop->index }}</td>

                            <td>
                                <strong>{{ $item->nama_ki }}</strong>
                            </td>

                            <td>
                                {{ $item->jenisKi->nama_jenis ?? $item->jenisKi->nama ?? '-' }}
                            </td>

                            <td>{{ $item->tahun }}</td>

                            <td>
                                <span class="status-badge status-{{ $status }}">
                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>

                            <td>
                                <div class="pengajuan-catatan">
                                    {{ $item->catatan_admin ?: 'Belum ada catatan dari Master.' }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('pengajuan-saya.detail', $item->id) }}"
                                   class="pengajuan-detail">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="pengajuan-empty">
                                <strong>Belum ada pengajuan Potensi KI.</strong>
                                <p>Pengajuan yang kamu kirim akan muncul di halaman ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengajuan->hasPages())
            <div class="pengajuan-footer">
                {{ $pengajuan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
