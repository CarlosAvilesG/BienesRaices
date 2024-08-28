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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('idCliente');
            $table->string('paterno', 30);
            $table->string('materno', 30);
            $table->string('nombre', 30);
            $table->string('curp', 30)->index();
            $table->string('rfc', 30)->index();
            $table->string('ine', 90)->index();
            $table->string('direccion', 300)->nullable();            $table->string('direccionEntreCalle', 50)->nullable();
            $table->integer('codigoPostal')->nullable();
            $table->string('colonia', 50)->nullable();
            $table->char('numeroExterior', 10)->nullable();
            $table->string('telefonoCasa', 30)->nullable();
            $table->string('celular', 30);
            $table->string('trabajo', 100)->nullable();
            $table->string('trabajoDireccion', 300)->nullable();
            $table->string('trabajoTelefono', 30)->nullable();
            $table->string('estadoRepublica', 30)->nullable();
            $table->string('municipio', 45)->nullable();
            $table->string('localidad', 45)->nullable();
            $table->string('correoElectronico', 45)->unique();
            $table->string('pass', 60); // Contraseña hasheada
            $table->string('usuarioWeb', 45)->nullable();
            $table->string('foto_url')->nullable()->nullable();
            $table->date('fechaRegistro');

            $table->boolean('morosidad_activa')->default(false); // Indica si el cliente tiene una morosidad activa
            $table->decimal('monto_deuda_actual', 20, 2)->default(0); // Monto total de la deuda actual
            $table->timestamp('ultima_actualizacion_morosidad')->nullable(); // Última fecha en que se actualizó la morosidad

            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // Eliminación lógica
        });

        Schema::create('morosos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCliente'); // Relación con la tabla clientes
            $table->decimal('montoDeuda', 20, 2); // Monto de la deuda en el momento en que se identifica la morosidad
            $table->boolean('activo')->default(true); // Indica si la morosidad está activa
            $table->timestamp('fecha_inicio'); // Fecha en que se identificó la morosidad
            $table->timestamp('fecha_resolucion')->nullable(); // Fecha en que se resolvió la morosidad
            $table->timestamps();

            $table->foreign('idCliente')->references('idCliente')->on('clientes')->onDelete('cascade');
            $table->index('idCliente');
            $table->index('activo');
        });

        Schema::create('morosos_seguimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMoroso'); // Relación con la tabla morosos
            $table->timestamp('fecha_contacto'); // Fecha y hora del contacto
            $table->string('medio_contacto', 50); // Medio de contacto (e.g., Correo, Teléfono, Visita)
            $table->text('detalle_contacto')->nullable(); // Detalles del contacto
            $table->text('acuerdo')->nullable(); // Descripción del acuerdo alcanzado (si lo hay)
            $table->unsignedBigInteger('idUsuario'); // Usuario que realizó el seguimiento
            $table->timestamps();

            $table->foreign('idMoroso')->references('id')->on('morosos')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('users');
            $table->index('idMoroso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('morosos');
        Schema::dropIfExists('morosos_seguimiento');
    }
};
