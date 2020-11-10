<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    protected $fillable = [
        'id','id_produk', 'jumlah',
    ];
}
