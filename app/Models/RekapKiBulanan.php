<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapKiBulanan extends Model
{
    protected $table = 'rekap_ki_bulanan';

    protected $fillable = [
        'kabupaten_id',
        'jenis_ki_id',
        'status',
        'bulan',
        'tahun',
        'jumlah',
    ];

    protected $casts = [
        'bulan' => 'integer',
        'tahun' => 'integer',
        'jumlah' => 'integer',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(
            Kabupaten::class,
            'kabupaten_id'
        );
    }

    public function jenisKi()
    {
        return $this->belongsTo(
            JenisKi::class,
            'jenis_ki_id'
        );
    }
}
