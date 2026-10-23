
@extends('layouts.app')

@section('content')
<div style="max-width:850px;margin:auto;color:#263750">
    <h2 style="margin-bottom:8px">Edit Pengajuan Potensi KI</h2>
    <p style="color:#64748b;margin-bottom:24px">
        Perbaiki data sesuai catatan dari Master, lalu kirim ulang pengajuan.
    </p>

    @if($errors->any())
        <div style="background:#fff0f0;color:#b42318;padding:14px;border-radius:8px;margin-bottom:20px">
            <ul style="margin:0;padding-left:20px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($pengajuanKi->catatan_admin)
        <div style="background:#fff5d8;padding:16px;border-radius:8px;margin-bottom:20px">
            <strong>Catatan dari Master</strong>
            <p style="margin:8px 0 0;white-space:pre-wrap">{{ $pengajuanKi->catatan_admin }}</p>
        </div>
    @endif

    <div style="background:white;padding:24px;border:1px solid #e2e8f0;border-radius:10px">
        <form action="{{ route('pengajuan-saya.update', $pengajuanKi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:18px">
                <label for="nama_ki">Nama Potensi KI</label>
                <input id="nama_ki" name="nama_ki" required maxlength="255"
                    value="{{ old('nama_ki', $pengajuanKi->nama_ki) }}"
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">
            </div>

            <div style="margin-bottom:18px">
                <label for="jenis_ki_id">Jenis KI</label>
                <select id="jenis_ki_id" name="jenis_ki_id" required
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">
                    @foreach($jenisKI as $jenis)
                        <option value="{{ $jenis->id }}"
                            @selected((string)old('jenis_ki_id', $pengajuanKi->jenis_ki_id) === (string)$jenis->id)>
                            {{ $jenis->nama_jenis ?? $jenis->nama ?? $jenis->jenis_ki ?? 'Jenis KI '.$jenis->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom:18px">
                <label for="pemilik">Pemilik KI</label>
                <input id="pemilik" name="pemilik" required maxlength="255"
                    value="{{ old('pemilik', $pengajuanKi->pemilik) }}"
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">
            </div>

            <div style="margin-bottom:18px">
                <label for="tahun">Tahun</label>
                <input type="number" id="tahun" name="tahun" required min="1900" max="2100"
                    value="{{ old('tahun', $pengajuanKi->tahun) }}"
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">
            </div>

            <div style="margin-bottom:18px">
                <label for="tanggal_pengajuan">Tanggal Pengajuan (opsional)</label>
                <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan"
                    value="{{ old('tanggal_pengajuan', $pengajuanKi->tanggal_pengajuan) }}"
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">
            </div>

            <div style="margin-bottom:22px">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4"
                    style="display:block;box-sizing:border-box;width:100%;padding:11px;margin-top:7px;border:1px solid #cbd5e1;border-radius:7px">{{ old('keterangan', $pengajuanKi->keterangan) }}</textarea>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap">
                <a href="{{ route('pengajuan-saya') }}"
                    style="padding:11px 16px;background:#f1f5f9;color:#344568;text-decoration:none;border-radius:7px">
                    Batal
                </a>

                <button type="submit"
                    style="padding:11px 16px;background:#344568;color:white;border:0;border-radius:7px;cursor:pointer">
                    Simpan dan Kirim Ulang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
