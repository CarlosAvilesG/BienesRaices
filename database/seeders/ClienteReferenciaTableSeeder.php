<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteReferenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cliente_referencias')->insert([
            [
                'idCliente' => 1,
                'paterno' => 'Ramírez',
                'materno' => 'Díaz',
                'nombre' => 'Luis',
                'telefono' => '555-1234',
                'trabajo' => 'Empresa ABC',
                'trabajoDireccion' => 'Calle Trabajo 123, Ciudad',
                'trabajoTelefono' => '555-4321',
            ],
            [
                'idCliente' => 2,
                'paterno' => 'Fernández',
                'materno' => 'Sánchez',
                'nombre' => 'María',
                'telefono' => '555-8765',
                'trabajo' => 'Empresa XYZ',
                'trabajoDireccion' => 'Avenida Trabajo 742, Ciudad',
                'trabajoTelefono' => '555-5678',
            ],
        ]);
    }
}
