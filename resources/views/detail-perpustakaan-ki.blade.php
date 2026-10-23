
@extends('layouts.app')

@section('title', 'Detail Kekayaan Intelektual')

@section('content')
<div style="max-width: 900px; margin: auto;">

    <div style="margin-bottom: 24px;">
        <a href="{{ route('perpustakaan-ki.index') }}"
           style="color: #1c426c; text-decoration: none;">
            ← Kembali ke Perpustakaan KI
        </a>

        <h1 style="color: #26364f; margin-bottom: 8px;">
            Detail Kekayaan Intelektual
        </h1>
        <p style="color: #6b7280;">
            Informasi lengkap data kekayaan intelektual.
        </p>
    </div>

    <div style="background: white; padding: 28px;
                border-radius: 14px; border: 1px solid #e8edf3;">

        <h2 style="color: #1c426c; margin-top: 0;">
            {{ $item->nama_hak }}
        </h2>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 12px 0; width: 35%;">Nomor Hak</td>
                <td style="padding: 12px 0;">
                    {{ $item->nomor_hak ?: '-' }}
                </td>
            </tr>
            <tr>
                <td style="padding: 12px 0;">Jenis KI</td>
                <td style="padding: 12px 0;">
                    {{ $item->jenisKi->nama_jenis ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="padding: 12px 0;">Kabupaten/Kota</td>
                <td style="padding: 12px 0;">
                    {{ $item->kabupaten->nama_kabupaten ?? '-' }}
                </td>
            </tr>
        </table>

        <hr style="border: 0; border-top: 1px solid #e8edf3;
                   margin: 20px 0;">

        <h3 style="color: #26364f;">Informasi Data KI</h3>

        @if ($item->dataKi)
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 12px 0; width: 35%;">Nama KI</td>
                    <td style="padding: 12px 0;">
                        {{ $item->dataKi->nama_ki }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px 0;">Pemilik</td>
                    <td style="padding: 12px 0;">
                        {{ $item->dataKi->pemilik ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px 0;">Status</td>
                    <td style="padding: 12px 0;">
                        {{ ucfirst($item->dataKi->status ?? '-') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px 0;">Tahun</td>
                    <td style="padding: 12px 0;">
                        {{ $item->dataKi->tahun ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px 0;">Tanggal Pengajuan</td>
                    <td style="padding: 12px 0;">
                        {{ $item->dataKi->tanggal_pengajuan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px 0;">Keterangan</td>
                    <td style="padding: 12px 0;">
                        {{ $item->dataKi->keterangan ?? '-' }}
                    </td>
                </tr>
            </table>
        @else
            <p style="color: #6b7280;">
                Data KI sumber tidak tersedia atau tidak lagi terhubung.
            </p>
        @endif

    </div>
</div>
@endsection
