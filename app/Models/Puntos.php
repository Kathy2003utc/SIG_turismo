<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class puntos extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'latitud',
        'longitud',
    ];
}