@extends('layouts.app')
@section('title', 'Perpustakaan KI')
@section('content')
<style>
.library-page{width:100%;color:#26364f}.library-heading{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:22px}.library-heading h1{margin:0 0 8px;font-size:26px;font-weight:750}.library-heading p{margin:0;color:#64748b;font-size:14px}.library-add,.library-btn{display:inline-block;padding:10px 15px;border-radius:7px;text-decoration:none;font-size:13px;font-weight:700;cursor:pointer}.library-add{background:#ffc928;color:#202a3b}.library-card{background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:20px;box-shadow:0 3px 12px rgba(15,35,60,.04)}.library-toolbar{display:flex;gap:10px;flex-wrap:wrap}.library-control{flex:1;min-width:220px;padding:11px 13px;border:1px solid #d5dce6;border-radius:7px;font:inherit}.library-actions{display:flex;gap:10px;margin-top:12px}.library-btn-primary{background:#344568;color:white;border:0}.library-btn-secondary{background:white;border:1px solid #d5dce6;color:#475569}.library-alert{padding:12px 15px;background:#dcfce7;color:#166534;border-radius:8px;margin-bottom:16px;font-size:13px}.library-summary{display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;margin:22px 0 12px;color:#64748b;font-size:13px}.library-table-wrap{overflow-x:auto}.library-table{width:100%;border-collapse:collapse;min-width:760px}.library-table thead{background:#344568;color:white}.library-table th,.library-table td{padding:14px 16px;text-align:left;font-size:14px;border-bottom:1px solid #edf0f4;vertical-align:middle}.library-table th{font-size:13px;white-space:nowrap}.library-table tbody tr:hover{background:#f8fafc}.library-number{color:#64748b;width:55px}.library-name{font-weight:600}.library-detail{color:#294575;text-decoration:none;font-weight:700}.library-actions-cell{white-space:nowrap}.library-action-link,.library-delete-btn{display:inline-block;padding:7px 10px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:700;border:0;cursor:pointer;margin:2px}.library-edit{background:#fff4cc;color:#805b00}.library-delete-btn{background:#fee2e2;color:#991b1b}.library-pagination{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;padding-top:18px;color:#64748b;font-size:13px}.library-pages{display:flex;align-items:center;gap:5px;flex-wrap:wrap}.library-page-link{display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 9px;border:1px solid #dbe2ea;border-radius:6px;color:#294575;text-decoration:none;background:#fff;font-size:13px}.library-page-link.active{background:#193f68;border-color:#193f68;color:#fff}.library-page-link.disabled{color:#a0a9b7;background:#f8fafc;pointer-events:none}.library-page-ellipsis{padding:0 3px;color:#64748b}@media(max-width:600px){.library-card{padding:14px}.library-heading h1{font-size:23px}}
</style>
<div class="library-page"><div class="library-heading"><div><h1>Perpustakaan KI</h1><p>Katalog nama HAKI dan nomor permohonan.</p></div>
@auth @if(auth()->user()->role==='master')<a href="{{ route('perpustakaan-ki.create') }}" class="library-add">+ Tambah Data KI</a>@endif @endauth
</div>
<div class="library-card">
@if(session('success'))<div class="library-alert">{{ session('success') }}</div>@endif
<form action="{{ route('perpustakaan-ki.index') }}" method="GET"><div class="library-toolbar">
    <input class="library-control" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama HAKI atau nomor permohonan...">
    <select class="library-control" name="jenis_ki_id" aria-label="Filter Jenis KI">
        <option value="">Semua Jenis KI</option>
        @foreach($jenisKi as $jenis)
            <option value="{{ $jenis->id }}" {{ (string) request('jenis_ki_id') === (string) $jenis->id ? 'selected' : '' }}>
                {{ $jenis->nama_jenis }}
            </option>
        @endforeach
    </select>
</div><div class="library-actions"><button type="submit" class="library-btn library-btn-primary">Cari</button><a href="{{ route('perpustakaan-ki.index') }}" class="library-btn library-btn-secondary">Reset</a></div></form>
<div class="library-summary"><strong>Total Katalog: {{ $dataPerpustakaan->total() }} data</strong><span>Data tersimpan di database Perpustakaan KI</span></div>
<div class="library-table-wrap"><table class="library-table"><thead><tr><th>No.</th><th>Nama HAKI</th><th>Nomor Permohonan</th><th>Jenis KI</th><th>Aksi</th></tr></thead><tbody>
@forelse($dataPerpustakaan as $item)<tr><td class="library-number">{{ $dataPerpustakaan->firstItem()+$loop->index }}</td><td class="library-name">{{ $item->nama_hak }}</td><td>{{ $item->nomor_permohonan }}</td><td>{{ $item->jenisKi->nama_jenis ?? '-' }}</td><td class="library-actions-cell">
<a class="library-detail library-action-link" href="{{ route('perpustakaan-ki.show', $item->id) }}">Detail</a>
@auth
@if(auth()->user()->role === 'master')
<a class="library-action-link library-edit" href="{{ route('perpustakaan-ki.edit', $item->id) }}">Edit</a>
<form action="{{ route('perpustakaan-ki.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="library-delete-btn">Hapus</button>
</form>
@endif
@endauth
</td></tr>
@empty<tr><td colspan="5" style="text-align:center;padding:32px;color:#64748b;">Belum ada data Perpustakaan KI.</td></tr>@endforelse
</tbody></table></div>
<div class="library-pagination">
    <span>
        @if($dataPerpustakaan->total() > 0)
            Menampilkan {{ $dataPerpustakaan->firstItem() }}–{{ $dataPerpustakaan->lastItem() }} dari {{ $dataPerpustakaan->total() }} data
        @else
            Belum ada data
        @endif
    </span>
    @if($dataPerpustakaan->lastPage() > 1)
    <nav class="library-pages" aria-label="Navigasi halaman">
        <a class="library-page-link {{ $dataPerpustakaan->onFirstPage() ? 'disabled' : '' }}" href="{{ $dataPerpustakaan->previousPageUrl() ?? '#' }}" aria-label="Halaman sebelumnya">‹</a>
        @php
            $current = $dataPerpustakaan->currentPage();
            $last = $dataPerpustakaan->lastPage();
            $start = max(1, $current - 1);
            $end = min($last, $current + 1);
        @endphp
        @if($start > 1)
            <a class="library-page-link" href="{{ $dataPerpustakaan->url(1) }}">1</a>
            @if($start > 2)<span class="library-page-ellipsis">…</span>@endif
        @endif
        @for($page = $start; $page <= $end; $page++)
            <a class="library-page-link {{ $page === $current ? 'active' : '' }}" href="{{ $dataPerpustakaan->url($page) }}" @if($page === $current) aria-current="page" @endif>{{ $page }}</a>
        @endfor
        @if($end < $last)
            @if($end < $last - 1)<span class="library-page-ellipsis">…</span>@endif
            <a class="library-page-link" href="{{ $dataPerpustakaan->url($last) }}">{{ $last }}</a>
        @endif
        <a class="library-page-link {{ $dataPerpustakaan->hasMorePages() ? '' : 'disabled' }}" href="{{ $dataPerpustakaan->nextPageUrl() ?? '#' }}" aria-label="Halaman berikutnya">›</a>
    </nav>
    @endif
</div>
</div></div>
@endsection
