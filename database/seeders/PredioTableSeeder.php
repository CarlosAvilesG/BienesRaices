<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('predios')->insert([
            [
                'nombre' => 'Predio Las Flores',
                'descripcion' => 'Predio amplio ubicado en zona céntrica.',

                'codigoPostal' => '12345',
                'claveCatastral' => 'CC-001',
                'notaria' => 'Notaría 1',
                'numeroEscritura' => 'E-001',
                'folioEscritura' => 'F-001',
                'volumenEscritura' => 'V-001',
                'fechaEscritura' => '2024-01-01',
                'coordenadasNorte' => 'N-001',
                'coordenadasSur' => 'S-001',
                'coordenadasEste' => 'E-001',
                'coordenadasOeste' => 'O-001',

                'estadoRepublica' => 'Estado X',
                'municipio' => 'Municipio Y',
                'localidad' => 'Localidad Z',
                'hectareas' => 5,
                'numeroManzanas' => 10,
                'numeroLotes' => 100,
                'fechaInauguracion' => '2024-02-01',
                'activo' => 1,
            ],
            [
                'nombre' => 'Predio Los Pinos',
                'descripcion' => 'Predio residencial con múltiples servicios.',

                'codigoPostal' => '54321',
                'claveCatastral' => 'CC-002',
                'notaria' => 'Notaría 2',
                'numeroEscritura' => 'E-002',
                'folioEscritura' => 'F-002',
                'volumenEscritura' => 'V-002',
                'fechaEscritura' => '2024-02-01',
                'coordenadasNorte' => 'N-002',
                'coordenadasSur' => 'S-002',
                'coordenadasEste' => 'E-002',
                'coordenadasOeste' => 'O-002',

                'estadoRepublica' => 'Estado A',
                'municipio' => 'Municipio B',
                'localidad' => 'Localidad C',
                'hectareas' => 8,
                'numeroManzanas' => 15,
                'numeroLotes' => 150,
                'fechaInauguracion' => '2024-03-01',
                'activo' => 1,
            ],
        ]);
    }
}
