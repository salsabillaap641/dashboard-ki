@extends('layouts.app')
@section('title', 'Galeri Produk KI')
@section('content')
<style>
.gallery-wrap{max-width:1200px;margin:auto;color:#203956}.gallery-head{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px}.gallery-head h1{margin:0 0 6px;font-size:28px;color:#173d68}.gallery-head p{margin:0;color:#718096;font-size:14px}.gallery-btn{display:inline-block;background:#173d68;color:#fff;text-decoration:none;border:0;border-radius:8px;padding:10px 14px;font-size:13px;font-weight:700;cursor:pointer}.gallery-btn.secondary{background:#fff;border:1px solid #dbe3ed;color:#334155}.gallery-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}.gallery-card{background:#fff;border:1px solid #e5ebf3;border-radius:14px;overflow:hidden;box-shadow:0 5px 18px #193b5b08}.gallery-photo{height:210px;background:#eef3f8}.gallery-photo img{width:100%;height:100%;object-fit:cover}.gallery-info{padding:16px}.gallery-title{font-weight:800;font-size:16px;line-height:1.4}.gallery-type{display:inline-block;margin:8px 0;background:#edf4ff;color:#245d9a;padding:5px 9px;border-radius:99px;font-size:11px}.gallery-caption{font-size:13px;color:#65758b;line-height:1.6;white-space:pre-line}.gallery-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}.gallery-alert{padding:12px 14px;background:#dcfce7;color:#166534;border-radius:8px;margin-bottom:18px;font-size:13px}@media(max-width:850px){.gallery-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}@media(max-width:560px){.gallery-grid{grid-template-columns:1fr}.gallery-head{align-items:flex-start;flex-direction:column}}
</style>
<div class="gallery-wrap">
 <div class="gallery-head"><div><h1>Galeri Produk KI</h1><p>Kenali karya, produk, dan inovasi Kekayaan Intelektual Kalimantan Tengah.</p></div>
 @auth @if(auth()->user()->role === 'master')<a class="gallery-btn" href="{{ route('galeri-ki.create') }}">+ Tambah Produk KI</a>@endif @endauth
 </div>
 @if(session('success'))<div class="gallery-alert">{{ session('success') }}</div>@endif
 @if($galeri->count())
 <div class="gallery-grid">
 @foreach($galeri as $item)
 <article class="gallery-card">
  <div class="gallery-photo"><img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_produk }}"></div>
  <div class="gallery-info">
   <div class="gallery-title">{{ $item->nama_produk }}</div>
   <span class="gallery-type">{{ $item->jenisKi?->nama_jenis ?? 'Jenis KI' }}</span>
   @if($item->nomor_permohonan)<div style="font-size:11px;color:#718096;margin-bottom:8px">No. {{ $item->nomor_permohonan }}</div>@endif
   <div class="gallery-caption">{{ $item->caption }}</div>
   @auth @if(auth()->user()->role === 'master')
   <div class="gallery-actions"><a class="gallery-btn" href="{{ route('galeri-ki.edit',$item) }}">Edit</a><form action="{{ route('galeri-ki.destroy',$item) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari galeri?')">@csrf @method('DELETE')<button class="gallery-btn secondary" type="submit">Hapus</button></form></div>
   @endif @endauth
  </div>
 </article>
 @endforeach
 </div>
 <div style="margin-top:20px">{{ $galeri->links() }}</div>
 @else
 <div style="background:#fff;padding:28px;border:1px solid #e5ebf3;border-radius:12px;color:#718096">Belum ada produk di galeri. Master dapat menambahkan foto dan caption melalui tombol <b>Tambah Produk KI</b>.</div>
 @endif
</div>
@endsection
