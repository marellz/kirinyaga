<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        //
        $parameters = $request->only(['category','subcategory']);

        $products = $this->service->query($parameters);

        return view('products.list', [
            'products' => $products,
            'parameters' => $parameters,
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

        return view('products.form', ['categories' => $categories, 'product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->service->store($request);

        if($product->exists()){
            abort(500, 'Error creating product');
        }

        return redirect()
            ->route('products')
            ->with('message', 'Successfully added!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        if (!$product->exists()) {
            abort(404);
        }
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();

        return view('products.form', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        //
        $updated = $this->service->update($product, $request);

        if ($updated) {
            abort(500, 'Error updating product');
        }

        return redirect()
            ->route('product.show', [$updated])
            ->with('status', 'Updated successfully');
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
            ->route('products')
            ->with('message', 'Product successfully deleted');
    }
}
