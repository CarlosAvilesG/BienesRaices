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
        Schema::create('concepto_egreso', function (Blueprint $table) {
            $table->id('idConcepto'); // Clave primaria del concepto de egreso
            $table->string('descripcion', 50); // Descripción del concepto
            $table->boolean('gastoCorriente')->default(false); // Indicador de si es un gasto corriente
            $table->boolean('requiereDevolucion')->default(false); // Indicador de si el concepto implica devolución (préstamo)
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Índice para optimización de consultas
            $table->index('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concepto_egreso');
    }
};
