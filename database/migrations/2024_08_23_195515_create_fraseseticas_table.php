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
        Schema::create('fraseseticas', function (Blueprint $table) {
            $table->id('idFrase'); // Clave primaria de la frase
            $table->text('frase'); // Contenido de la frase
            $table->string('autor', 100)->nullable(); // Autor de la frase
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fraseseticas');
    }
};
