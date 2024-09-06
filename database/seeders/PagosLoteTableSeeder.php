<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagosLoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pago_lotes')->insert([
            [
                'idPredio' => 1,
                'idLote' => 1,
                'idCliente' => 1,
                'tipoPago' => 'Efectivo',
                'monto' => 25000.00,
                'fechaPago' => '2024-04-01',
                'horaPago' => '10:00:00',
                'idUsuario' => 1,
            ],
            [
                'idPredio' => 2,
                'idLote' => 5,
                'idCliente' => 2,
                'tipoPago' => 'Transferencia',
                'monto' => 30000.00,
                'fechaPago' => '2024-05-01',
                'horaPago' => '11:00:00',
                'idUsuario' => 2,
            ],
        ]);
    }
}
