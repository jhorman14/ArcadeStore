<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Intercambio
 *
 * @property $id
 * @property $estado_intercambio
 * @property $fecha_intercambio
 * @property $id_producto_solicitado
 * @property $id_producto_ofrecido
 * @property $created_at
 * @property $updated_at
 *
 * @property Juego $productoSolicitado
 * @property Juego $productoOfrecido
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Intercambio extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['estado_intercambio', 'fecha_intercambio', 'id_producto_solicitado', 'id_producto_ofrecido'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productoSolicitado()
    {
        return $this->belongsTo(Juego::class, 'id_producto_solicitado', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productoOfrecido()
    {
        return $this->belongsTo(Juego::class, 'id_producto_ofrecido', 'id');
    }
}
