<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Models\Product;

class ProductService
{

    protected $model;


    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function query($request) : AnonymousResourceCollection
    {
        $parameters = $request->only(['category', 'subcategory', 'query']);

        $products = Product::where('visible', true);

        if (isset($parameters['category'])) {
            $products = $products->where('category_id', $parameters['category']);

            if (isset($parameters['subcategory'])) {
                $products = $products->where('subcategory_id', $parameters['subcategory']);
            }
        }

        if(isset($parameters['query'])){
            $products = $products->where('name', 'LIKE', '%'.$parameters['query'].'%')
            ->orWhere('short_info', 'LIKE', '%' . $parameters['query'] . '%')
            ->orWhere('description', 'LIKE', '%' . $parameters['query'] . '%');
        }

        return ProductResource::collection($products->paginate());

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
