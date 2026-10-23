
@extends('layouts.app')

@section('content')
<style>
    .review-page { color:#263750; }
    .review-header { margin-bottom:22px; }
    .review-header h2 { margin:0 0 8px; font-size:26px; font-weight:750; }
    .review-header p { margin:0; color:#64748b; font-size:14px; }
    .review-filters {
        display:flex; flex-wrap:wrap; gap:12px; align-items:end;
        padding:18px; margin-bottom:18px; background:white;
        border:1px solid #e2e8f0; border-radius:10px;
    }
    .review-filters label { display:block; font-size:13px; font-weight:700; margin-bottom:7px; }
    .review-filters select {
        min-width:190px; padding:10px; border:1px solid #cbd5e1;
        border-radius:7px; background:white; color:#263750;
    }
    .review-btn {
        display:inline-block; border:0; border-radius:7px; padding:10px 15px;
        font-weight:700; font-size:13px; text-decoration:none; cursor:pointer;
    }
    .review-btn-primary { background:#344568; color:white; }
    .review-btn-light { background:#f1f5f9; color:#344568; }
    .review-table-card { background:white; border:1px solid #e2e8f0; border-radius:10px; overflow:hidden; }
    .review-table-wrap { overflow-x:auto; }
    .review-table { width:100%; min-width:850px; border-collapse:collapse; }
    .review-table th { padding:14px; background:#344568; color:white; text-align:left; font-size:13px; }
    .review-table td { padding:14px; border-bottom:1px solid #edf0f4; font-size:14px; vertical-align:middle; }
    .review-table tr:last-child td { border-bottom:0; }
    .review-table tbody tr:hover { background:#f8fafc; }
    .review-status { display:inline-block; padding:6px 9px; border-radius:20px; font-size:12px; font-weight:700; white-space:nowrap; }
    .status-menunggu_penelaahan { background:#fff5d8; color:#805d00; }
    .status-sedang_ditelaah { background:#e8eefb; color:#294575; }
    .status-perlu_perbaikan { background:#fff0f0; color:#b42318; }
    .status-diterima { background:#e8f7ed; color:#176534; }
    .status-ditolak { background:#f1f5f9; color:#475569; }
    .review-empty { text-align:center; padding:35px !important; color:#64748b; }
    .review-footer { padding:16px 20px; border-top:1px solid #edf0f4; }
    .review-alert { padding:12px 16px; margin-bottom:18px; background:#e8f7ed; color:#176534; border-radius:7px; }
</style>

<div class="review-page">
    <div class="review-header">
        <h2>Penelaahan Potensi KI</h2>
        <p>Periksa pengajuan Potensi KI yang dikirim oleh pengguna Kabupaten/Kota.</p>
    </div>

    @if(session('success'))
        <div class="review-alert">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('penelaahan-ki.index') }}" class="review-filters">
        <div>
            <label for="status">Status Pengajuan</label>
            <select name="status" id="status">
                <option value="">Semua Status</option>
                @foreach([
                    'menunggu_penelaahan' => 'Menunggu Penelaahan',
                    'sedang_ditelaah' => 'Sedang Ditelaah',
                    'perlu_perbaikan' => 'Perlu Perbaikan',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ] as $value => $label)
                    <option value="{{ $value }}" @selected(request('status') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="kabupaten_id">Kabupaten/Kota</label>
            <select name="kabupaten_id" id="kabupaten_id">
                <option value="">Semua Wilayah</option>
                @foreach($kabupaten as $kab)
                    <option value="{{ $kab->id }}" @selected((string) request('kabupaten_id') === (string) $kab->id)>
                        {{ $kab->nama_kabupaten }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="review-btn review-btn-primary" type="submit">Filter</button>
        <a class="review-btn review-btn-light" href="{{ route('penelaahan-ki.index') }}">Reset</a>
    </form>

    <div class="review-table-card">
        <div class="review-table-wrap">
            <table class="review-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Potensi KI</th>
                        <th>Jenis KI</th>
                        <th>Kabupaten/Kota</th>
                        <th>Pengaju</th>
                        <th>Status</th>
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
                            <td><strong>{{ $item->nama_ki }}</strong></td>
                            <td>{{ $item->jenisKi->nama_jenis ?? $item->jenisKi->nama ?? '-' }}</td>
                            <td>{{ $item->kabupaten->nama_kabupaten ?? '-' }}</td>
                            <td>{{ $item->userPengaju->name ?? '-' }}</td>
                            <td>
                                <span class="review-status status-{{ $status }}">
                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>
                            <td>
                                <a class="review-btn review-btn-primary"
                                   href="{{ route('penelaahan-ki.show', $item->id) }}">
                                    Telaah
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="review-empty">
                                Belum ada pengajuan Potensi KI yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="review-footer">
            <div style="font-size:13px;color:#64748b;margin-bottom:12px">
                @if($pengajuan->total() > 0)
                    Menampilkan {{ $pengajuan->firstItem() }}–{{ $pengajuan->lastItem() }}
                    dari {{ $pengajuan->total() }} pengajuan
                @else
                    Belum ada pengajuan
                @endif
            </div>
            {{ $pengajuan->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
