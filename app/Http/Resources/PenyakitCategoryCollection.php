<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PenyakitCategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->where('parent_id', null)->map(function ($item) {
                return $this->formatCategory($item);
            }),
        ];
    }

    protected function formatCategory($category)
    {
        $formattedCategory = [
            'id' => $category->id,
            'name' => $category->name,
            'articles' => $category->articles->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title
                ];
            })
        ];

        if ($category->children->isNotEmpty()) {
            $formattedCategory['children'] = $category->children->map(function ($child) {
                return $this->formatCategory($child);
            });
        }

        return $formattedCategory;
    }
}
