<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intercambio extends Model
{
    protected $fillable = [
        'estado_intercambio',
        'fecha_intercambio',
        'id_usuario',
        'id_producto_solicitado',
        'id_producto_ofrecido',
        'costo_adicional'
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    // Relación con el juego solicitado
    public function juegoSolicitado()
    {
        return $this->belongsTo(Juego::class, 'id_producto_solicitado');
    }

    // Relación con el juego ofrecido
    public function juegoOfrecido()
    {
        return $this->belongsTo(Juego::class, 'id_producto_ofrecido');
    }

    // Relación con el pedido
    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'id_intercambio');
    }

    // Relación con el pago
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_intercambio');
    }
}
