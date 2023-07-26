<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['name' => 'Laptop'],
            ['name' => 'Desktop'],

        ];

        foreach ($datas as $data) {
            Category::create($data);
        }
    }
}
