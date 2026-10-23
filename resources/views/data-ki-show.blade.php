@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Kekayaan Intelektual</h1>

    <p><strong>Nama KI:</strong> {{ $ki->nama_ki }}</p>
    <p><strong>Jenis KI:</strong> {{ $ki->jenisKi->nama_jenis ?? '-' }}</p>
    <p><strong>Kabupaten/Kota:</strong> {{ $ki->kabupaten->nama_kabupaten ?? '-' }}</p>
    <p><strong>Pemilik:</strong> {{ $ki->pemilik ?? '-' }}</p>
    <p><strong>Status:</strong> {{ $ki->status ?? '-' }}</p>
    <p><strong>Tahun:</strong> {{ $ki->tahun ?? '-' }}</p>
    <p><strong>Tanggal Pengajuan:</strong> {{ $ki->tanggal_pengajuan ?? '-' }}</p>
    <p><strong>Keterangan:</strong> {{ $ki->keterangan ?? '-' }}</p>

    <a href="{{ route('data-ki.index') }}">Kembali ke Data KI</a>
</div>
@endsection