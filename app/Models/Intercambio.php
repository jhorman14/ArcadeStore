<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intercambio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'estado_intercambio',
        'fecha_intercambio',
        'id_productosolicitado',
        'id_productoofrecido',
    ];

    public function productoSolicitado(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'id_productosolicitado');
    }

    public function productoOfrecido(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'id_productoofrecido');
    }
}