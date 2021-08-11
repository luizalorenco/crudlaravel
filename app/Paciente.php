<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //definindo os atributos iniciais
    protected $fillable = ['nome','genero'];
}
