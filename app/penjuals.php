<?php

namespace App;

use GuzzleHttp\Psr7\Message;
use Illuminate\Database\Eloquent\Model;

class penjuals extends Model
{
    protected $fillable = [
        'name_toko', 'phone_number',
        'message_id', 'user_id', 'produk_id'  //---->user is penjual
    ];


    public function penjuals()
    {
        return $this->hasMany(penjuals::class, 'penjual_id');
    }

    public function messages()
    {
        return $this->hasMany(messages::class, 'id', 'penjual_id');
    }

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(produks::class, 'penjual_id' );
    }

    public function keranjangdetails()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(keranjangdetail::class, 'id' );
    }

    public function finish()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(finish::class, 'penjual_id' );
    }

}
