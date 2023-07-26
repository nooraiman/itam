<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeederAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Noor Aiman',
            'email' => 'nooraimanz06@gmail.com',
            'password' => bcrypt('aiman123'),
            'role' => 'admin'
        ]);
    }
}
