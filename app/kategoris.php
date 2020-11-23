<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategoris extends Model
{
    protected $fillable = [
        'name_kategori'
        // 'tgl_posting'---> diganti sama created_at
    ];

    
    public function kategoris()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(kategoris::class, 'id', 'kategori_id' );
    }

    public function produks()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->belongsTo(produks::class, 'id','kategori_id');
    }

    
}
