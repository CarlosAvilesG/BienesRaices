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
        Schema::create('pagos_lote', function (Blueprint $table) {
            //$table->id('refPagoInt');
            $table->id();
            $table->unsignedBigInteger('idPredio');
            $table->unsignedBigInteger('idLote');
            $table->unsignedBigInteger('folio')->nullable();
            $table->unsignedBigInteger('idContrato')->nullable();
            $table->unsignedBigInteger('idCliente');
            $table->string('tipoPago', 50);
            $table->string('referenciaBancaria', 100)->nullable();
            $table->decimal('monto', 28, 2);
            $table->integer('pagoNumero')->nullable();
            $table->decimal('deudaAnterior', 28, 2)->nullable();
            $table->date('fechaPago');
            $table->string('horaPago', 8); // Ajustado a un formato estándar de hora
            $table->unsignedBigInteger('idUsuario');
            $table->text('observacion')->nullable();
            $table->boolean('cancelar')->default(false);
            $table->unsignedBigInteger('idUsuarioCancela')->nullable();
            $table->boolean('pagoValidado')->default(false);
            $table->unsignedBigInteger('idUsuarioValidaPago')->nullable();
            $table->boolean('historico')->default(false);
            $table->timestamps();

            // Claves foráneas para mantener la integridad referencial
            $table->foreign('idPredio')->references('idPredio')->on('predio')->onDelete('cascade');
            $table->foreign('idLote')->references('idLote')->on('lotes')->onDelete('cascade');
            $table->foreign('idCliente')->references('idCliente')->on('clientes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idUsuarioCancela')->references('id')->on('users');
            $table->foreign('idUsuarioValidaPago')->references('id')->on('users');

            // Índices para optimización de consultas
            $table->index('idPredio');
            $table->index('idLote');
            $table->index('idCliente');
            $table->index('idUsuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_lote');
    }
};
