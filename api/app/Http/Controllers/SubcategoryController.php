<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategory\SubcategoryStoreRequest;
use App\Http\Requests\Subcategory\SubcategoryUpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\Category\CategoryService;
use App\Services\Subcategory\SubcategoryService;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly SubcategoryService $service
    ) {
    }


    public function index()
    {
        $subcategories = $this->service->all();
        $data['items'] = $subcategories;
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
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryStoreRequest $request)
    {
        //
        $subcategory = $this->service->store($request);

        $data['item'] = $subcategory;
        return $this->respond($data);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return $this->respond([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, SubcategoryUpdateRequest $request)
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
        //
        $deleted = $this->service->destroy($id);

        $data['deleted'] = $deleted;
        return $this->respond($data);
    }
}
