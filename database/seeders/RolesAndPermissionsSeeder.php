<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Crear permisos, usando firstOrCreate para evitar duplicados
       Permission::firstOrCreate(['name' => 'gestionar usuarios']);
       Permission::firstOrCreate(['name' => 'gestionar lotes']);
       Permission::firstOrCreate(['name' => 'gestionar casas']);
       Permission::firstOrCreate(['name' => 'ver pagos']);
       Permission::firstOrCreate(['name' => 'realizar pagos']);
       Permission::firstOrCreate(['name' => 'realizar cortes']);
       Permission::firstOrCreate(['name' => 'operaciones de caja']);

       // Crear roles y asignar permisos, usando firstOrCreate para evitar duplicados
       $superuserRole = Role::firstOrCreate(['name' => 'SuperUsuario']);
       $superuserRole->givePermissionTo(['gestionar usuarios', 'gestionar lotes', 'gestionar casas', 'ver pagos', 'realizar pagos', 'realizar cortes', 'operaciones de caja']);

       $propietarioRole = Role::firstOrCreate(['name' => 'Propietario']);
       $propietarioRole->givePermissionTo(['gestionar lotes', 'gestionar casas', 'ver pagos']);

       $adminGeneralRole = Role::firstOrCreate(['name' => 'AdminGeneral']);
       $adminGeneralRole->givePermissionTo(['gestionar usuarios', 'gestionar lotes', 'gestionar casas', 'ver pagos']);

       $adminRole = Role::firstOrCreate(['name' => 'Admin']);
       $adminRole->givePermissionTo(['gestionar lotes', 'gestionar casas', 'ver pagos']);

       $gerenteCajaRole = Role::firstOrCreate(['name' => 'GerenteCaja']);
       $gerenteCajaRole->givePermissionTo(['realizar cortes', 'operaciones de caja']);

       $operadorCajaRole = Role::firstOrCreate(['name' => 'OperadorCaja']);
       $operadorCajaRole->givePermissionTo(['operaciones de caja']);

       $clienteRole = Role::firstOrCreate(['name' => 'Cliente']);
       $clienteRole->givePermissionTo(['ver pagos']);

       // Asignar roles a usuarios, si existen
       $user = User::find(1);
       if ($user) {
           $user->assignRole('SuperUsuario');
       }

       $user = User::find(2);
       if ($user) {
           $user->assignRole('Propietario');
       }

       $user = User::find(3);
       if ($user) {
           $user->assignRole('AdminGeneral');
       }

       $user = User::find(4);
       if ($user) {
           $user->assignRole('Admin');
       }

       $user = User::find(5);
       if ($user) {
           $user->assignRole('GerenteCaja');
       }


    }
}
