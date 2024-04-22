<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;

class CategoryService
{

    public function __construct(
        private readonly Category $model,
    ) {
    }

    public function list()
    {
        $categories = Category::all();

        return $categories;
    }

    public function get(string $id)
    {
        $category = Category::findOrFail($id);

        return $category;
    }

    public function store(CategoryStoreRequest $request)
    {
        $validated = $request->safe()->only($this->model->fillable);

        $category = Category::create($validated);

        return $category;
    }

    public function update(string $id, CategoryUpdateRequest $request)
    {
        $category = $this->get($id);
        $validated = $request->safe()->only($this->model->fillable);

        $category->update($validated);

        return $category;
    }

    public function destroy(string $id)
    {
        $category = $this->get($id);
        
        foreach ($category->subCategories as $subcategory) {
            $subcategory->delete();
        }

        $deleted = $category->delete();

        return $deleted;
    }
}
