<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Venta
 *
 * @property $id
 * @property $fecha_venta
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
class Venta extends Model
{
    protected $perPage = 20;

    protected $fillable = ['fecha_venta', 'id_usuario', 'id_juego', 'id_pedido']; // Add id_pedido

    public function juego()
    {
        return $this->belongsTo(Juego::class, 'id_juego', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id');
    }

    public static function createFromPedido(Pedido $pedido)
    {
        return self::create([
            'fecha_venta' => now(),
            'id_usuario' => $pedido->id_usuario,
            'id_juego' => $pedido->id_juego,
            'id_pedido' => $pedido->id,
        ]);
    }
}
