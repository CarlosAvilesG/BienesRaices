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
        Schema::create('corte_caja', function (Blueprint $table) {
        $table->id('idCorteCaja');
        $table->date('fechaInicio'); // Fecha de inicio del periodo del corte
        $table->date('fechaFin'); // Fecha de fin del periodo del corte
        $table->decimal('totalIngresosFisicos', 20, 2)->default(0); // Total de ingresos en efectivo
        $table->decimal('totalIngresosBancarios', 20, 2)->default(0); // Total de ingresos bancarios
        $table->decimal('totalEgresos', 20, 2)->default(0); // Total de egresos
        $table->decimal('totalPrestamos', 20, 2)->default(0); // Total de préstamos (egresos que requieren devolución)
        $table->unsignedBigInteger('idUsuario'); // Usuario que realiza el corte
        $table->timestamps();

        $table->foreign('idUsuario')->references('id')->on('users');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte_caja');
    }
};
