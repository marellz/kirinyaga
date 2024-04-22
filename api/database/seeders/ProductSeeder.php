<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //
        foreach (Category::all() as $cat) {

            foreach ($cat->subcategories as $subcat) {
                Product::factory()->create([
                    'category_id' => $cat->id,
                    'subcategory_id' => $subcat->id,
                ]);
            }

            // no subcategory
            Product::factory()->create([
                'category_id' => $cat->id,
            ]);
        }
    }
}
