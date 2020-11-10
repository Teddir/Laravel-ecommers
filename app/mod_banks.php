<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_banks extends Model
{
    protected $fillable = [
        'id','name_bank', 'rekening_number', 'pemilik', 'image',
    ];

}
