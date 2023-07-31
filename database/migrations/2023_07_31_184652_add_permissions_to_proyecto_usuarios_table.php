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
        Schema::table('proyecto_usuarios', function (Blueprint $table) {
            $table->boolean('puede_ver');
            $table->boolean('puede_editar_etiquetas');
            $table->boolean('puede_editar_cantidades');
            $table->boolean('puede_editar_usuarios');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyecto_usuarios', function (Blueprint $table) {
            $table->dropColumn('puede_ver');
            $table->dropColumn('puede_editar_etiquetas');
            $table->dropColumn('puede_editar_cantidades');
            $table->dropColumn('puede_editar_usuarios');
        });
    }
};
