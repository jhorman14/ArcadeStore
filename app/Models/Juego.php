<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Juego
 *
 * @property $id
 * @property $titulo
 * @property $precio
 * @property $descripcion
 * @property $requisitos_minimos
 * @property $requisitos_recomendados
 * @property $id_categoria
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Convenio[] $convenios
 * @property Intercambio[] $intercambios_ofrecidos
 * @property Inventario $inventario
 * @property Pedido[] $pedidos
 * @property Venta[] $ventas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Juego extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['titulo', 'precio', 'descripcion', 'requisitos_minimos', 'requisitos_recomendados', 'id_categoria', 'imagen'];

    /**
     * @return BelongsTo
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function convenios()
    {
        return $this->hasMany(Convenio::class, 'id_juego', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intercambios_ofrecidos()
    {
        return $this->hasMany(Intercambio::class, 'id_producto_ofrecido', 'id');
    }

    /**
     * @return HasOne
     */
    public function inventario(): HasOne
    {
        return $this->hasOne(Inventario::class, 'id_juego', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_juego', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_juego', 'id');
    }
}