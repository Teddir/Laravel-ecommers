<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penjuals extends Model
{
    protected $fillable = [
        'name_penjual', 'password', 'email', 'alamat','phone_number','id_produk','id_kategori','id_kota',
    ];
}
