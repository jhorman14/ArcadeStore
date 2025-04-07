<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_juego');
            $table->unsignedBigInteger('id_pedido')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreign('id_juego')->references('id')->on('juegos')->onDelete('cascade');
            
            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade'); // Cambiamos de set null a cascade
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
