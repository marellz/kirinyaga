<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service,
        private readonly CategoryService $categoryService,
    ) {
    }

    public function index(Request $request)
    {
        $products = $this->service->query($request);
        $data['items'] = $products;
        return $this->respond($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $data['categories'] = $this->categoryService->list();
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->service->store($request);

        if ($product->exists()) {
            abort(500, 'Error creating product');
        }

        return redirect()
            ->route('dash.products')
            ->with('message', 'Successfully added!');;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();

        return view('dash.products.form', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        //
        $updated = $this->service->update($product, $request);

        if (!$updated) {
            abort(500, 'Error updating product');
        }

        return redirect()
            ->route('dash.products', [$updated])
            ->with('status', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Product $product)
    {
        $deleted = $this->service->destroy($product);

        if (!$deleted) {
            abort(500, 'Error deleting product');
        }

        return redirect()
            ->back()
            ->with('message', 'Product successfully deleted');
    }
}
