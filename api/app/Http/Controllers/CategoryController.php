<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(
        private readonly CategoryService $service
    ) {
    }

    public function index()
    {
        $categories = $this->service->all();
        $data['categories'] = $categories;
        return $this->respond($data);
    }

    public function create()
    {
        return $this->respond([]);
    }

    public function get(string $id)
    {
        $category = $this->service->get($id);
        $data['item'] = $category;
        return $this->respond($data);
    }


    public function store(CategoryStoreRequest $request)
    {
        $category = $this->service->store($request);

        if (!$category) {
            abort(500, 'Error deleting category');
        }

        $data['item'] = $category;
        return $this->respond($data);
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        $updated = $this->service->update($category, $request);

        if (!$updated) {
            abort(500, 'Error deleting category');
        }

        $data['updated'] = $updated;
       return $this->respond($data);
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
