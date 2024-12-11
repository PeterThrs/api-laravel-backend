<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $table = 'planta';
    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'familia',
        'tipo',
        'origen',
       'descripcion',
       'imagen'
    ];
}
