<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Adidas', 'Nike', 'Asics', 'New Balance'];

        foreach ($brands as $brand) {
            Brand::query()->create(['name' => $brand]);
        }
    }
}
