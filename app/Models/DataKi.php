<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKi extends Model
{
    protected $table = 'data_ki';
    public $timestamps = false;

    protected $fillable = [
    'nama_ki',
    'jenis_ki_id',
    'kabupaten_id',
    'pemilik',
    'status',
    'tahun',
    'tanggal_pengajuan',
    'keterangan',
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

}