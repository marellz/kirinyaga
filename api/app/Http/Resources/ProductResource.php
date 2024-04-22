<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "short_info" => $this->short_info,
            "category" => [
                "id" => $this->category->id,
                "name" => $this->category->name,
            ],
            "subcategory" => $this->subcategory ? [
                "id" => $this->subcategory->id,
                "name" => $this->subcategory->name,
            ] : null,
            "price" => $this->price,
            "description" => $this->description,
            "in_stock" => $this->in_stock > 0,
            "visible" => $this->visible > 0,
            "created" => $this->created_at->toDateTimeString(),
            "updated" => $this->updated_at->toDateTimeString(),
        ];
    }
}
