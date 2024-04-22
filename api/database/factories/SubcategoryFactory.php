<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $name = 'Subcategory ' .  random_int(1111, 9999);
        return [
            //
            "name" => $name,
            "slug" => Str::slug($name),
            "category_id" => $category->first(),
            "description" => fake()->sentences(3, true),
        ];
    }
}
