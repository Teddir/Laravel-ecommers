<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hubungis extends Model
{
    protected $fillable = [
        'name_hubungi', 'email', 'subjek', 'message','date',
    ];
}
