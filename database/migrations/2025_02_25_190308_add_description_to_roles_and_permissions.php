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
         // Agregar columna "description" a la tabla "roles"
         Schema::table('roles', function (Blueprint $table) {
            $table->string('description')->nullable()->after('name');
        });

        // Agregar columna "description" a la tabla "permissions"
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('description')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Eliminar columna "description"
         Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('description');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
