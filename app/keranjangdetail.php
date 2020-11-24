<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjangdetail extends Model
{
    protected $fillable = ['jumlah_pesan', 'subtotal', 'produk_id', 'keranjang_id'];


    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(produks::class, 'id', 'produk_id');
    }

    public function keranjangs()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(keranjangs::class, 'keranjang_id', 'id');
    }


}

