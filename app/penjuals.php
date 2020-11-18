<?php

namespace App;

use GuzzleHttp\Psr7\Message;
use Illuminate\Database\Eloquent\Model;

class penjuals extends Model
{
    protected $fillable = [
        'name_toko','phone_number',
        'message_id','penjual_id', //---->user is penjual
    ];

    public function messages()
    {
        return $this->hasMany(messages::class, 'id');
    }

    public function penjuals()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(penjuals::class, 'id', 'penjual_id' );
    }

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasOne(User::class, 'id', 'penjual_id' );
    }

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(produks::class, 'id', 'penjual_id' );
    }

}
