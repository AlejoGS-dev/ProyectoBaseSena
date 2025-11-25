<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles base
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $clienteRole = Role::firstOrCreate(['name' => 'cliente']);
        $freelancerRole = Role::firstOrCreate(['name' => 'freelancer']);

        // Definir permisos solo para admin (los otros no tienen ninguno)
        $adminPermissions = [
            'user-list', 'user-create', 'user-edit', 'user-delete', 'user-activate',
            'rol-list', 'rol-create', 'rol-edit', 'rol-delete',
            'producto-list', 'producto-create', 'producto-edit', 'producto-delete',
            'pedido-list', 'pedido-anulate'
        ];

        // Crear permisos y asignarlos al rol admin
        foreach ($adminPermissions as $permiso) {
            $permission = Permission::firstOrCreate(['name' => $permiso]);
            $adminRole->givePermissionTo($permission);
        }

        // Crear usuarios base
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@prueba.com'],
            ['name' => 'Admin', 'password' => bcrypt('admin123456')]
        );
        $adminUser->assignRole($adminRole);

        $clienteUser = User::firstOrCreate(
            ['email' => 'cliente@prueba.com'],
            ['name' => 'Cliente', 'password' => bcrypt('cliente123456')]
        );
        $clienteUser->assignRole($clienteRole);

        // Crear usuario con doble rol: cliente + freelancer
        $multiRolUser = User::firstOrCreate(
            ['email' => 'dual@prueba.com'],
            ['name' => 'Dual Rol', 'password' => bcrypt('dual123456')]
        );
        $multiRolUser->syncRoles([$clienteRole, $freelancerRole]);
    }
}
