<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $perPage = 20;

    protected $fillable = [
        'total', 
        'id_pedido', 
        'metodo_de_pago',
        'id_intercambio'  // Added this line
    ];

    public function pedido()
    {
        return $this->belongsTo(\App\Models\Pedido::class, 'id_pedido', 'id');
    }

    public function intercambio()
    {
        return $this->belongsTo(\App\Models\Intercambio::class, 'id_intercambio', 'id');
    }
}
