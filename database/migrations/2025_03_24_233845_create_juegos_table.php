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
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->double('precio');
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->text('requisitos_minimos')->nullable();
            $table->text('requisitos_recomendados')->nullable();
            $table->string('imagen')->nullable(); // Agrega el campo para la imagen
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};
