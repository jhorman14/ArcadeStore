<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log; // Add this line

class Venta extends Model
{
    protected $perPage = 20;

    protected $fillable = ['fecha_venta', 'id_usuario', 'id_juego', 'id_pedido'];

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
        Log::info('Iniciando Venta::createFromPedido para pedido ID: ' . $pedido->id); // Add this line
        try {
            $venta = self::create([
                'fecha_venta' => now(),
                'id_usuario' => $pedido->id_usuario,
                'id_juego' => $pedido->id_juego,
                'id_pedido' => $pedido->id,
            ]);
            Log::info('Venta creada exitosamente con ID: ' . $venta->id); // Add this line
            return $venta;
        } catch (\Exception $e) {
            Log::error('Error en Venta::createFromPedido: ' . $e->getMessage()); // Add this line
            throw $e; // Re-throw the exception to be caught in the controller
        }
    }
}
