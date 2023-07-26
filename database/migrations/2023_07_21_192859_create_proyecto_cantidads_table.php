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
        Schema::create('proyecto_cantidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('etiqueta_id');
            $table->double('cantidad');
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('proyectos'); 
            $table->foreign('etiqueta_id')->references('id')->on('proyecto_etiquetas'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_cantidads');
    }
};
