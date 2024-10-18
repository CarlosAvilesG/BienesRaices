<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([


            UsersTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            NegocioTableSeeder::class,
            ClientesTableSeeder::class,
            ClienteReferenciaTableSeeder::class,

            PredioTableSeeder::class,
            LotesTableSeeder::class,
            PagosLoteTableSeeder::class,
            ContratoTableSeeder::class,

            ConceptoEgresoTableSeeder::class,
            EgresosTableSeeder::class,
            CorteCajaTableSeeder::class,
            CorteCajaDetalleTableSeeder::class,
            BitacoraTableSeeder::class,
            FrasesEticasTableSeeder::class,
        ]);
    }
}
