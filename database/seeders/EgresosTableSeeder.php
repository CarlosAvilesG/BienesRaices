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
                'fecha' => '2025-03-15',
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
                'fecha' => '2025-03-30',
                'hora' => '14:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 3,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 3,
                'descripcion' => 'Compra de materiales para acabados de obra.',
                'monto' => 25000.00,
                'idUsuarioRecibe' => 1,
                'fecha' => '2025-04-15',
                'hora' => '09:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 2,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 2,
                'descripcion' => 'Pago de servicios de agua y luz.',
                'monto' => 5000.00,
                'idUsuarioRecibe' => 2,
                'fecha' => '2025-04-30',
                'hora' => '14:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 3,
                'cancelado' => false,
            ],
            // ingresa 20 egresos que registro el usuario 1
            [
                'idConcepto' => 1,
                'descripcion' => 'Compra de cemento y varilla para construcción.',
                'monto' => 15000.00,
                'idUsuarioRecibe' => 1,
                'fecha' => '2025-03-15',
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
                'fecha' => '2025-03-30',
                'hora' => '14:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 3,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 3,
                'descripcion' => 'Compra de materiales para acabados de obra.',
                'monto' => 25000.00,
                'idUsuarioRecibe' => 1,
                'fecha' => '2025-04-15',
                'hora' => '09:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 2,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 2,
                'descripcion' => 'Pago de servicios de agua y luz.',
                'monto' => 5000.00,
                'idUsuarioRecibe' => 2,
                'fecha' => '2025-04-30',
                'hora' => '14:00:00',
                'idUsuario' => 1,
                'supervisado' => true,
                'idUsuSupervisa' => 3,
                'cancelado' => false,
            ],
            [
                'idConcepto' => 1,
                'descripcion' => 'Compra de cemento y varilla para construcción.',
                'monto' =>
                15000.00,
                'idUsuarioRecibe' => 1, 'fecha' => '2025-03-15', 'hora' => '09:00:00', 'idUsuario' => 1, 'supervisado' => true, 'idUsuSupervisa' => 2, 'cancelado' => false,
            ],

        ]);
    }
}
