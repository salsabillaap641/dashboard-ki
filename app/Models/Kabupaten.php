<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';

    protected $fillable = [
        'nama_kabupaten',
    ];

    public function dataKi()
{
    return $this->hasMany(
        DataKi::class,
        'kabupaten_id'
    );
}
}