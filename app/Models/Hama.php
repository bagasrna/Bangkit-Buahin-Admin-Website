<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hama extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsToMany(HamaCategory::class, 'hama_category_pivot', 'hama_id', 'hama_category_id');
    }

    public function images()
    {
        return $this->hasMany(HamaImage::class, 'hama_id');
    }

    public function delete()
    {
        $this->categories()->detach();

        if ($this->background_image !== null) {
            Storage::disk('public')->delete($this->background_image);
        }
    
        if ($this->daerah_persebaran_image !== null) {
            Storage::disk('public')->delete($this->daerah_persebaran_image);
        }
    
        foreach ($this->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        parent::delete();
    }
}
