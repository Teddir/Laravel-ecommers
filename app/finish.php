<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finish extends Model
{
    protected $fillable = ['qty', 'status', 'pengiriman', 'produk_id', 'user_id'];

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(produks::class, 'id', 'produk_id');
    }

    public function keranjangdetails()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(keranjangdetail::class, 'id', 'keranjangdetail_id');
    }


    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'user_id' , 'id');
    }


}
