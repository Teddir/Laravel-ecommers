<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjangs extends Model
{
    protected $fillable = [
        'id','id_kategori', 'jumlah', 'date', 'id_user',
    ];
}
