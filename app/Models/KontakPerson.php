<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontakPerson extends Model
{
    protected $table = 'kontak_person';

    protected $fillable = [
        'alamat',
        'nomor_admin',
        'email',
        'jam_layanan',
    ];
}
