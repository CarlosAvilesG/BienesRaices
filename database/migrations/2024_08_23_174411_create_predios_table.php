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
        Schema::create('predios', function (Blueprint $table) {
            //$table->id('idPredio');
            $table->id();
            $table->string('nombre', 30);
            $table->string('descripcion', 100);

            $table->string('codigoPostal', 10);
            $table->string('claveCatastral', 30);
            $table->string('notaria', 30);
            $table->string('numeroEscritura', 30);
            $table->string('folioEscritura', 30);
            $table->string('volumenEscritura', 30);
            $table->string('fechaEscritura', 30);
            $table->string('coordenadasNorte', 30);
            $table->string('coordenadasSur', 30);
            $table->string('coordenadasEste', 30);
            $table->string('coordenadasOeste', 30);
            // Campos adicionales para almacenar coordenadas google maps
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();

            $table->string('estadoRepublica', 30);
            $table->string('municipio', 30);
            $table->string('localidad', 30);
            $table->integer('hectareas');
            $table->integer('numeroManzanas');
            $table->integer('numeroLotes');
            $table->date('fechaInauguracion');
            $table->boolean('activo')->default(true); // 1 para activo, 0 para inactivo
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predios');
    }
};
