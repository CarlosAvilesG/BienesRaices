<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lotes = [];

        for ($i = 1; $i <= 150; $i++) {
            $lotes[] = [
                'idPredio' => rand(1, 2), // Asumiendo que hay al menos 10 predios
                'idcontrato' => $i <= 3 ? $i : null,
                'manzana' => rand(1, 20),
                'lote' => rand(1, 100),
                'descripcion' => Str::random(50),
                'regular' => rand(0, 1),
                'donacion' => rand(0, 1),
                'loteComercial' => rand(0, 1),
                'loteReparable' => Str::random(5),
                'loteReparableObs' => Str::random(300),
                'inhabilitado' => rand(0, 1),
                'metrosFrente' => rand(1, 20) + rand(0, 99) / 100,
                'metrosAtras' => rand(1, 20) + rand(0, 99) / 100,
                'metrosDerecho' => rand(1, 20) + rand(0, 99) / 100,
                'metrosIzquierda' => rand(1, 20) + rand(0, 99) / 100,
                'metrosCuadrados' => rand(50, 200) + rand(0, 99) / 100,
                'precio' => rand(10000, 1000000) + rand(0, 99) / 100,
                'plazoMeses' => rand(1, 60),
                'pagoMensual' => rand(1000, 10000) + rand(0, 99) / 100,
                'estatusPago' => ['pendiente', 'pagado', 'atrasado'][rand(0, 2)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('lotes')->insert($lotes);

        // $lotesvacios = [];

        // for ($i = 1; $i <= 100; $i++) {
        //     $lotesvacios[] = [
        //         'idPredio' => rand(1, 2), // Asumiendo que hay al menos 10 predios
        //         'idContrato' =>  null,
        //         'manzana' => rand(1, 20),
        //         'lote' => rand(1, 100),
        //         'descripcion' => Str::random(50),
        //         'regular' => rand(0, 1),
        //         'donacion' => rand(0, 1),
        //         'loteComercial' => rand(0, 1),
        //         'loteReparable' => Str::random(5),
        //         'loteReparableObs' => Str::random(300),
        //         'inhabilitado' => rand(0, 1),
        //         'metrosFrente' => rand(1, 20) + rand(0, 99) / 100,
        //         'metrosAtras' => rand(1, 20) + rand(0, 99) / 100,
        //         'metrosDerecho' => rand(1, 20) + rand(0, 99) / 100,
        //         'metrosIzquierda' => rand(1, 20) + rand(0, 99) / 100,
        //         'metrosCuadrados' => rand(50, 200) + rand(0, 99) / 100,
        //         'precio' => rand(10000, 1000000) + rand(0, 99) / 100,
        //         'plazoMeses' => rand(1, 60),
        //         'pagoMensual' => rand(1000, 10000) + rand(0, 99) / 100,
        //         'estatusPago' => ['pendiente', 'pagado', 'atrasado'][rand(0, 2)],
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // DB::table('lotes')->insert($lotesvacios);


    }
}
