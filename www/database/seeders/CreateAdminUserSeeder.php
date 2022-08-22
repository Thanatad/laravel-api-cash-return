<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $user->profile()->create([
            'name' => 'Thanatad B',
            'mobile' => '0900901116'
        ]);

        $role = Role::find(1);

        $user->assignRole($role);
    }
}
