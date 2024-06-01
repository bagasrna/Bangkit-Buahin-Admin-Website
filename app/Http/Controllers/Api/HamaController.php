<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HamaRequest;
use App\Http\Resources\HamaCategoryCollection;
use App\Http\Resources\HamaCategoryResource;
use App\Http\Resources\HamaCollection;
use App\Http\Resources\HamaResource;
use App\Models\Hama;
use App\Models\HamaCategory;
use App\Traits\ApiResponse;

class HamaController extends Controller
{
    use ApiResponse;

    public function getHamaCategories()
    {
        $hamaCategories = HamaCategory::with('parent', 'allChildren', 'articles')->get();
        return $this->successResponse(
            'Success get categories',
            new HamaCategoryCollection($hamaCategories)
        );
    }

    public function getDetailHamaCategory(HamaCategory $hamaCategory)
    {
        return $this->successResponse(
            'Success get category',
            new HamaCategoryResource($hamaCategory)
        );
    }

    public function getArticlesByCategory(HamaRequest $request)
    {
        $hamaCategory = HamaCategory::findOrFail($request->category_id);
        $hamaArticles = $hamaCategory->articles;
        return $this->successResponse(
            'Success get articles',
            new HamaCollection($hamaArticles)
        );
    }

    public function getDetailArticle(Hama $hama)
    {
        return $this->successResponse(
            'Success get detail article',
            new HamaResource($hama)
        );
    }
}
