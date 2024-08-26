<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EgresosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('egresos')->insert([
            [
                'idConcepto' => 1,
                'descripcion' => 'Compra de cemento y varilla para construcción.',
                'monto' => 15000.00,
                'idUsuarioRecibe' => 1,
                'fecha' => '2024-03-15',
                'hora' => '09:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 2,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 4,
                'descripcion' => 'Pago de nómina para empleados de obra.',
                'monto' => 45000.00,
                'idUsuarioRecibe' => 2,
                'fecha' => '2024-03-30',
                'hora' => '14:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 3,
                'cancelado' => false,
            ],
        ]);
    }
}
