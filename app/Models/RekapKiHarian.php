<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapKiHarian extends Model
{
    protected $table = 'rekap_ki_harian';

    protected $fillable = [
        'tanggal_data',
        'kabupaten_id',
        'jenis_ki_id',
        'status',
        'jumlah',
    ];

    protected $casts = [
        'tanggal_data' => 'date',
        'jumlah' => 'integer',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function jenisKi()
    {
        return $this->belongsTo(JenisKi::class, 'jenis_ki_id');
    }
}
