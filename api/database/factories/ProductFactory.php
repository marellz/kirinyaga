<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        $name = 'Product '. random_int(1111, 9999);
        $subcategory = Subcategory::inRandomOrder()->first();

        return [
            //
            "name" => $name,
            "slug" => Str::slug($name),
            "short_info" => fake()->sentence(10, true),
            "category_id" => $subcategory->category_id,
            "subcategory_id" => $subcategory->id,
            "price" => (fake()->numberBetween(5, 500) * 100),
            "description" => fake()->paragraphs(5, true),
            "in_stock" => fake()->boolean(70),
            "visible" => fake()->boolean(90),
        ];
    }
}
