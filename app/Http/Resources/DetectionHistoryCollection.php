<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DetectionHistoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->label,
                    'score' => $item->score,
                    'recommendation' => $item->recommendation,
                    'image' => $item->image ?
                        getStorageAssetFile($item->image) : null,
                ];
            }),
        ];
    }
}
