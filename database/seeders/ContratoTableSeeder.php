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

        $contratos = [
            [
                'ConvenioTemporalidadPago' => 'Mensual',
                'ConvenioViaPago' => 'Transferencia',
                'FechaCelebracion' => '2024-01-10',
                'FechaRegistro' => '2024-01-10',
                'FechaTerminoLetras' => '2025-01-10',
                'HoraCelebracion' => '10:30:00',
                'HoraRegistro' => '10:35:00',
                'InteresMoroso' => 3.5,
                'NoContrato' => 'CNT-001',
                'NoConvenio' => 'CV-001',
                'NoLetras' => 12,
                'PrecioPredio' => 150000,
                'cancelado' => 0,
                'idCliente' => 1,
                'idLote' => 1,
                'idUsuario' => 1,
                'identificadorContrato' => 'CNT-001',
                'observacion' => 'Contrato inicial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ConvenioTemporalidadPago' => 'Bimestral',
                'ConvenioViaPago' => 'Efectivo',
                'FechaCelebracion' => '2024-02-01',
                'FechaRegistro' => '2024-02-01',
                'FechaTerminoLetras' => '2026-02-01',
                'HoraCelebracion' => '11:00:00',
                'HoraRegistro' => '11:05:00',
                'InteresMoroso' => 4,
                'NoContrato' => 'CNT-002',
                'NoConvenio' => 'CV-002',
                'NoLetras' => 24,
                'PrecioPredio' => 200000,
                'cancelado' => 0,
                'idCliente' => 2,
                'idLote' => 2,
                'idUsuario' => 2,
                'identificadorContrato' => 'CNT-002',
                'observacion' => 'Contrato con plazos extendidos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ConvenioTemporalidadPago' => 'Trimestral',
                'ConvenioViaPago' => 'Cheque',
                'FechaCelebracion' => '2024-03-15',
                'FechaRegistro' => '2024-03-15',
                'FechaTerminoLetras' => '2027-03-15',
                'HoraCelebracion' => '12:00:00',
                'HoraRegistro' => '12:05:00',
                'InteresMoroso' => 4.5,
                'NoContrato' => 'CNT-003',
                'NoConvenio' => 'CV-003',
                'NoLetras' => 36,
                'PrecioPredio' => 250000,
                'cancelado' => 0,
                'idCliente' => 3,
                'idLote' => 3,
                'idUsuario' => 3,
                'identificadorContrato' => 'CNT-003',
                'observacion' => 'Contrato con plazos extendidos y pago con cheque.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('contratos')->insert($contratos);
    }
}
