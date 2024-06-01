<?php

namespace App\Http\Services;

use App\Http\Requests\PenyakitRequest;
use App\Models\Penyakit;
use App\Models\PenyakitImage;
use Illuminate\Support\Facades\Storage;

class PenyakitService
{
    public function getDatabasePenyakit()
    {
        return Penyakit::with(['categories', 'images'])->get();
    }

    public function addPenyakitToDatabase(PenyakitRequest $request)
    {
        $penyakit = Penyakit::create([
            'title' => $request->title,
            'description' => $request->description,
            'penyebab_penyakit' => $request->penyebab_penyakit,
            'pengendalian' => $request->pengendalian,
            'penularan_penyakit' => $request->penularan_penyakit,
            'waktu_terjadi_serangan' => $request->waktu_terjadi_serangan,
            'background_image' => storeImage($request->background_image, 'penyakit/background'),
            'daerah_persebaran_image' => storeImage($request->daerah_persebaran_image, 'penyakit/persebaran')
        ]);

        $penyakit->categories()->attach($request->category_ids);

        if ($request->images) {
            foreach ($request->images as $i => $image) {
                PenyakitImage::create([
                    'image' => storeImage($image, 'penyakit/pencegahan'),
                    'description' => $request->image_descriptions[$i],
                    'penyakit_id' => $penyakit->id,
                ]);
            }
        }

        return $penyakit;
    }

    public function updatePenyakitFromDatabase(Penyakit $penyakit, PenyakitRequest $request)
    {
        if ($request->background_image) {
            $this->deleteImageIfExists($penyakit->background_image);
            $penyakit->background_image = storeImage($request->background_image, 'penyakit/background');
        }

        if ($request->daerah_persebaran_image) {
            $this->deleteImageIfExists($penyakit->daerah_persebaran_image);
            $penyakit->daerah_persebaran_image = storeImage($request->daerah_persebaran_image, 'penyakit/persebaran');
        }

        $penyakit->update([
            'title' => $request->title,
            'description' => $request->description,
            'penyebab_penyakit' => $request->penyebab_penyakit,
            'pengendalian' => $request->pengendalian,
            'penularan_penyakit' => $request->penularan_penyakit,
            'waktu_terjadi_serangan' => $request->waktu_terjadi_serangan
        ]);

        $penyakit->categories()->sync($request->category_ids);
        if ($request->images) {
            foreach ($penyakit->images as $image) {
                $image->delete();
            }

            foreach ($request->images as $i => $image) {
                PenyakitImage::create([
                    'image' => storeImage($image, 'penyakit/gejala-serangan'),
                    'description' => $request->image_descriptions[$i],
                    'penyakit_id' => $penyakit->id,
                ]);
            }
        }

        return $penyakit;
    }

    public function deletePenyakitFromDatabase(Penyakit $penyakit)
    {
        $penyakit->delete();
    }

    protected function deleteImageIfExists($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
