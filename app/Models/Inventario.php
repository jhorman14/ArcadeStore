<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventario
 *
 * @property $id
 * @property $stock
 * @property $id_juego
 * @property $created_at
 * @property $updated_at
 *
 * @property Juego $juego
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inventario extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['stock', 'id_juego'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juego()
    {
        return $this->belongsTo(\App\Models\Juego::class, 'id_juego', 'id');
    }
    
}
