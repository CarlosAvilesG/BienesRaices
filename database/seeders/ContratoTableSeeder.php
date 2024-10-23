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
                'anualidades' => 0,
                'pagoAnualidad' => 0,
                'convenioTemporalidadPago' => 'Mensual',
                'convenioViaPago' => 'Bancario',
                'fechaCelebracion' => '2024-01-10',
                'fechaRegistro' => '2024-01-10',
                'fechaTerminoLetras' => '2025-01-10',
                'horaCelebracion' => '10:30:00',
                'horaRegistro' => '10:35:00',
                'interesMoroso' => 3.5,
                'noContrato' => 'CNT-001',
                'noConvenio' => 'CV-001',
                'noLetras' => 12,
                'noAnios' => 4,
                'precioPredio' => 150000,
                'enganche' => 50000,


                'idCliente' => 1,
                'idLote' => 1,
                'idUsuario' => 1,
                'identificadorContrato' => 'CNT-001',
                'observacion' => 'Contrato inicial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'anualidades' => 2,
                'pagoAnualidad' => 100000,
                'convenioTemporalidadPago' => 'Quincenal',
                'convenioViaPago' => 'Nomina',
                'fechaCelebracion' => '2024-02-01',
                'fechaRegistro' => '2024-02-01',
                'fechaTerminoLetras' => '2026-02-01',
                'horaCelebracion' => '11:00:00',
                'horaRegistro' => '11:05:00',
                'interesMoroso' => 4,
                'noContrato' => 'CNT-002',
                'noConvenio' => 'CV-002',
                'noLetras' => 24,
                'noAnios' => 5,
                'precioPredio' => 200000,
                'enganche' => 50000,

                'idCliente' => 2,
                'idLote' => 2,
                'idUsuario' => 2,
                'identificadorContrato' => 'CNT-002',
                'observacion' => 'Contrato con plazos extendidos.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'anualidades' => 1,
                'pagoAnualidad' => 10000,
                'convenioTemporalidadPago' => 'Mensual',
                'convenioViaPago' => 'Efectivo',
                'fechaCelebracion' => '2024-03-15',
                'fechaRegistro' => '2024-03-15',
                'fechaTerminoLetras' => '2027-03-15',
                'horaCelebracion' => '12:00:00',
                'horaRegistro' => '12:05:00',
                'interesMoroso' => 4.5,
                'noContrato' => 'CNT-003',
                'noConvenio' => 'CV-003',
                'noLetras' => 36,
                'noAnios' => 3,
                'precioPredio' => 250000,
                'enganche' => 50000,

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
