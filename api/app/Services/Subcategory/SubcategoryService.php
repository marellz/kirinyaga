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

    public function all()
    {
        $subcategory = Subcategory::all();

        return $subcategory;
    }

    public function get(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        return $subcategory;
    }

    public function store(SubcategoryStoreRequest $request)
    {
        $validated = $request->safe()->only($this->model->fillable);

        $subcategory = Subcategory::create($validated);

        return $subcategory;
    }

    public function update(string $id, SubcategoryUpdateRequest $request)
    {
        $subcategory = $this->get($id);
        
        $validated = $request->safe()->only($this->model->fillable);
        
        $subcategory->update($validated);
        
        return $subcategory;
    }
    
    public function destroy(string $id)
    {
        $subcategory = $this->get($id);
        
        $deleted = $subcategory->delete();

        return $deleted;
    }
}
