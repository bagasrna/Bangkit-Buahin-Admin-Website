<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HamaCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'articles' => $this->articles->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title
                ];
            }),
            'parent' => $this->whenLoaded('parent', function () {
                return new HamaCategoryResource($this->parent);
            }),
            'children' => HamaCategoryResource::collection($this->allChildren),
        ];
    }
}
