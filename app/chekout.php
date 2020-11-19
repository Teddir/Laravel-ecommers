<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chekout extends Model
{
    protected $fillable = [
        'qty', 'produk_name', 'produk_price', 'produk_image',
        'keranjang_id', 'produk_id'
    ];

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(produks::class,  'id', 'produk_id');
    }


    public function keranjangs()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasOne(keranjangs::class, 'id', 'keranjang_id');
    }

}
