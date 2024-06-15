<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenyakitRequest;
use App\Http\Resources\PenyakitCategoryCollection;
use App\Http\Resources\PenyakitCategoryResource;
use App\Http\Resources\PenyakitCollection;
use App\Http\Resources\PenyakitResource;
use App\Models\Penyakit;
use App\Models\PenyakitCategory;
use App\Traits\ApiResponse;

class ProductController extends Controller
{
    use ApiResponse;

    public function getPenyakitCategories()
    {
        $penyakitCategories = PenyakitCategory::with('parent', 'allChildren', 'articles')->get();
        return $this->successResponse(
            'Success get categories',
            new PenyakitCategoryCollection($penyakitCategories)
        );
    }

    public function getDetailPenyakitCategory(PenyakitCategory $penyakitCategory)
    {
        return $this->successResponse(
            'Success get category',
            new PenyakitCategoryResource($penyakitCategory)
        );
    }

    public function getArticlesByCategory(PenyakitRequest $request)
    {
        $penyakitCategory = PenyakitCategory::findOrFail($request->category_id);
        $penyakitArticles = $penyakitCategory->articles;
        return $this->successResponse(
            'Success get articles',
            new PenyakitCollection($penyakitArticles)
        );
    }

    public function getDetailArticle(Penyakit $penyakit)
    {
        return $this->successResponse(
            'Success get detail article',
            new PenyakitResource($penyakit)
        );
    }
}
