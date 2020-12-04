<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finish extends Model
{
    protected $fillable = ['qty', 'status', 'pengiriman', 'produk_id', 'user_id', 'penjual_id'];

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(produks::class, 'produk_id')->with('penjuals');
    }

    public function keranjangdetails()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(keranjangdetail::class, 'id');
    }

    public function keranjangs()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(keranjangs::class, 'user_id');
    }


    public function penjuals()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(penjuals::class, 'id');
    }

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
