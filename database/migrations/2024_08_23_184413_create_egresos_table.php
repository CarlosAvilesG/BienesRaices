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
        Schema::create('egresos', function (Blueprint $table) {
            //$table->id('idEgresos'); // Clave primaria del egreso
            $table->id();

            // Relación con el catálogo de conceptos de egreso
            $table->unsignedBigInteger('idConcepto');

            // Detalles del egreso
            $table->string('descripcion', 300)->nullable(); // Descripción del egreso
            $table->decimal('monto', 20, 2); // Monto del egreso

            // Información del usuario que recibe el dinero
            $table->unsignedBigInteger('idUsuarioRecibe');

            // Fecha y hora del egreso
            $table->date('fecha');
            $table->time('hora');

            // Información del usuario que realiza el registro del egreso
            $table->unsignedBigInteger('idUsuario');

            // Supervisión y cancelación
            $table->boolean('supervisado')->default(false);
            $table->unsignedBigInteger('idUsuSupervisa')->nullable(); // Usuario que supervisa el egreso
            $table->boolean('cancelado')->default(false);
            $table->unsignedBigInteger('idUsuCancela')->nullable(); // Usuario que cancela el egreso

            // Control de devolución (para conceptos que lo requieran)
            $table->boolean('pendienteDevolucion')->default(false); // Indica si está pendiente de devolución
            $table->decimal('montoDevuelto', 20, 2)->nullable(); // Monto devuelto (si aplica)
            $table->date('fechaDevolucion')->nullable(); // Fecha de la devolución (si aplica)
            $table->unsignedBigInteger('idUsuarioDevuelve')->nullable(); // Usuario que realiza la devolución

            // Timestamps para created_at y updated_at
            $table->timestamps();

            // Claves foráneas para mantener la integridad referencial
            $table->foreign('idConcepto')->references('id')->on('concepto_egresos')->onDelete('cascade');
            $table->foreign('idUsuarioRecibe')->references('id')->on('users');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idUsuSupervisa')->references('id')->on('users');
            $table->foreign('idUsuCancela')->references('id')->on('users');
            $table->foreign('idUsuarioDevuelve')->references('id')->on('users');

            // Índices para optimización de consultas
            $table->index('idConcepto');
            $table->index('idUsuario');
            $table->index('idUsuarioRecibe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresos');
    }
};
