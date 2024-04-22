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
        $parameters = $request->only(['category', 'subcategory', 'query']);

        $products = Product::where('visible', true);

        if (isset($parameters['category'])) {
            $products = $products->where('category_id', $parameters['category']);

            if (isset($parameters['subcategory'])) {
                $products = $products->where('subcategory_id', $parameters['subcategory']);
            }
        }

        if (isset($parameters['query'])) {
            $products = $products->where('name', 'LIKE', '%' . $parameters['query'] . '%')
                ->orWhere('short_info', 'LIKE', '%' . $parameters['query'] . '%')
                ->orWhere('description', 'LIKE', '%' . $parameters['query'] . '%');
        }

        return ProductResource::collection($products->paginate());
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
