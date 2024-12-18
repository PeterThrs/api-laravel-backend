<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $fillable = [ //datos editables
        'name',
        'email',
        'password',
        'phone',
        'img_url'
    ];

}
