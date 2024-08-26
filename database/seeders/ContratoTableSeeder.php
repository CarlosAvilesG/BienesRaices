<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contrato')->insert([
            [
                'idCliente' => 1,
                'idLote' => 1,
                'NoContrato' => 'CNT-001',
                'NoConvenio' => 'CV-001',
                'NoLetras' => 12,
                'PrecioPredio' => 150000.00,
                'InteresMoroso' => 3.5,
                'FechaCelebracion' => '2024-01-10',
                'HoraCelebracion' => '10:30:00',
                'FechaTerminoLetras' => '2025-01-10',
                'ConvenioTemporalidadPago' => 'Mensual',
                'ConvenioViaPago' => 'Transferencia',
                'FechaRegistro' => '2024-01-10',
                'HoraRegistro' => '10:35:00',
                'idUsuario' => 1,
                'observacion' => 'Contrato inicial.',
                'cancelado' => false,
            ],
            [
                'idCliente' => 2,
                'idLote' => 2,
                'NoContrato' => 'CNT-002',
                'NoConvenio' => 'CV-002',
                'NoLetras' => 24,
                'PrecioPredio' => 200000.00,
                'InteresMoroso' => 4.0,
                'FechaCelebracion' => '2024-02-01',
                'HoraCelebracion' => '11:00:00',
                'FechaTerminoLetras' => '2026-02-01',
                'ConvenioTemporalidadPago' => 'Bimestral',
                'ConvenioViaPago' => 'Efectivo',
                'FechaRegistro' => '2024-02-01',
                'HoraRegistro' => '11:05:00',
                'idUsuario' => 2,
                'observacion' => 'Contrato con plazos extendidos.',
                'cancelado' => false,
            ],
        ]);
    }
}
