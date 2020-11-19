<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'invoice', 'subtotal', 'status','pengiriman','pesan',
        'user_id','produk_id'
    ];


    public function orders()
    {
        return $this->hasMany(orders::class, 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function produks()
    {
        return $this->hasOne(produks::class, 'id', 'produk_id');
    }

    public function keranjangs()
    {
        return $this->hasOne(keranjangs::class, 'id', 'produk_id');
    }
}
