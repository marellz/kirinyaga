<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        foreach(range(1,5) as $i){
            $name = 'Category ' . $i;
            Category::factory()->create([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }

        foreach (Category::all() as $category) {
            foreach (range(1,3) as $i) {
                Subcategory::factory()->create([
                    'category_id'=> $category->id,
                ]);
            }
        }
    }
}
