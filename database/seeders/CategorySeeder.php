<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Category::factory(5)->create();

        foreach (Category::all() as $category) {
            foreach (range(1,5) as $i) {
                Subcategory::factory()->create([
                    'category_id'=> $category->id,
                ]);
            }
        }
    }
}
