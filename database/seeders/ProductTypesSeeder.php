<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $productTypes = [
            [
                'name' => 'Services',
                'description' => 'Services offered by the company',
            ],
            [
                'name' => 'Download',
                'description' => 'Digital products available for download',
            ],
            [
                'name' => 'Physical',
                'description' => 'Physical products that can be shipped',
            ],
        ];

        DB::table('product_types')->insert($productTypes);
    }
}
