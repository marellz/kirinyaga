<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;



class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function collectImages(): Collection
    {
        $collection = collect([]);

        foreach (range(1, 3) as $page) {
            # code...
            $response = Http::withHeaders([
                'Authorization' => config('unsplash.UNSPLASH_CLIENT_ID'),
                'Accept-Version' => 'v1',
            ])
                ->acceptJson()
                ->withUrlParameters([
                    'page' => $page,
                    'per_page' => 50,
                    'search' => 'tools',
                    'orientation' => 'squarish'
                ])
                ->get('https://api.unsplash.com/photos');

            if ($response->successful()) {
                $collection = $collection->merge($response->collect());
            } else {
                Log::debug($response->status());
            }
        }

        return $collection;
    }


    public function run(): void
    {
        //
        $category = Category::inRandomOrder()->first();
        $subcategory = $category->subcategories->random();

        Product::factory(100)->create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
        ]);

        $products = Product::all();
        $images = $this->collectImages();

        // todo: get photos and populate
        foreach ($products as $product) {
            $takes = $images->random(5);
            foreach (range(0, 4) as $i) {
                $image = $takes[$i];
                ProductPhoto::create([
                    'url' => $image['urls']['regular'],
                    'product_id' => $product->id,
                    'caption' => $image['description'] ?? 'No caption',
                ]);
            }
        }
    }
}
