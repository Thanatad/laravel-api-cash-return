<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

        $user->assignRole('Admin');
    }
}
