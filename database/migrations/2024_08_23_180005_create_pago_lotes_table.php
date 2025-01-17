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
        Schema::create('pago_lotes', function (Blueprint $table) {
            //$table->id('refPagoInt');
            $table->id();
            $table->unsignedBigInteger('folio')->nullable(); // consecutivo externo
            $table->unsignedBigInteger('idPredio');     // Referencia al predio
            $table->unsignedBigInteger('idLote'); // Referencia al lote
            $table->unsignedBigInteger('idContrato')->nullable(); // Referencia al contrato, se aqui se obtiene el idCliente activo en el contrato
            $table->unsignedBigInteger('idCliente'); // Referencia al cliente no necesariamente activo en el contrato (bitácora de pagos)
            $table->enum('motivo', ['Enganche', 'Mensualidad', 'Anualidad']);
            $table->enum('tipoPago',['Efectivo', 'Cheque', 'Transferencia']);
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
            $table->foreign('idPredio')->references('id')->on('predios')->onDelete('cascade');
            $table->foreign('idLote')->references('id')->on('lotes')->onDelete('cascade');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users'); // Usuario que registra el pago
            $table->foreign('idUsuarioCancela')->references('id')->on('users'); // Usuario que cancela el pago
            $table->foreign('idUsuarioValidaPago')->references('id')->on('users');  // Usuario que valida el pago

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
        Schema::dropIfExists('pago_lotes');
    }
};
