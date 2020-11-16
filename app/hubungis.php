<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hubungis extends Model
{
    protected $fillable = [
        'email', 'subjek', 'message',
        'hubungi_id',
    ];

    public function users()
    {
        //JENIS RELASINYA ADALAH ONE TO MANY, YANG BERARTI produk INI BISA DIGUNAKAN OLEH BANYAK PRODUK
        return $this->hasMany(User::class, 'id');
    }
}
