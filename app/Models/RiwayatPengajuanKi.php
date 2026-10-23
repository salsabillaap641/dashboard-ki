<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengajuanKi extends Model
{
    protected $table = 'riwayat_pengajuan_ki';

    protected $fillable = [
        'pengajuan_ki_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'catatan',
    ];

    public function pengajuanKi()
    {
        return $this->belongsTo(
            PengajuanKi::class,
            'pengajuan_ki_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
