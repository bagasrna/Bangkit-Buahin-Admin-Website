<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GulmaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'description' => $image->description,
                    'image' => getStorageAssetFile($image->image)
                ];
            }),
        ];
    }
}
