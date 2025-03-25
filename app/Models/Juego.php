<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Juego extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'titulo',
        'precio',
        'descripcion',
        'requisitos_minimos',
        'requisitos_recomendados',
        'id_categoria',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id_juego');
    }

    public function convenios(): HasMany
    {
        return $this->hasMany(Convenio::class, 'id_juego');
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'id_juego');
    }

    public function inventario(): HasMany
    {
        return $this->hasMany(Inventario::class, 'id_juego');
    }

    public function intercambiosSolicitados(): HasMany
    {
        return $this->hasMany(Intercambio::class, 'id_productosolicitado');
    }

    public function intercambiosOfrecidos(): HasMany
    {
        return $this->hasMany(Intercambio::class, 'id_productoofrecido');
    }
}