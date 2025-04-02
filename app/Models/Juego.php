<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property convenio[] $arcadestore.convenios
 * @property intercambio[] $arcadestore.intercambios
 * @property intercambio[] $arcadestore.intercambios
 * @property inventario[] $arcadestore.inventarios
 * @property pedido[] $arcadestore.pedidos
 * @property venta[] $arcadestore.ventas
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function convenios()
    {
        return $this->hasMany(convenio::class, 'id', 'id_juego');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intercambios()
    {
        return $this->hasMany(intercambio::class, 'id', 'id_producto_ofrecido');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany(inventario::class, 'id', 'id_juego');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany(pedido::class, 'id', 'id_juego');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventas()
    {
        return $this->hasMany(venta::class, 'id', 'id_juego');
    }
    
}
