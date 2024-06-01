<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdsCollection;
use App\Models\Ads;
use App\Traits\ApiResponse;

class AdsController extends Controller
{
    use ApiResponse;

    public function getAds()
    {
        $ads = Ads::orderBy('created_at', 'desc')->get();
        return $this->successResponse(
            'Success get ads',
            new AdsCollection($ads)
        );
    }
}
