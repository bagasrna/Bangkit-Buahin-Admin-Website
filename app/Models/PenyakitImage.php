<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PenyakitImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function delete()
    {
        Storage::disk('public')->delete($this->image);
        parent::delete();
    }

    public function hama()
    {
        return $this->belongsTo(Hama::class, 'hama_id');
    }
}
