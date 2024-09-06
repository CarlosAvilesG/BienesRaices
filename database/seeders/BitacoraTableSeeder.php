<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BitacoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bitacoras')->insert([
            [
                'fecha' => '2024-04-01 10:00:00',
                'usuario' => 1,
                'tabla' => 'pagos_lote',
                'tipoOperacion' => 'INSERTAR',
                'campoLlave' => 1,
                'descripcion' => 'Nuevo pago registrado',
                'ip' => '192.168.1.1',
            ],
            [
                'fecha' => '2024-04-02 11:30:00',
                'usuario' => 2,
                'tabla' => 'contrato',
                'tipoOperacion' => 'ACTUALIZAR',
                'campoLlave' => 1,
                'descripcion' => 'Contrato actualizado',
                'ip' => '192.168.1.2',
            ],
        ]);
    }
}
