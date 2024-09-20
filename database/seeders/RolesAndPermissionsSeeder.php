<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Crear permisos
        Permission::create(['name' => 'gestionar usuarios']);
        Permission::create(['name' => 'gestionar lotes']);
        Permission::create(['name' => 'gestionar casas']);
        Permission::create(['name' => 'ver pagos']);
        Permission::create(['name' => 'realizar pagos']);
        Permission::create(['name' => 'realizar cortes']);
        Permission::create(['name' => 'operaciones de caja']);

        // Crear roles y asignar permisos
        $superuserRole = Role::create(['name' => 'SuperUsuario']);
        $superuserRole->givePermissionTo('gestionar usuarios');
        $superuserRole->givePermissionTo('gestionar lotes');
        $superuserRole->givePermissionTo('gestionar casas');
        $superuserRole->givePermissionTo('ver pagos');
        $superuserRole->givePermissionTo('realizar pagos');
        $superuserRole->givePermissionTo('realizar cortes');
        $superuserRole->givePermissionTo('operaciones de caja');

        $propietarioRole = Role::create(['name' => 'Propietario']);
        $propietarioRole->givePermissionTo('gestionar lotes');
        $propietarioRole->givePermissionTo('gestionar casas');
        $propietarioRole->givePermissionTo('ver pagos');

        $adminGeneralRole = Role::create(['name' => 'AdminGeneral']);
        $adminGeneralRole->givePermissionTo('gestionar usuarios');
        $adminGeneralRole->givePermissionTo('gestionar lotes');
        $adminGeneralRole->givePermissionTo('gestionar casas');
        $adminGeneralRole->givePermissionTo('ver pagos');

        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo('gestionar lotes');
        $adminRole->givePermissionTo('gestionar casas');
        $adminRole->givePermissionTo('ver pagos');

        $gerenteCajaRole = Role::create(['name' => 'GerenteCaja']);
        $gerenteCajaRole->givePermissionTo('realizar cortes');
        $gerenteCajaRole->givePermissionTo('operaciones de caja');

        $operadorCajaRole = Role::create(['name' => 'OperadorCaja']);
        $operadorCajaRole->givePermissionTo('operaciones de caja');

        $clienteRole = Role::create(['name' => 'Cliente']);
        $clienteRole->givePermissionTo('ver pagos');

    }
}
