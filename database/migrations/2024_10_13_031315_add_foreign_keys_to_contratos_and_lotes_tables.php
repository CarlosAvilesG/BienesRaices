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
        // Agregar la clave foránea de 'idLote' en la tabla 'contratos'
        Schema::table('contratos', function (Blueprint $table) {
            $table->foreign('idLote')->references('id')->on('lotes')->onDelete('cascade');
        });

        // Agregar la clave foránea de 'idContrato' en la tabla 'lotes'
        // Schema::table('lotes', function (Blueprint $table) {
        //     $table->foreign('idContrato')->references('id')->on('contratos')->onDelete('set null');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contratos_and_lotes_tables', function (Blueprint $table) {
            //// Eliminar las claves foráneas si se hace rollback
            Schema::table('contratos', function (Blueprint $table) {
                $table->dropForeign(['idLote']);
            });

            Schema::table('lotes', function (Blueprint $table) {
                $table->dropForeign(['idContrato']);
            });
        });
    }
};
