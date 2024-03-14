<?php

declare(strict_types=1);

namespace App\Services\Subcategory;

use App\Http\Requests\Subcategory\SubcategoryStoreRequest;
use App\Http\Requests\Subcategory\SubcategoryUpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryService
{
    public function __construct(
        private readonly Subcategory $model,
    ) {
    }

    public function store(SubcategoryStoreRequest $request)
    {
        $validated = $request->safe()->only($this->model->fillable);

        $subcategory = Subcategory::create($validated);

        return $subcategory;
    }

    public function update(Subcategory $subcategory, SubcategoryUpdateRequest $request)
    {
        $validated = $request->safe()->only($this->model->fillable);

        $subcategory->update($validated);

        return $subcategory;
    }

    public function destroy(Subcategory $subcategory)
    {
        $deleted = $subcategory->delete();

        return $deleted;
    }
}
