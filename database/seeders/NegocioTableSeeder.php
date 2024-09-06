<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NegocioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('negocios')->insert([
            [
                'razonSocial' => 'Negocio Ejemplo S.A. de C.V.',
                'telefono1' => '555-1234',
                'telefono2' => '555-5678',
                'direccion' => 'Calle Falsa 123, Ciudad, País',
                'propietario' => 'Juan Pérez',
            ],

        ]);
    }
}
