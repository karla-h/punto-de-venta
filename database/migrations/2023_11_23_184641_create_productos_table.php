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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idproducto');
            $table->string('descripcion', 40);
            $table->unsignedBigInteger('idcategoria')->nullable();
            $table->enum('estado', [0, 1]);
            $table->unsignedBigInteger('idtalla')->nullable();
            $table->integer('stock');
            $table->decimal('precio',8,2);
            $table->foreign('idcategoria')->references('idcategoria')->on('categorias');
            $table->foreign('idtalla')->references('idtalla')->on('tallas');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
