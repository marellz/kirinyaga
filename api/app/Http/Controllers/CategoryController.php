<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;


class CategoryController extends Controller
{

    public function __construct(
        private readonly CategoryService $service
    ) {
    }

    public function index()
    {
        $categories = $this->service->list();
        return view('dash.categories.list', ['categories' => $categories]);
    }

    public function create()
    {
        $category = new Category();
        return view('dash.categories.form', ['category' => $category]);
    }


    public function store(CategoryStoreRequest $request)
    {
        $category = $this->service->store($request);

        if (!$category) {
            abort(500, 'Error deleting category');
        }

        return redirect()
            ->route('dash.categories')
            ->with('message', 'Successfully added!');
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $updated = $this->service->update($category, $request);

        if (!$updated) {
            abort(500, 'Error deleting category');
        }

        return redirect()
            ->route('dash.categories')
            ->with('message', 'Successfully updated!');
    }

    public function destroy(Category $category)
    {
        $deleted = $this->service->destroy($category);

        if (!$deleted) {
            abort(500, 'Error deleting category');
        }

        return redirect()
            ->route('dash.categories')
            ->with('message', 'Successfully deleted!');
    }
}
