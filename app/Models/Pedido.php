<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pedido
 *
 * @property int $id
 * @property \Carbon\Carbon|null $fecha_pedido
 * @property string|null $estado_pedido
 * @property int $id_usuario
 * @property int $id_juego
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @property Juego $juego
 * @property User $user
 * @property Pago|null $pago
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Pedido extends Model
{

    protected $perPage = 20;

    protected $fillable = [
        'fecha_pedido',
        'estado_pedido',
        'id_usuario',
        'id_juego',
        'cantidad',
        'id_intercambio'
    ];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pago()
    {
        return $this->hasOne(\App\Models\Pago::class, 'id_pedido', 'id');
    }

}