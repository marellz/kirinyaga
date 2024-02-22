<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    private $service;

    public function __construct(
        ProductService $service,
    ) {
        $this->service = $service;
    }

    public function index (Request $request)
    {
        $products = $this->service->query($request);

        return view('dash.products.list', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $categories = Category::all();
        $product = new Product();

        return view('dash.products.form', ['categories' => $categories, 'product' => $product]);
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
