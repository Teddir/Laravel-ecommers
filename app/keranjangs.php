<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjangs extends Model
{
    protected $fillable = [
        'jumlah', 'qty', 'produk_name','produk_price','produk_image',
        'user_id','produk_id'
    ];

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasOne(produks::class, 'id','produk_id' );
    }

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasOne(User::class, 'id','user_id' );
    }

}