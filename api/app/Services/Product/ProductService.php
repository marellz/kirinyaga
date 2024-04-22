<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Models\Product;

class ProductService
{
    public function __construct(
        private readonly Product $model
    ) {
    }

    public function query($request): AnonymousResourceCollection
    {

        /**
         * FILTERS:
         * 
         *  'category',
         *  'subcategory',
         *  'price_max',
         *  'price_min',
         *  'query' // search term
         * 
         */



        $category = $request->get('category_id');
        $subcategory = $request->get('subcategory_id');
        $query = $request->get('query');
        $maxPrice = $request->get('price_max');
        $minPrice = $request->get('price_min');


        $products = Product::where('visible', true);

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($subcategory) {
            $products = $products->where('subcategory_id', $subcategory);
        }

        if ($query) {
            $products = $products->where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('short_info', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%');
        }

        if ($maxPrice) {
            $products = $products->where('price', '<=', $maxPrice);
        }

        if ($minPrice) {
            $products = $products->where('price', '>=', $minPrice);
        }

        /**
         * SORT_BY:
         * price_asc
         * price_desc
         * oldest
         * newest
         * alpha_first
         * alpha_last
         */

        $sortBy = $request->get('sort_by');

        if ($sortBy) {
            switch ($sortBy) {
                case 'price_asc':
                    $products = $products->orderBy('price', 'asc');
                    break;

                case 'price_desc':
                    $products = $products->orderBy('price', 'desc');
                    break;

                case 'oldest':
                    $products = $products->orderBy('created_at', 'asc');
                    break;

                case 'newest':
                    $products = $products->orderBy('created_at', 'desc');
                    break;

                case 'alpha_first':
                    $products = $products->orderBy('name', 'asc');
                    break;

                case 'alpha_last':
                    $products = $products->orderBy('name', 'desc');
                    break;


                default:
                    $products = $products->orderBy('created_at', 'desc');
                    break;
            }
        }

        return ProductResource::collection($products->get());
    }

    public function get(string $id): ProductResource
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function store(ProductStoreRequest $request): ProductResource
    {
        $validated = $request->safe()->only($this->model->fillable);

        $product = $this->model->create($validated);

        return new ProductResource($product);
    }


    public function update(string $id, ProductUpdateRequest $request): Product
    {
        $product = $this->get($id);
        $validated = $request->safe()->only($this->model->fillable);

        $updated = $product->update($validated);

        return $updated;
    }


    public function destroy(string $id): bool|null
    {
        $product = $this->get($id);
        foreach ($product->photos as $photo) {
            $photo->delete();
        }

        $deleted = $product->delete();

        return $deleted;
    }
}
