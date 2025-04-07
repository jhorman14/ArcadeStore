<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intercambios', function (Blueprint $table) {
            $table->id();
            $table->string('estado_intercambio', 100);
            $table->date('fecha_intercambio');
            $table->unsignedBigInteger('id_producto_solicitado');
            $table->unsignedBigInteger('id_producto_ofrecido');
            $table->unsignedBigInteger('id_usuario');
            $table->decimal('costo_adicional', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_producto_solicitado')->references('id')->on('juegos');
            $table->foreign('id_producto_ofrecido')->references('id')->on('juegos');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intercambios');
    }
};
