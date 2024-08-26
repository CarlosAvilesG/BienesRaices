<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'paterno' => 'Gómez',
                'materno' => 'Hernández',
                'nombre' => 'Pedro',
                'rfc' => 'GOHP830912123',
                'curp' => 'GHPD830912HMCRRL02',
                'ine' => '1234567890123',
                'celular' => '5555555555',
                'direccion' => 'Calle A, Colonia B, Ciudad, Estado',
                'correoElectronico' => 'pedro.gomez@example.com',
                'pass' => bcrypt('password'),
                'usuarioWeb' => 'pedrogomez',
                'fechaRegistro' => '2024-01-01',
                'idUsuario' => 1,
            ],
            [
                'paterno' => 'López',
                'materno' => 'Martínez',
                'nombre' => 'Ana',
                'rfc' => 'LAMJ850630123',
                'curp' => 'LAMJ850630MDFRRN08',
                'ine' => '9876543210987',
                'celular' => '6666666666',
                'direccion' => 'Avenida Z, Colonia Y, Ciudad, Estado',
                'correoElectronico' => 'ana.lopez@example.com',
                'pass' => bcrypt('password'),
                'usuarioWeb' => 'analopez',
                'fechaRegistro' => '2024-01-02',
                'idUsuario' => 2,
            ],
        ]);
    }
}
