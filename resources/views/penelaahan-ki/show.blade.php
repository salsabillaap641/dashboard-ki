
@extends('layouts.app')

@section('content')
<style>
    .review-detail { max-width:1000px; margin:auto; color:#263750; }
    .review-detail-header { margin-bottom:22px; }
    .review-detail-header h2 { margin:0 0 8px; font-size:26px; font-weight:750; }
    .review-detail-header p { margin:0; color:#64748b; font-size:14px; }
    .review-detail-card { background:white; border:1px solid #e2e8f0; border-radius:10px; padding:24px; margin-bottom:20px; box-shadow:0 3px 12px rgba(15,35,60,.04); }
    .review-detail-card h3 { font-size:17px; margin:0 0 18px; padding-bottom:12px; border-bottom:2px solid #ffc928; }
    .review-info { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; }
    .review-info small { display:block; color:#64748b; margin-bottom:6px; }
    .review-info strong { display:block; overflow-wrap:anywhere; }
    .review-form-group { margin-bottom:18px; }
    .review-form-group label { display:block; margin-bottom:8px; font-weight:700; font-size:14px; }
    .review-form-group select, .review-form-group textarea { box-sizing:border-box; width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:7px; font:inherit; color:#263750; background:white; }
    .review-form-group textarea { min-height:120px; resize:vertical; }
    .review-note { padding:12px 15px; background:#fff9e6; border-left:4px solid #ffc928; border-radius:5px; color:#66531b; font-size:13px; line-height:1.6; margin-bottom:20px; }
    .review-alert { padding:12px 16px; margin-bottom:18px; border-radius:7px; background:#e8f7ed; color:#176534; }
    .review-error { padding:12px 16px; margin-bottom:18px; border-radius:7px; background:#fff0f0; color:#b42318; }
    .review-actions { display:flex; justify-content:flex-end; flex-wrap:wrap; gap:10px; padding-top:18px; border-top:1px solid #edf0f4; }
    .review-btn { display:inline-block; padding:11px 17px; border:0; border-radius:7px; text-decoration:none; font-size:14px; font-weight:700; cursor:pointer; }
    .review-btn-primary { background:#344568; color:white; }
    .review-btn-light { background:#f1f5f9; color:#344568; }
    .review-history-item { padding:0 0 18px 18px; border-left:2px solid #dbe3ef; position:relative; margin-left:6px; }
    .review-history-item:last-child { padding-bottom:0; }
    .review-history-item:before { content:""; width:10px; height:10px; border-radius:50%; background:#ffc928; position:absolute; left:-6px; top:3px; }
    .review-history-item p { margin:7px 0 0; line-height:1.6; white-space:pre-wrap; }
    @media(max-width:650px) { .review-info { grid-template-columns:1fr; } .review-detail-card { padding:18px; } }
</style>

<div class="review-detail">
    <div class="review-detail-header">
        <h2>Detail Penelaahan Potensi KI</h2>
        <p>Periksa informasi pengajuan dan catat hasil penelaahan.</p>
    </div>

    @if(session('success'))
        <div class="review-alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="review-error">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin:8px 0 0;padding-left:20px">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="review-detail-card">
        <h3>Informasi Pengajuan</h3>

        <div class="review-info">
            <div>
                <small>Nama Potensi KI</small>
                <strong>{{ $pengajuanKi->nama_ki }}</strong>
            </div>

            <div>
                <small>Jenis KI</small>
                <strong>{{ $pengajuanKi->jenisKi->nama_jenis ?? $pengajuanKi->jenisKi->nama ?? '-' }}</strong>
            </div>

            <div>
                <small>Pemilik</small>
                <strong>{{ $pengajuanKi->pemilik }}</strong>
            </div>

            <div>
                <small>Kabupaten/Kota</small>
                <strong>{{ $pengajuanKi->kabupaten->nama_kabupaten ?? '-' }}</strong>
            </div>

            <div>
                <small>Tahun</small>
                <strong>{{ $pengajuanKi->tahun }}</strong>
            </div>

            <div>
                <small>Tanggal Pengajuan</small>
                <strong>{{ $pengajuanKi->tanggal_pengajuan ?? '-' }}</strong>
            </div>

            <div>
                <small>Nama Pengaju</small>
                <strong>{{ $pengajuanKi->userPengaju->name ?? '-' }}</strong>
            </div>

            <div>
                <small>Status Saat Ini</small>
                <strong>{{ ucwords(str_replace('_', ' ', $pengajuanKi->status_pengajuan ?? 'menunggu_penelaahan')) }}</strong>
            </div>
        </div>

        <div style="margin-top:22px">
            <small style="display:block;color:#64748b;margin-bottom:6px">Nomor Kontak Pemilik</small>
            <strong>{{ $pengajuanKi->nomor_kontak ?: '-' }}</strong>
        </div>

        <div style="margin-top:22px">
            <small style="display:block;color:#64748b;margin-bottom:6px">Bukti Pendukung</small>
            @if($pengajuanKi->bukti_pendukung)
                <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($pengajuanKi->bukti_pendukung) }}"
                   target="_blank" rel="noopener"
                   style="display:inline-block;padding:9px 13px;background:#e8eefb;color:#294575;border-radius:7px;text-decoration:none;font-weight:700;">
                    Lihat / Unduh Bukti Pendukung
                </a>
            @else
                <span>- Tidak ada bukti pendukung</span>
            @endif
        </div>

        <div style="margin-top:22px">
            <small style="display:block;color:#64748b;margin-bottom:6px">Keterangan Pengaju</small>
            <p style="white-space:pre-wrap;line-height:1.7">{{ $pengajuanKi->keterangan ?: 'Tidak ada keterangan.' }}</p>
        </div>

        @if($pengajuanKi->catatan_admin)
            <div style="margin-top:16px">
                <small style="display:block;color:#64748b;margin-bottom:6px">Catatan Master Sebelumnya</small>
                <p style="white-space:pre-wrap;line-height:1.7">{{ $pengajuanKi->catatan_admin }}</p>
            </div>
        @endif
    </div>

    <div class="review-detail-card">
        <h3>Hasil Penelaahan</h3>

        <div class="review-note">
            Pilih status sesuai hasil pemeriksaan. Jika memilih Perlu Perbaikan,
            tuliskan catatan yang jelas agar pengguna mengetahui apa yang perlu diperbaiki.
        </div>

        <form action="{{ route('penelaahan-ki.update', $pengajuanKi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="review-form-group">
                <label for="status_pengajuan">Status Pengajuan</label>
                <select name="status_pengajuan" id="status_pengajuan" required>
                    @foreach([
                        'sedang_ditelaah' => 'Sedang Ditelaah',
                        'perlu_perbaikan' => 'Perlu Perbaikan',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ] as $value => $label)
                        <option value="{{ $value }}"
                            @selected(old('status_pengajuan', $pengajuanKi->status_pengajuan) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="review-form-group">
                <label for="catatan_admin">Catatan untuk User</label>
                <textarea
                    name="catatan_admin"
                    id="catatan_admin"
                    placeholder="Tuliskan hasil penelaahan atau hal yang perlu diperbaiki..."
                >{{ old('catatan_admin', $pengajuanKi->catatan_admin) }}</textarea>
            </div>

            <div class="review-actions">
                <a href="{{ route('penelaahan-ki.index') }}" class="review-btn review-btn-light">
                    Kembali
                </a>

                <button type="submit" class="review-btn review-btn-primary">
                    Simpan Hasil Penelaahan
                </button>
            </div>
        </form>
    </div>


{{-- Tombol memasukkan pengajuan yang sudah diterima ke Data KI --}}
@if (
    $pengajuanKi->status_pengajuan === 'diterima'
    && !$pengajuanKi->data_ki_id
)
    <form
        action="{{ route('penelaahan-ki.masukkan-data', $pengajuanKi->id) }}"
        method="POST"
        onsubmit="return confirm('Masukkan pengajuan ini ke Data KI?')"
    >
        @csrf

        <button type="submit" class="btn btn-success">
            Masukkan ke Data KI
        </button>
    </form>
@elseif ($pengajuanKi->data_ki_id)
    <div class="alert alert-success">
        Pengajuan ini sudah dimasukkan ke Data KI.
    </div>
@endif


    <div class="review-detail-card">
        <h3>Riwayat Penelaahan</h3>

        @forelse($pengajuanKi->riwayatPengajuan as $riwayat)
            <div class="review-history-item">
                <strong>{{ ucwords(str_replace('_', ' ', $riwayat->status_baru)) }}</strong>

                <div style="color:#64748b;font-size:12px;margin-top:5px">
                    {{ $riwayat->user->name ?? 'Pengguna tidak tersedia' }}
                    · {{ $riwayat->created_at?->format('d-m-Y H:i') }}
                </div>

                <p>{{ $riwayat->catatan ?: 'Tidak ada catatan.' }}</p>
            </div>
        @empty
            <p style="color:#64748b">Belum ada riwayat penelaahan.</p>
        @endforelse
    </div>
</div>
@endsection
