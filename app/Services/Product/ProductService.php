<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;

class ProductService
{

    protected $model;


    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function query($parameters)
    {
        $products = Product::where('visible', true);

        if (isset($parameters['category'])) {
            $products = $products->where('category_id', $parameters['category']);

            if (isset($parameters['subcategory'])) {
                $products = $products->where('subcategory_id', $parameters['subcategory']);
            }
        }

        return $products->paginate();
    }

    public function store(ProductStoreRequest $request): Product
    {
        $validated = $request->safe()->only($this->model->fillable);

        $product = $this->model->create($validated);

        return $product;
    }


    public function update(Product $product, ProductUpdateRequest $request): Product
    {
        $validated = $request->safe()->only($this->model->fillable);

        $product->update($validated);

        return $product;
    }


    public function destroy(Product $product): bool|null
    {

        foreach ($product->photos as $photo) {
            $photo->delete();
        }

        $deleted = $product->delete();

        return $deleted;
    }
}
