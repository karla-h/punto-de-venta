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
        Schema::create('cabeceraventas', function (Blueprint $table) {
            $table->id('venta_id');
            $table->unsignedBigInteger('cliente_id');
            $table->date('fecha_venta');
            $table->unsignedBigInteger('tipo_id');
            $table->string('num_doc', 12);
            $table->float('total');
            $table->float('subtotal');
            $table->float('igv');
            $table->enum('estado', [0, 1]);
            $table->foreign('cliente_id')->references('cliente_id')->on('clientes');     
            $table->foreign('tipo_id')->references('tipo_id')->on('tipo');     
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabeceraventas');
    }
};
