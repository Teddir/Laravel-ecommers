<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produks extends Model
{
    protected $fillable = [
        'name_produk', 'desc', 'harga', 'stok', 'image', 'diskon', 'status',
        'kategori_id', 'penjual_id'


    ];

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(produks::class, 'id', 'produk_id');
    }


    public function kategoris()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI KATEGORI INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(kategoris::class, 'id', 'kategori_id');
    }

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function keranjangs()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(keranjangs::class, 'id', 'produk_id');
    }


    public function finish()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(finish::class, 'penjual_id');
    }

    public function chekouts()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(chekouts::class, 'id', 'produk_id');
    }

    public function penjuals()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(penjuals::class,'id');
    }
}
