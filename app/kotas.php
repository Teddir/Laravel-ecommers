<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kotas extends Model
{
    protected $fillable = [
        'name_kota', 'onkos_kirim',
    ];
}
