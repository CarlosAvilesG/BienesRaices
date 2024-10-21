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
            $table->string('noContrato', 50);
            $table->string('noConvenio', 10)->nullable();
            // campo para numero de amios
            $table->integer('noAnios')->nullable();
            $table->integer('noLetras')->nullable(); // Número de pagos (letras)

            // Detalles financieros
            $table->decimal('precioPredio', 18, 2);
            $table->decimal('interesMoroso', 3, 1)->nullable();

            // Fechas importantes
            $table->date('fechaCelebracion');
            $table->string('horaCelebracion', 8); // Formato estándar HH:MM:SS
            $table->date('fechaTerminoLetras')->nullable();

            // Convenios y modalidades de pago
            //$table->string('ConvenioTemporalidadPago', 50)->nullable();
            $table->enum('convenioTemporalidadPago', ['Quincenal', 'Mensual'])->default('Mensual');
           // $table->string('ConvenioViaPago', 50)->nullable();
            $table->enum('convenioViaPago', ['Efectivo', 'Bancario', 'Nomina'])->default('Efectivo');
            // columnas para establecer pago de anualidades en caso de ser necesario
            $table->integer('anualidades')->default(0);
            $table->decimal('pagoAnualidad', 18, 2)->nullable();
             // agrega campo para ingresar el enganche
             $table->decimal('enganche', 18, 2)->nullable();


            // Información de registro y auditoría
            //
            $table->date('fechaRegistro')->default(DB::raw('CURRENT_DATE'));
            $table->string('horaRegistro', 8)->default(DB::raw('CURRENT_TIME'));
            $table->unsignedBigInteger('idUsuario')->nullable(); // Usuario que registra el contrato

            // Estado del contrato
            $table->text('observacion')->nullable();
          //  $table->boolean('cancelado')->default(false); //ya esta conciderado en el estatus
            $table->unsignedBigInteger('idUsuCancela')->nullable();
            $table->text('canceladoObservacion')->nullable();



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
            $table->index('noContrato');
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
