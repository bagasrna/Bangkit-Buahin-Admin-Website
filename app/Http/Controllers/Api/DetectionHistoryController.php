<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetectionHistoryCollection;
use App\Http\Resources\DetectionHistoryResource;
use App\Models\DetectionHistory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DetectionHistoryController extends Controller
{
    use ApiResponse;

    public function createHistory(Request $request)
    {
        $user = auth()->guard('api')->user();
        $history = DetectionHistory::create([
            'label' => $request->label,
            'score' => $request->score,
            'recommendation' => $request->recommendation,
            'image' => storeImage($request->image, 'history'),
            'user_id' => $user->id
        ]);

        return $this->successResponse(
            'Success get histories',
            new DetectionHistoryResource($history)
        );
    }

    public function getHistories()
    {
        $user = auth()->guard('api')->user();
        $histories = $user->detectionHistories;
        return $this->successResponse(
            'Success get histories',
            new DetectionHistoryCollection($histories)
        );
    }

    public function getDetailHistory(DetectionHistory $history)
    {
        return $this->successResponse(
            'Success get detail history',
            new DetectionHistoryResource($history)
        );
    }
}
