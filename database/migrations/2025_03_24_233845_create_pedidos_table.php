<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pedido')->default(DB::raw('CURRENT_DATE'));
            $table->string('estado_pedido', 50)->default('Pendiente'); // Agregado valor por defecto
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_juego');
            $table->integer('cantidad')->default(1);
            $table->unsignedBigInteger('id_intercambio')->nullable()->unique(); // Agregamos unique
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_juego')->references('id')->on('juegos');           
            $table->foreign('id_intercambio')->references('id')->on('intercambios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
