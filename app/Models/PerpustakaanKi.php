<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerpustakaanKi extends Model
{
    protected $table = 'perpustakaan_ki';

    protected $fillable = [
        'data_ki_id',
        'nama_hak',
        'nomor_hak',
        'jenis_ki_id',
        'kabupaten_id',
    ];

    public function dataKi()
    {
        return $this->belongsTo(DataKi::class, 'data_ki_id');
    }

    public function jenisKi()
    {
        return $this->belongsTo(JenisKi::class, 'jenis_ki_id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
}
