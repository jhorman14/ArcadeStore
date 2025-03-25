<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedido extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'fecha_pedido',
        'estado_pedido',
        'id_usuario',
        'id_juego',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function juego(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'id_juego');
    }

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'id_pedido');
    }

}
