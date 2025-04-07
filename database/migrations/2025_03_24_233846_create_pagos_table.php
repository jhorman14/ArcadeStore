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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('metodo_de_pago', 50);
            $table->decimal('total', 10, 2);  // Changed to decimal for better precision
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_intercambio')->nullable();  // Added this line
            $table->timestamps();

            $table->foreign('id_pedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_intercambio')->references('id')->on('intercambios')->onDelete('set null');  // Added this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
