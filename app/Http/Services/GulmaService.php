<?php

namespace App\Http\Services;

use App\Http\Requests\GulmaRequest;
use App\Models\Gulma;
use App\Models\GulmaImage;
use Illuminate\Support\Facades\Storage;

class GulmaService
{
    public function getDatabaseGulma()
    {
        return Gulma::with('images')->get();
    }

    public function addGulmaToDatabase(GulmaRequest $request)
    {
        $gulma = Gulma::create([
            'title' => $request->title
        ]);

        if ($request->images) {
            foreach ($request->images as $i => $image) {
                GulmaImage::create([
                    'image' => storeImage($image, 'gulma'),
                    'description' => $request->image_descriptions[$i],
                    'gulma_id' => $gulma->id,
                ]);
            }
        }

        return $gulma;
    }

    public function updateGulmaFromDatabase(Gulma $gulma, GulmaRequest $request)
    {
        $gulma->update([
            'title' => $request->title,
        ]);

        if ($request->images) {
            foreach ($gulma->images as $image) {
                $image->delete();
            }

            foreach ($request->images as $i => $image) {
                GulmaImage::create([
                    'image' => storeImage($image, 'gulma'),
                    'description' => $request->image_descriptions[$i],
                    'gulma_id' => $gulma->id,
                ]);
            }
        }

        return $gulma;
    }

    public function deleteGulmaFromDatabase(Gulma $gulma)
    {
        $gulma->delete();
    }

    protected function deleteImageIfExists($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
