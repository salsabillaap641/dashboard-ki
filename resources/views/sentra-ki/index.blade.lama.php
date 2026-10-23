@extends('layouts.app')

@section('title', 'Sentra KI')

@section('content')
<style>
    .sentra-wrap{max-width:1200px;margin:0 auto;padding:4px 0 28px}
    .sentra-head{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px;flex-wrap:wrap}
    .sentra-head h1{margin:0;color:#173d68;font-size:28px}
    .sentra-head p{margin:7px 0 0;color:#718096;font-size:14px}
    .sentra-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px}
    .sentra-card{background:#fff;border:1px solid #e6edf5;border-radius:15px;padding:22px;box-shadow:0 4px 16px rgba(22,48,79,.05);display:flex;flex-direction:column;min-height:190px}
    .sentra-icon{width:44px;height:44px;border-radius:12px;background:#e8f2ff;color:#1d5b91;display:grid;place-items:center;font-size:22px;margin-bottom:16px}
    .sentra-card h2{font-size:18px;color:#173d68;margin:0 0 10px;overflow-wrap:anywhere}
    .sentra-address{color:#5f6f84;font-size:13px;line-height:1.7;white-space:pre-line;overflow-wrap:anywhere;flex:1}
    .sentra-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:18px;padding-top:14px;border-top:1px solid #edf1f6}
    .sentra-btn{display:inline-block;padding:8px 12px;border-radius:7px;text-decoration:none;border:0;cursor:pointer;font-size:12px;font-weight:700}
    .sentra-primary{background:#173d68;color:white}.sentra-edit{background:#dbeafe;color:#1d4ed8}.sentra-delete{background:#fee2e2;color:#b91c1c}
    .sentra-alert{padding:12px 15px;border-radius:8px;margin-bottom:16px;background:#dcfce7;color:#166534}
    .sentra-empty{background:white;border:1px dashed #cbd5e1;border-radius:14px;padding:36px;text-align:center;color:#718096}
    .sentra-pagination{margin-top:20px}
</style>
<div class="sentra-wrap">
    <div class="sentra-head">
        <div>
            <h1>Sentra KI</h1>
            <p>Informasi sentra Kekayaan Intelektual di Kalimantan Tengah.</p>
        </div>
        @auth
            @if(auth()->user()->role === 'master')
                <a class="sentra-btn sentra-primary" href="{{ route('sentra-ki.create') }}">+ Tambah Sentra KI</a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="sentra-alert">{{ session('success') }}</div>
    @endif

    @if($sentra->count())
        <div class="sentra-grid">
            @foreach($sentra as $item)
                <article class="sentra-card">
                    <div class="sentra-icon" aria-hidden="true">⌂</div>
                    <h2>{{ $item->nama_sentra }}</h2>
                    <div class="sentra-address">{{ $item->alamat }}</div>
                    @auth
                        @if(auth()->user()->role === 'master')
                            <div class="sentra-actions">
                                <a class="sentra-btn sentra-edit" href="{{ route('sentra-ki.edit', $item) }}">Edit</a>
                                <form action="{{ route('sentra-ki.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sentra KI ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="sentra-btn sentra-delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </article>
            @endforeach
        </div>
        <div class="sentra-pagination">{{ $sentra->links() }}</div>
    @else
        <div class="sentra-empty">
            <div style="font-size:32px;margin-bottom:10px">⌂</div>
            <strong>Belum ada data Sentra KI</strong>
            <p>Informasi sentra KI akan ditampilkan di halaman ini setelah ditambahkan.</p>
        </div>
    @endif
</div>
@endsection
