<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'type' => 'admin',
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456'),
        ];
        User::create($admin);
    }
}
