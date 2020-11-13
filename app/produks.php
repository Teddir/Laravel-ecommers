<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produks extends Model
{
    protected $fillable = [
        'name_produk', 'desc', 'harga','stok','tgl_masuk','image','terjual','diskon',
        
    ];

    public function child()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY parent_id
        return $this->hasMany(produks::class, 'name_kategori');
    }

    public function kategoris()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI KATEGORI INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(kategoris::class, 'name_kategori');
    }


}
