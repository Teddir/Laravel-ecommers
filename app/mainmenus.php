<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mainmenus extends Model
{
    protected $fillable = [
        'id', 'name_menu', 'link', 'aktif',
    ];
}
