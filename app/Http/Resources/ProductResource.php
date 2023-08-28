<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {             
        return [
            'name'=>$this->name,
            'price'=>$this->price,
            'category_id'=>$this->category_id,
            'description'=>$this->description,
            'picture'=>asset(Storage::url($this->image))
        ];
    }
}
