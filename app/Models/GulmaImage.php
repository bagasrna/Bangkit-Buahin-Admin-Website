<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GulmaImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function delete()
    {
        Storage::disk('public')->delete($this->image);
        parent::delete();
    }

    public function gulma()
    {
        return $this->belongsTo(Gulma::class, 'gulma_id');
    }
}
