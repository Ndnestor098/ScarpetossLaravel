<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(250)->create();

        foreach($products as $item)
        {
            for ($x=1; $x <= 12; $x++) { 
                ProductSize::create([
                    'product_id' => $item->id,
                    'size_id' => $x
                ]);
            }
            
        }
    }
}
