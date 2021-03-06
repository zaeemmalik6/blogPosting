<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateNormalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'type' => 'normalUser',
            'name' => 'Kashif Raza',
            'email' => 'Kashif.Raza@cp.com',
            'password' => bcrypt('123456'),
        ];
        User::create($admin);
    }
}
