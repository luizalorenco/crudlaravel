<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = [
        'desc_cargo',
        'nome_cargo'
    ];
}
