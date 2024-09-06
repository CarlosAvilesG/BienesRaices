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
        Schema::create('negocios', function (Blueprint $table) {
            //$table->id('idNegocio'); // Clave primaria
            $table->id();
            // Información del negocio
            $table->string('razonSocial', 100); // Razón social del negocio
            $table->string('telefono1', 50)->nullable(); // Primer teléfono de contacto
            $table->string('telefono2', 50)->nullable(); // Segundo teléfono de contacto (opcional)
            $table->string('direccion', 255)->nullable(); // Dirección del negocio
            $table->string('propietario', 50); // Nombre del propietario

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
