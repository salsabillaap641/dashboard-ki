<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKi extends Model
{
    protected $table = 'jenis_ki';

    protected $fillable = [
        'nama_jenis',
    ];

    public function dataKi()
{
    return $this->hasMany(
        DataKi::class,
        'jenis_ki_id'
    );
}
}