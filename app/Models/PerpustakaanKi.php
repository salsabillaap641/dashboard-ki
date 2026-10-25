<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerpustakaanKi extends Model
{
    protected $table = 'perpustakaan_ki';

    protected $fillable = [
        'nama_hak',
        'nomor_permohonan',
        'jenis_ki_id',
    ];

    public function jenisKi(): BelongsTo
    {
        return $this->belongsTo(JenisKi::class, 'jenis_ki_id');
    }
}
