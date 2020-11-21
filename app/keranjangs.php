<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keranjangs extends Model
{
    protected $fillable = [
        'subtotal',
        'user_id'
    ];

    
    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    
    public function keranjangdetails()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(keranjangdetails::class, 'keranjang_id', 'id');
    }
    
    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(produks::class, 'id', 'keranjang_id');
    }

    public function chekouts()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(chekouts::class,  'keranjang_id', 'id');
    }
}
