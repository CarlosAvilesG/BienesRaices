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
        Schema::create('cliente_referencia', function (Blueprint $table) {
            $table->id('idReferencia');
            $table->unsignedBigInteger('idCliente');
            $table->string('paterno', 30);
            $table->string('materno', 30);
            $table->string('nombre', 30);
            $table->string('telefono', 30);
            $table->string('trabajo', 50);
            $table->string('trabajoDireccion', 100);
            $table->string('trabajoTelefono', 30);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('idCliente')
                  ->references('idCliente')
                  ->on('clientes')
                  ->onDelete('cascade'); // Elimina las referencias si el cliente es eliminado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_referencia');
    }
};
