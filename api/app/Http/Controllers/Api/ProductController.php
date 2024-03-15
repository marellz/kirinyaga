<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Services\Product\ProductService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $service;
    
    public function __construct (
        ProductService $service,
    )
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $parameters)
    {
        //
        $products = $this->service->query($parameters);
        return $this->respond($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request) : JsonResponse
    {
        //
        $product = $this->service->store($request);

        return $this->respond(['product' => $product]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return $this->respond(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        //
        $product = $this->service->update($product, $request);

        return $this->respond(['product' => $product]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
