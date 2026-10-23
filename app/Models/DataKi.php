<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatPengajuanKi;
use App\Models\User;

class DataKi extends Model
{
    protected $table = 'data_ki';
    public $timestamps = false;

    protected $fillable = [
    'nama_ki',
    'jenis_ki_id',
    'kabupaten_id',
    'pemilik',
    'nomor_kontak',
    'bukti_pendukung',
    'status',
    'tahun',
    'tanggal_pengajuan',
    'keterangan',
    'user_pengaju_id',
'status_pengajuan',
'catatan_admin',
];

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
public function perpustakaanKi()
{
    return $this->hasOne(
        \App\Models\PerpustakaanKi::class,
        'data_ki_id'
    );
}

public function riwayatPengajuan()
{
    return $this->hasMany(
        RiwayatPengajuanKi::class,
        'data_ki_id'
    )->orderBy('created_at', 'desc');
}

public function userPengaju()
{
    return $this->belongsTo(User::class, 'user_pengaju_id');
}

}