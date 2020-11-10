<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kotas extends Model
{
    protected $fillable = [
        'id','name_kota', 'onkos_kirim',
    ];
}
