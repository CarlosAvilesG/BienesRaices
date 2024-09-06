<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorteCajaDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('corte_caja_detalles')->insert([
            [
                'idCorteCaja' => 1,
                'idPagoLote' => 1,
                'idEgreso' => null,
                'monto' => 25000.00,
                'tipoMovimiento' => 'ingreso_fisico',
            ],
            [
                'idCorteCaja' => 1,
                'idPagoLote' => null,
                'idEgreso' => 1,
                'monto' => 15000.00,
                'tipoMovimiento' => 'egreso',
            ],
            [
                'idCorteCaja' => 2,
                'idPagoLote' => 2,
                'idEgreso' => null,
                'monto' => 30000.00,
                'tipoMovimiento' => 'ingreso_bancario',
            ],
            [
                'idCorteCaja' => 2,
                'idPagoLote' => null,
                'idEgreso' => 2,
                'monto' => 45000.00,
                'tipoMovimiento' => 'egreso',
            ],
        ]);
    }
}
