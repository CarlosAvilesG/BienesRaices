<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PagosLoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pagos = [];

        for ($i = 1; $i <= 10; $i++) {
            $pagos[] = [
                'idPredio' => rand(1, 2), // Asegúrate de que hay al menos 10 predios
                'idLote' => rand(1, 3), // Asegúrate de que hay al menos 3 lotes
                'idCliente' => rand(1, 2), // Asegúrate de que hay al menos 10 clientes
                'idContrato' => rand(1, 3),
                'tipoPago' => ['Efectivo', 'Cheque', 'Transferencia'][rand(0, 2)],
                'referenciaBancaria' => Str::random(10),
                'monto' => rand(1000, 10000) + rand(0, 99) / 100,
                'pagoNumero' => rand(1, 36),
                'deudaAnterior' => rand(0, 5000) + rand(0, 99) / 100,
                'fechaPago' => now()->subDays(rand(0, 365))->format('Y-m-d'),
                'horaPago' => now()->format('H:i:s'),
                'idUsuario' => rand(1, 1), // Asegúrate de que hay al menos 5 usuarios
                'observacion' => Str::random(50),
                //'cancelar' => rand(0, 1),
                // 'idUsuarioCancela' => rand(1, 5),
                'pagoValidado' => rand(0, 1),
                //'idUsuarioValidaPago' => rand(1, 1),
                //'historico' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pago_lotes')->insert($pagos);
    }
}
