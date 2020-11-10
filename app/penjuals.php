<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penjuals extends Model
{
    protected $fillable = [
        'name_penjual','avatar', 'password', 'email', 'alamat','phone_number','id_message',
    ];
}
