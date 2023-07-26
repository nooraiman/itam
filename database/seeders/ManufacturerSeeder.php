<?php

namespace Database\Seeders;

use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Apple',
                'website' => 'https://www.apple.com/'
            ],
            [
                'name' => 'Dell',
                'website' => 'https://www.dell.com/'
            ],
            [
                'name' => 'Asus',
                'website' => 'https://www.asus.com/'
            ],
            [
                'name' => 'Samsung',
                'website' => 'https://www.samsung.com/'
            ]
        ];

        foreach ($datas as $data) {
            Manufacturer::create($data);
        }
    }
}
