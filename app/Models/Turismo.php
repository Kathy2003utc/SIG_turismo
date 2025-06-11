<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turismo extends Model
{
    use HasFactory;

    protected $table = 'turismos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'imagenes',
        'latitud',
        'longitud',
    ];
}
