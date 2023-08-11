<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SuperAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //Home
            ['name' => 'home'],
            //UserManagement
            //Roles
            ['name' => 'role-list'],
            ['name' => 'role-create'],
            ['name' => 'role-edit'],
            ['name' => 'role-delete'],
            //Users
            ['name' => 'user-list'],
            ['name' => 'user-create'],
            ['name' => 'user-edit'],
            ['name' => 'user-delete'],

            //Employees
            ['name' => 'employees-list'],
            ['name' => 'employees-create'],
            ['name' => 'employees-edit'],
            ['name' => 'employees-delete'],

            //Employees Leaves Types
            ['name' => 'leaves-list'],
            ['name' => 'leaves-create'],
            ['name' => 'leaves-edit'],
            ['name' => 'leaves-delete'],

            //Employees Leaves Request
            ['name' => 'employees-leaves-request-list'],
            ['name' => 'employees-leaves-request-edit'],

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'role' => 'admin']);
        }
    }
}
