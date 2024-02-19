<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductUpdateRequest extends FormRequest
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
            'name' => ['string', 'max:255', Rule::unique('products')->ignore($this->product)],
            'short_info' => 'string|max:1024',
            'slug' => 'string',
            'category_id' => 'exists:categories,id|',
            'subcategory_id' => 'exists:subcategories,id',
            'price' => 'numeric',
            'description' => 'string',
            'in_stock' => 'boolean',
            'visible' => 'boolean',
        ];
    }

    protected function prepareForValidation(): void
    {
        if($this->name){
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }
    }
}
