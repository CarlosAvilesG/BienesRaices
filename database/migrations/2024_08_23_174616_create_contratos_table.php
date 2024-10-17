<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            //$table->id('idContrato'); // Clave primaria del contrato
            $table->id();
            $table->string('identificadorContrato', 50)->unique(); // Identificador único del contrato
            $table->unsignedBigInteger('idCliente'); // Referencia al cliente
            $table->unsignedBigInteger('idLote'); // Referencia al lote

            // Información del contrato
            $table->string('NoContrato', 50);
            $table->string('NoConvenio', 10)->nullable();
            // campo para numero de amios
            $table->integer('NoAnios')->nullable();
            $table->integer('NoLetras')->nullable(); // Número de pagos (letras)

            // Detalles financieros
            $table->decimal('PrecioPredio', 18, 2);
            $table->decimal('InteresMoroso', 3, 1)->nullable();

            // Fechas importantes
            $table->date('FechaCelebracion');
            $table->string('HoraCelebracion', 8); // Formato estándar HH:MM:SS
            $table->date('FechaTerminoLetras')->nullable();

            // Convenios y modalidades de pago
            //$table->string('ConvenioTemporalidadPago', 50)->nullable();
            $table->enum('ConvenioTemporalidadPago', ['Quincenal', 'Mensual'])->default('Mensual');
           // $table->string('ConvenioViaPago', 50)->nullable();
            $table->enum('ConvenioViaPago', ['Efectivo', 'Bancario', 'Nomina'])->default('Efectivo');
            // columnas para establecer pago de anualidades en caso de ser necesario
            $table->integer('Anualidades')->default(0);
            $table->decimal('PagoAnualidad', 18, 2)->nullable();
             // agrega campo para ingresar el enganche
             $table->decimal('Enganche', 18, 2)->nullable();


            // Información de registro y auditoría
            //
            $table->date('FechaRegistro')->default(DB::raw('CURRENT_DATE'));
            $table->string('HoraRegistro', 8)->default(DB::raw('CURRENT_TIME'));
            $table->unsignedBigInteger('idUsuario')->nullable(); // Usuario que registra el contrato

            // Estado del contrato
            $table->text('observacion')->nullable();
          //  $table->boolean('cancelado')->default(false); //ya esta conciderado en el estatus
            $table->unsignedBigInteger('idUsuCancela')->nullable();
            $table->text('CanceladoObservacion')->nullable();



            // Timestamps para created_at y updated_at
            $table->timestamps();
            // SoftDeletes para eliminación lógica
            $table->softDeletes();

            // Claves foráneas para mantener la integridad referencial
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade');
            // se paso para una migracion posterior
            //$table->foreign('idLote')->references('id')->on('lotes')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idUsuCancela')->references('id')->on('users');

            $table->enum('estatus', ['Activo', 'Cancelado', 'Finiquitado'])->default('Activo');

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
        Schema::dropIfExists('contratos');
    }
};
