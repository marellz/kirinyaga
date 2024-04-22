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
        $category = Category::inRandomOrder()->first();
        $subcategory = $category->subcategories->random();

        Product::factory(20)->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);
    }
}
