<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategoris extends Model
{
    protected $fillable = [
        'id','id_main', 'name_kategori', 'keterangan', 'image','tgl_posting',
    ];
}
