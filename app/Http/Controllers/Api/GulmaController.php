<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GulmaCollection;
use App\Http\Resources\GulmaResource;
use App\Models\Gulma;
use App\Traits\ApiResponse;

class GulmaController extends Controller
{
    use ApiResponse;

    public function getArticles()
    {
        $gulmaArticles = Gulma::orderBy('created_at', 'desc')->get();
        return $this->successResponse(
            'Success get articles',
            new GulmaCollection($gulmaArticles)
        );
    }

    public function getDetailArticle(Gulma $gulma)
    {
        return $this->successResponse(
            'Success get detail article',
            new GulmaResource($gulma)
        );
    }
}
