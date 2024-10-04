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
        Schema::create('lotes', function (Blueprint $table) {
           // $table->id('idLote');
            $table->id();
            $table->unsignedBigInteger('idPredio');
            $table->unsignedBigInteger('idcontrato')->nullable();
            $table->integer('manzana');
            $table->integer('lote');
            $table->string('descripcion', 50)->nullable();
            $table->boolean('regular');
            $table->boolean('donacion');
            $table->boolean('loteComercial');
            $table->string('loteReparable', 5)->nullable();
            $table->string('loteReparableObs', 300)->nullable();
            $table->boolean('inhabilitado');
            $table->decimal('metrosFrente', 10, 2);
            $table->decimal('metrosAtras', 10, 2);
            $table->decimal('metrosDerecho', 10, 2);
            $table->decimal('metrosIzquierda', 10, 2);
            $table->decimal('metrosCuadrados', 10, 2);
            $table->decimal('precio', 15, 2);
            $table->integer('plazoMeses')->nullable();
            $table->decimal('pagoMensual', 15, 2)->nullable();
            $table->enum('estatusPago', ['pendiente', 'pagado', 'atrasado'])->default('pendiente');

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('idPredio')
                  ->references('id')
                  ->on('predios')
                  ->onDelete('cascade');

            // $table->foreign('idcontrato')
            //       ->references('id')
            //       ->on('contrato')
            //       ->nullable();


            // Índices para optimización de consultas
            $table->index('manzana');
            $table->index('lote');
            $table->index('idPredio');
            $table->index('idcontrato');
        });

        Schema::create('lote_fotos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idLote');
            $table->string('foto_url'); // Ruta relativa de la foto
            $table->foreign('idLote')->references('id')->on('lotes')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
        Schema::dropIfExists('lote_fotos');
    }
};
