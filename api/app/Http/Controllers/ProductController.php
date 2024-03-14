<?php

declare(strict_types=1);

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\Product\ProductService;

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
        $products = $this->service->query($request);

        return view('products.list', [
            'products' => $products,
        ]);
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

    
}
