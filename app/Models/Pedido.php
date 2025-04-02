<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property $id
 * @property $fecha_pedido
 * @property $estado_pedido
 * @property $id_usuario
 * @property $id_juego
 * @property $created_at
 * @property $updated_at
 *
 * @property Juego $juego
 * @property User $user
 * @property pago[] $arcadestore.pagos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['fecha_pedido', 'estado_pedido', 'id_usuario', 'id_juego'];


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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany(\App\Models\pago::class, 'id', 'id_pedido');
    }
    
}
