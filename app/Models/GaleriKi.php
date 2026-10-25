<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriKi extends Model
{
    protected $table = 'galeri_ki';

    protected $fillable = [
        'nama_produk',
        'jenis_ki_id',
        'nomor_permohonan',
        'caption',
        'foto',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function jenisKi()
    {
        return $this->belongsTo(JenisKi::class, 'jenis_ki_id');
    }
}
