<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Convenio
 *
 * @property $id
 * @property $descripcion
 * @property $fecha_inicio
 * @property $fecha_fin
 * @property $id_usuario
 * @property $id_juego
 * @property $created_at
 * @property $updated_at
 *
 * @property Juego $juego
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Convenio extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['descripcion', 'fecha_inicio', 'fecha_fin', 'id_usuario', 'id_juego'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juego()
    {
        return $this->belongsTo(\App\Models\Juego::class, 'id_juego', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_usuario', 'id');
    }
    
}
