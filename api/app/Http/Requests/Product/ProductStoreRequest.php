<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' =>'required|string|max:255|unique:products',
            'short_info' => 'required|string|max:1024',
            'slug' => 'required|string',
            'category_id' => 'required|exists:categories,id|',
            'subcategory_id' => 'exists:subcategories,id',
            'price' => 'required|numeric',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
