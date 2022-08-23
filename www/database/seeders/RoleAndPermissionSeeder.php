<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'role-read',
            'role-update',
            'role-delete',
            'role-create',
            'permission-read',
            'permission-update',
            'permission-delete',
            'permission-create',
            'user-read',
            'user-update',
            'user-create',
            'user-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'User'])->givePermissionTo(Permission::where('name', 'like', 'user-%')->get());
    }
}
