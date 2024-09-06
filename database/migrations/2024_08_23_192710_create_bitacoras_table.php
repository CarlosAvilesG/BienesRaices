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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha')->useCurrent(); // Fecha y hora del evento
            $table->unsignedBigInteger('usuario'); // ID del usuario que realizó la acción
            $table->string('tabla', 50); // Tabla afectada
            $table->string('tipoOperacion', 20); // Tipo de operación (INSERT, UPDATE, DELETE, etc.)
            $table->string('campoLlave', 50); // Clave primaria del registro afectado
            $table->string('descripcion')->nullable(); // Descripción detallada del evento
            $table->string('ip', 45)->nullable(); // IP desde donde se realizó la acción
            $table->string('user_agent')->nullable(); // Información del navegador y sistema operativo
            $table->timestamps();

            // Índices
            $table->index('fecha');
            $table->index('usuario');
            $table->index('tabla');
            $table->index('campoLlave');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
