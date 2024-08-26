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
        Schema::create('predio', function (Blueprint $table) {
            $table->id('idPredio');
            $table->string('nombre', 30);
            $table->string('descripcion', 100);
            $table->string('estadoRepublica', 30);
            $table->string('municipio', 30);
            $table->string('localidad', 30);
            $table->integer('hectarias');
            $table->integer('numeroManzanas');
            $table->integer('numeroLotes');
            $table->date('fechaInauguracion');
            $table->boolean('activo')->default(true); // 1 para activo, 0 para inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predio');
    }
};
