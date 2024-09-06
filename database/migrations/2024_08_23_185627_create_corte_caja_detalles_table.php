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
        Schema::create('corte_caja_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCorteCaja');
            $table->unsignedBigInteger('idPagoLote')->nullable();
            $table->unsignedBigInteger('idEgreso')->nullable();
            $table->decimal('monto', 15, 2);
            $table->string('tipoMovimiento', 20);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('idCorteCaja')
                ->references('id')
                ->on('corte_cajas')
                ->onDelete('cascade');

            $table->foreign('idPagoLote')
                ->references('id')
                ->on('pago_lotes')
                ->onDelete('cascade');

            $table->foreign('idEgreso')
                ->references('id')
                ->on('egresos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte_caja_detalles');
    }
};
