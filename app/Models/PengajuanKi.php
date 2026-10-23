<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanKi extends Model
{
    protected $table = 'pengajuan_ki';

    protected $fillable = [
        'user_pengaju_id',
        'nama_ki',
        'jenis_ki_id',
        'kabupaten_id',
        'pemilik',
        'nomor_kontak',
        'bukti_pendukung',
        'tahun',
        'tanggal_pengajuan',
        'keterangan',
        'status_pengajuan',
        'catatan_admin',
        'data_ki_id',
    ];

    public function userPengaju()
    {
        return $this->belongsTo(
            User::class,
            'user_pengaju_id'
        );
    }

    public function jenisKi()
    {
        return $this->belongsTo(
            JenisKi::class,
            'jenis_ki_id'
        );
    }

    public function kabupaten()
    {
        return $this->belongsTo(
            Kabupaten::class,
            'kabupaten_id'
        );
    }

    public function riwayatPengajuan()
    {
        return $this->hasMany(
            RiwayatPengajuanKi::class,
            'pengajuan_ki_id'
        )->orderBy('created_at', 'desc');
    }

    public function dataKi()
    {
        return $this->belongsTo(
            DataKi::class,
            'data_ki_id'
        );
    }
}
