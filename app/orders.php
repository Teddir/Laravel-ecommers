<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'status_order', 'tgl_order', 'time', 'id_user',
    ];
}
