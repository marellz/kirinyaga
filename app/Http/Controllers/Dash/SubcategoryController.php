<?php

namespace App\Http\Controllers\Dash;

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


    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        //
        $newCategory = new Subcategory();
        return view('dash.categories.form', [
            'category' => $newCategory,
            'parentCategory' => $category,
            'categories' => $this->categoryService->list()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Category $category, SubcategoryStoreRequest $request)
    {
        //
        $subcategory = $this->service->store($request);

        if(!$subcategory->exists()){
            abort(500,'Error creating subcategory');
        }

        return redirect()
        ->route('dash.categories')
        ->with(
            'message',
            'Subcategory created',
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Subcategory $subcategory)
    {
        //
        return view('dash.categories.form', [
            'category' => $subcategory,
            'parentCategory' => $category,
            'categories' => $this->categoryService->list()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        //
        $updated = $this->service->update($subcategory, $request);


        if (!$updated) {
            abort(500, 'Error creating subcategory');
        }

        return redirect()
            ->route('dash.categories')
            ->with(
                'message',
                'Subcategory updated',
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        //
        $deleted = $this->service->destroy($subcategory);

        if (!$deleted) {
            abort(500, 'Error creating subcategory');
        }
        
        return redirect()
            ->route('dash.categories')
            ->with(
                'message',
                'Subcategory deleted',
            );
    }
}
