<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Penyakit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'penyakits';

    public function categories()
    {
        return $this->belongsToMany(HamaCategory::class, 'penyakit_category_pivot', 'penyakit_id', 'penyakit_category_id');
    }

    public function images()
    {
        return $this->hasMany(PenyakitImage::class, 'penyakit_id');
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
