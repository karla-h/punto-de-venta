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
        Schema::create('detalleventas', function (Blueprint $table) {
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('producto_id');
            $table->float('precio');
            $table->float('cantidad');
            $table->foreign('venta_id')->references('venta_id')->on('cabeceraventas');     
            $table->foreign('producto_id')->references('idproducto')->on('productos');     
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventas');
    }
};
