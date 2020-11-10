<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produks extends Model
{
    protected $fillable = [
        'name_produk', 'desc', 'harga','stok','tgl_masuk','image','terjual','diskon',
    ];
}
