<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $perPage = 20;

    protected $fillable = [
        'nombre_categoria', 
        'descripcion',
        'activo'
    ];

    public function juegos()
    {
        return $this->hasMany(Juego::class, 'id_categoria', 'id');
    }
}
