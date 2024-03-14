<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryUpdateRequest extends FormRequest
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
            'name' => ['max:255','required','string', Rule::unique('categories')->ignore($this->category)],
            'slug' => 'required|string|unique:categories',
            'description' => 'string|nullable',
        ];
    }


    protected function prepareForValidation(): void
    {
        if ($this->name) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }
    }
}
