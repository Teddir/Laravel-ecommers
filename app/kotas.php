<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kotas extends Model
{
    protected $fillable = [
        'name_kota', 'onkos_kirim',
    ];

    public function kotas()
    {
        return $this->hasOne(kotas::class, 'id', 'user_id');
    }


    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
