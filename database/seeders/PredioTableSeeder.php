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
                'estadoRepublica' => 'Estado X',
                'municipio' => 'Municipio Y',
                'localidad' => 'Localidad Z',
                'hectarias' => 5,
                'numeroManzanas' => 10,
                'numeroLotes' => 100,
                'fechaInauguracion' => '2024-02-01',
                'activo' => 1,
            ],
            [
                'nombre' => 'Predio Los Pinos',
                'descripcion' => 'Predio residencial con múltiples servicios.',
                'estadoRepublica' => 'Estado A',
                'municipio' => 'Municipio B',
                'localidad' => 'Localidad C',
                'hectarias' => 8,
                'numeroManzanas' => 15,
                'numeroLotes' => 150,
                'fechaInauguracion' => '2024-03-01',
                'activo' => 1,
            ],
        ]);
    }
}
