<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DetectionHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detection_histories';

    public function images()
    {
        return $this->hasMany(PenyakitImage::class, 'penyakit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
