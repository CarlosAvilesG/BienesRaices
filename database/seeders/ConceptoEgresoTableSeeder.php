<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConceptoEgresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('concepto_egresos')->insert([
            [
                'descripcion' => 'NOMINA',
                'gastoCorriente' => true,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'SERVICIOS',
                'gastoCorriente' => true,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'GASOLINA',
                'gastoCorriente' => false,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'MANTENIMIENTO',
                'gastoCorriente' => false,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'PAPELERIA',
                'gastoCorriente' => false,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'HERRAMIENTA',
                'gastoCorriente' => false,
                'requiereDevolucion' => false,
            ],
            [
                'descripcion' => 'MATERIAL DE CONSTRUCCIÓN',
                'gastoCorriente' => false,
                'requiereDevolucion' => false,
            ],
        ]);
    }
}
