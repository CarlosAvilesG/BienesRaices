<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorteCajaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('corte_caja')->insert([
            [
                'fechaInicio' => '2024-04-01',
                'fechaFin' => '2024-04-30',
                'totalIngresosFisicos' => 50000.00,
                'totalIngresosBancarios' => 70000.00,
                'totalEgresos' => 40000.00,
                'totalPrestamos' => 10000.00,
                'idUsuario' => 1,
            ],
            [
                'fechaInicio' => '2024-05-01',
                'fechaFin' => '2024-05-31',
                'totalIngresosFisicos' => 55000.00,
                'totalIngresosBancarios' => 65000.00,
                'totalEgresos' => 45000.00,
                'totalPrestamos' => 12000.00,
                'idUsuario' => 2,
            ],
        ]);
    }
}
