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
    //    // Crear permisos, usando firstOrCreate para evitar duplicados
    //    Permission::firstOrCreate(['name' => 'gestionar usuarios']);
    //    Permission::firstOrCreate(['name' => 'gestionar lotes']);
    //    Permission::firstOrCreate(['name' => 'gestionar casas']);
    //    Permission::firstOrCreate(['name' => 'ver pagos']);
    //    Permission::firstOrCreate(['name' => 'realizar pagos']);
    //    Permission::firstOrCreate(['name' => 'realizar cortes']);
    //    Permission::firstOrCreate(['name' => 'operaciones de caja']);

    //    // Crear roles y asignar permisos, usando firstOrCreate para evitar duplicados
    //    $superuserRole = Role::firstOrCreate(['name' => 'SuperUsuario']);
    //    $superuserRole->givePermissionTo(['gestionar usuarios', 'gestionar lotes', 'gestionar casas', 'ver pagos', 'realizar pagos', 'realizar cortes', 'operaciones de caja']);

    //    $propietarioRole = Role::firstOrCreate(['name' => 'Propietario']);
    //    $propietarioRole->givePermissionTo(['gestionar lotes', 'gestionar casas', 'ver pagos']);

    //    $adminGeneralRole = Role::firstOrCreate(['name' => 'AdminGeneral']);
    //    $adminGeneralRole->givePermissionTo(['gestionar usuarios', 'gestionar lotes', 'gestionar casas', 'ver pagos']);

    //    $adminRole = Role::firstOrCreate(['name' => 'Admin']);
    //    $adminRole->givePermissionTo(['gestionar lotes', 'gestionar casas', 'ver pagos']);

    //    $gerenteCajaRole = Role::firstOrCreate(['name' => 'GerenteCaja']);
    //    $gerenteCajaRole->givePermissionTo(['realizar cortes', 'operaciones de caja']);

    //    $operadorCajaRole = Role::firstOrCreate(['name' => 'OperadorCaja']);
    //    $operadorCajaRole->givePermissionTo(['operaciones de caja']);

    //    $clienteRole = Role::firstOrCreate(['name' => 'Cliente']);
    //    $clienteRole->givePermissionTo(['ver pagos']);


    //    // Asignar roles a usuarios, si existen
    //    $user = User::find(1);
    //    if ($user) {
    //        $user->assignRole('SuperUsuario');
    //    }

    //    $user = User::find(2);
    //    if ($user) {
    //        $user->assignRole('Propietario');
    //    }

    //    $user = User::find(3);
    //    if ($user) {
    //        $user->assignRole('AdminGeneral');
    //    }

    //    $user = User::find(4);
    //    if ($user) {
    //        $user->assignRole('Admin');
    //    }

    //    $user = User::find(5);
    //    if ($user) {
    //        $user->assignRole('GerenteCaja');
    //    }


     // Definir los permisos con descripciones
     // Definir los permisos con descripciones
     $permissions = [
       // ✅ Usuarios
        ['name' => 'users.index', 'description' => 'Ver lista de usuarios'],
        ['name' => 'users.create', 'description' => 'Crear usuarios'],
        ['name' => 'users.edit', 'description' => 'Editar usuarios'],
        ['name' => 'users.delete', 'description' => 'Eliminar usuarios'],

        // ✅ Roles y permisos
        ['name' => 'roles.index', 'description' => 'Ver roles'],
        ['name' => 'roles.create', 'description' => 'Crear roles'],
        ['name' => 'roles.edit', 'description' => 'Editar roles'],
        ['name' => 'roles.delete', 'description' => 'Eliminar roles'],
        ['name' => 'permissions.index', 'description' => 'Ver permisos'],
        ['name' => 'permissions.create', 'description' => 'Crear permisos'],
        ['name' => 'permissions.edit', 'description' => 'Editar permisos'],
        ['name' => 'permissions.delete', 'description' => 'Eliminar permisos'],

        // ✅ Clientes
        ['name' => 'clientes.index', 'description' => 'Ver clientes'],
        ['name' => 'clientes.create', 'description' => 'Crear clientes'],
        ['name' => 'clientes.edit', 'description' => 'Editar clientes'],
        ['name' => 'clientes.delete', 'description' => 'Eliminar clientes'],

        // ✅ Contratos
        ['name' => 'contratos.index', 'description' => 'Ver contratos'],
        ['name' => 'contratos.create', 'description' => 'Crear contratos'],
        ['name' => 'contratos.edit', 'description' => 'Editar contratos'],
        ['name' => 'contratos.delete', 'description' => 'Eliminar contratos'],



        // ✅ Corte de caja
        ['name' => 'cortedecaja.index', 'description' => 'Ver cortes de caja'],
        ['name' => 'cortedecaja.create', 'description' => 'Crear cortes de caja'],
        ['name' => 'cortedecaja.edit', 'description' => 'Editar cortes de caja'],
        ['name' => 'cortedecaja.delete', 'description' => 'Eliminar cortes de caja'],

        // ✅ Egresos
        ['name' => 'egresos.index', 'description' => 'Ver egresos'],
        ['name' => 'egresos.create', 'description' => 'Crear egresos'],
        ['name' => 'egresos.edit', 'description' => 'Editar egresos'],
        ['name' => 'egresos.delete', 'description' => 'Eliminar egresos'],

        // ✅ Lotes
        ['name' => 'lotes.index', 'description' => 'Ver lotes'],
        ['name' => 'lotes.create', 'description' => 'Crear lotes'],
        ['name' => 'lotes.edit', 'description' => 'Editar lotes'],
        ['name' => 'lotes.delete', 'description' => 'Eliminar lotes'],

        // ✅ Negocios
        ['name' => 'negocios.index', 'description' => 'Ver negocios'],
        ['name' => 'negocios.create', 'description' => 'Crear negocios'],
        ['name' => 'negocios.edit', 'description' => 'Editar negocios'],
        ['name' => 'negocios.delete', 'description' => 'Eliminar negocios'],

        // ✅ Pagos
        ['name' => 'pagos.index', 'description' => 'Ver pagos'],
        ['name' => 'pagos.create', 'description' => 'Registrar pagos'],
        ['name' => 'pagos.edit', 'description' => 'Editar pagos'],
        ['name' => 'pagos.delete', 'description' => 'Eliminar pagos'],
        ['name' => 'pagos.Procesar', 'description' => 'Procesar pagos'],


        // ✅ Predios
        ['name' => 'predios.index', 'description' => 'Ver predios'],
        ['name' => 'predios.create', 'description' => 'Registrar predios'],
        ['name' => 'predios.edit', 'description' => 'Editar predios'],
        ['name' => 'predios.delete', 'description' => 'Eliminar predios'],

       // ✅ Caja
        ['name' => 'cashdesk.view', 'description' => 'Ver caja'],
        ['name' => 'cashdesk.process', 'description' => 'Procesar transacciones'],
        ['name' => 'cashdesk.reports', 'description' => 'Ver reportes'],
        ['name' => 'cashdesk.open', 'description' => 'Abrir caja'],
        ['name' => 'cashdesk.close', 'description' => 'Cerrar caja'],

        // ✅ Permisos a Clientes
        ['name' => 'pagos.Ver', 'description' => 'Ver pagos'],
        ['name' => 'pagos.Pagar', 'description' => 'Realizar pagos'],
    ];

    foreach ($permissions as $permiso) {
        Permission::updateOrCreate(
            ['name' => $permiso['name']],
            ['description' => $permiso['description']]
        );
    }

    // Crear roles con descripciones
    $roles = [
        'SuperUsuario' => 'Tiene acceso a todo el sistema',
        'Propietario' => 'Puede ver y gestionar sus propios lotes o propiedades',
        'AdminGeneral' => 'Puede administrar usuarios, roles y configuraciones generales',
        // 'Admin' => 'Puede gestionar clientes, propiedades y ventas',
        'GerenteCaja' => 'Puede supervisar y administrar transacciones financieras',
        'OperadorCaja' => 'Puede realizar transacciones como cobros y pagos',
        'Cliente' => 'Solo puede ver su información y realizar pagos',
    ];

    foreach ($roles as $name => $description) {
        Role::updateOrCreate(
            ['name' => $name],
            ['description' => $description]
        );
    }

    // Asignar permisos a roles

    $rolesWithPermissions = [
        'SuperUsuario' => Permission::pluck('name')->toArray(), // SuperUsuario tiene todos los permisos
        'Propietario' => ['predios.index','predios.index', 'predios.create', 'predios.edit', 'predios.delete'],
        'AdminGeneral' => ['users.index', 'users.create', 'users.edit', 'users.delete', 'roles.index', 'roles.create', 'roles.edit', 'roles.delete'],
        'GerenteCaja' => ['cashdesk.view', 'cashdesk.open', 'cashdesk.close'],
        'OperadorCaja' => ['cashdesk.process', 'cashdesk.view'],
        'Cliente' => ['pagos.Ver'],
    ];

    foreach ($rolesWithPermissions as $role => $perms) {
        $roleInstance = Role::where('name', $role)->first();
        if ($roleInstance) {
            $roleInstance->syncPermissions($perms);
        }
    }

    // Asignar roles a usuarios, si existen
    $usersWithRoles = [
        1 => 'SuperUsuario',
        2 => 'Propietario',
        3 => 'AdminGeneral',
        4 => 'GerenteCaja',
    ];

    foreach ($usersWithRoles as $userId => $roleName) {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole($roleName);
        }
    }

    }
}
