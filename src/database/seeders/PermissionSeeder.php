<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Очищаем кэш разрешений
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Создаем основные разрешения для CRUD операций
        $permissions = [
            // Пользователи
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Роли
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Задачи
            'tasks.view',
            'tasks.create',
            'tasks.edit',
            'tasks.delete',

            // Продукты
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            // Биллинг (дополнительно)
            'billing.view',
            'billing.manage',
            'transactions.view',
            'transactions.create',
        ];

        // Создаем разрешения
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Создаем роли и назначаем разрешения
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo([
            'users.view',
            'users.create',
            'users.edit',
            'roles.view',
            'tasks.view',
            'tasks.create',
            'tasks.edit',
            'products.view',
            'products.create',
            'products.edit',
        ]);

        $manager = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'tasks.view',
            'tasks.create',
            'tasks.edit',
            'products.view',
        ]);

        $user = Role::firstOrCreate(['name' => 'User', 'guard_name' => 'web']);
        $user->givePermissionTo([
            'tasks.view',
            'products.view',
        ]);

        // Создаем тестового суперадмина
        $superAdminUser = \App\Models\User::firstOrCreate([
            'email' => 'superadmin@example.com'
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password')
        ]);

        $superAdminUser->assignRole('Super Admin');

        // Создаем тестового админа
        $adminUser = \App\Models\User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password')
        ]);

        $adminUser->assignRole('Admin');
    }
}