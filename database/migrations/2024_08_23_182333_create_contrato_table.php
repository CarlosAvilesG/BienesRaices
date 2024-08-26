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
        Schema::create('contrato', function (Blueprint $table) {
            $table->id('idContrato'); // Clave primaria del contrato
            $table->unsignedBigInteger('idCliente'); // Referencia al cliente
            $table->unsignedBigInteger('idLote'); // Referencia al lote

            // Información del contrato
            $table->string('NoContrato', 50);
            $table->string('NoConvenio', 10)->nullable();
            $table->integer('NoLetras')->nullable(); // Número de pagos (letras)

            // Detalles financieros
            $table->decimal('PrecioPredio', 18, 2);
            $table->decimal('InteresMoroso', 3, 1)->nullable();

            // Fechas importantes
            $table->date('FechaCelebracion');
            $table->string('HoraCelebracion', 8); // Formato estándar HH:MM:SS
            $table->date('FechaTerminoLetras')->nullable();

            // Convenios y modalidades de pago
            $table->string('ConvenioTemporalidadPago', 50)->nullable();
            $table->string('ConvenioViaPago', 50)->nullable();

            // Información de registro y auditoría
            $table->date('FechaRegistro');
            $table->string('HoraRegistro', 8);
            $table->unsignedBigInteger('idUsuario'); // Usuario que registra el contrato

            // Estado del contrato
            $table->text('observacion')->nullable();
            $table->boolean('cancelado')->default(false);
            $table->unsignedBigInteger('idUsuCancela')->nullable();
            $table->text('CanceladoObservacion')->nullable();

            // Timestamps para created_at y updated_at
            $table->timestamps();

            // Claves foráneas para mantener la integridad referencial
            $table->foreign('idCliente')->references('idCliente')->on('clientes')->onDelete('cascade');
            $table->foreign('idLote')->references('idLote')->on('lotes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idUsuCancela')->references('id')->on('users');

            // Índices para optimización de consultas
            $table->index('NoContrato');
            $table->index('idCliente');
            $table->index('idLote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato');
    }
};
