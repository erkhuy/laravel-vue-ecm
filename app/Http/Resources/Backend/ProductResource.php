<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'image' => $this->image,
            'sale' => $this->sale,
            'amount' => $this->amount,
            'categories' => CategoryResource::collection($this->categories),
            'colors' => ColorResource::collection($this->colors),
            'sizes' => SizeResource::collection($this->sizes),
            'images' => ImageResource::collection($this->images),
        ];
    }
}