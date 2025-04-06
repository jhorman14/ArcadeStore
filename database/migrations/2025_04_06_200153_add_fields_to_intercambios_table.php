<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('intercambios', function (Blueprint $table) {
        $table->unsignedBigInteger('id_usuario')->after('fecha_intercambio');
        $table->decimal('costo_adicional', 10, 2)->nullable()->after('id_producto_ofrecido');
        $table->foreign('id_usuario')->references('id')->on('users');
    });
}

public function down()
{
    Schema::table('intercambios', function (Blueprint $table) {
        $table->dropForeign(['id_usuario']);
        $table->dropColumn(['id_usuario', 'costo_adicional']);
    });
}

};
