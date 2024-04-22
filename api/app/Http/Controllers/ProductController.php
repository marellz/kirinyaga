<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function create()
    {
        //
        return $this->respond([]);
    }

    /**
     * Show the a resource.
     */
    public function show(string $id)
    {
        //
        $data['item'] = $this->service->get($id);
        return $this->respond($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->service->store($request);

        $data['item'] = $product;
        return $this->respond($data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
        return $this->respond([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, ProductUpdateRequest $request)
    {
        //
        $updated = $this->service->update($id, $request);

        $data['updated'] = $updated;
        return $this->respond($data);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $deleted = $this->service->destroy($id);

        $data['deleted'] = $deleted;
        return $this->respond($data);
    }
}
