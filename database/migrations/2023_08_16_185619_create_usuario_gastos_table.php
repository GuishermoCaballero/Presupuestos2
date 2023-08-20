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
        Schema::create('usuario_gastos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gasto_id');
            $table->unsignedBigInteger('usuario_id');
            $table->double('cantidad');
            $table->timestamps();

            $table->foreign('gasto_id')->references('id')->on('gastos'); 
            $table->foreign('usuario_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_gastos');
    }
};
