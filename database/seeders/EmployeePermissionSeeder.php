<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //Home
            ['name' => 'employee-home'],
            // Leaves Request
            ['name' => 'leaves-request-list'],
            ['name' => 'leaves-request-create'],
            ['name' => 'leaves-request-edit'],
            ['name' => 'leaves-request-delete'],

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'role' => 'employee']);
        }

        $role = Role::create(['name' => 'Employee', 'role' => 'employee']);

        $role->syncPermissions($permissions);



    }
}
