<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);


        $role = Role::create(['name' => 'SuperAdmin', 'role' => 'admin']);

        $permissions = Permission::where(['role' => 'admin'])->pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $superAdmin->assignRole([$role->id]);
    }
}
