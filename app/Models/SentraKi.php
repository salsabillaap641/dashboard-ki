<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentraKi extends Model
{
    protected $table = 'sentra_ki';

    protected $fillable = [
        'nama_sentra',
        'alamat',
    ];
}
