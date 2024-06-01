<?php

namespace App\Http\Services;

use App\Http\Requests\HamaRequest;
use App\Models\Hama;
use App\Models\HamaImage;
use Illuminate\Support\Facades\Storage;

class HamaService
{
    public function getDatabaseHama()
    {
        return Hama::with(['categories', 'images'])->get();
    }

    public function addHamaToDatabase(HamaRequest $request)
    {
        $hama = Hama::create([
            'title' => $request->title,
            'description' => $request->description,
            'pencegahan' => $request->pencegahan,
            'pengendalian' => $request->pengendalian,
            'background_image' => storeImage($request->background_image, 'hama/background'),
            'daerah_persebaran_image' => storeImage($request->daerah_persebaran_image, 'hama/persebaran')
        ]);

        $hama->categories()->attach($request->category_ids);
        if ($request->images) {
            foreach ($request->images as $i => $image) {
                HamaImage::create([
                    'image' => storeImage($image, 'hama/pencegahan'),
                    'description' => $request->image_descriptions[$i],
                    'hama_id' => $hama->id,
                ]);
            }
        }

        return $hama;
    }

    public function updateHamaFromDatabase(Hama $hama, HamaRequest $request)
    {
        if ($request->background_image) {
            $this->deleteImageIfExists($hama->background_image);
            $hama->background_image = storeImage($request->background_image, 'hama/background');
        }

        if ($request->daerah_persebaran_image) {
            $this->deleteImageIfExists($hama->daerah_persebaran_image);
            $hama->daerah_persebaran_image = storeImage($request->daerah_persebaran_image, 'hama/persebaran');
        }

        $hama->update([
            'title' => $request->title,
            'description' => $request->description,
            'pencegahan' => $request->pencegahan,
            'pengendalian' => $request->pengendalian
        ]);

        $hama->categories()->sync($request->category_ids);
        if ($request->images) {
            foreach ($hama->images as $image) {
                $image->delete();
            }

            foreach ($request->images as $i => $image) {
                HamaImage::create([
                    'image' => storeImage($image, 'hama/tanda-serangan'),
                    'description' => $request->image_descriptions[$i],
                    'hama_id' => $hama->id,
                ]);
            }
        }

        return $hama;
    }

    public function deleteHamaFromDatabase(Hama $hama)
    {
        $hama->delete();
    }

    protected function deleteImageIfExists($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
