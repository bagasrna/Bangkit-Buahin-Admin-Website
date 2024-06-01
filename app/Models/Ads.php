<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ads extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'ads';

    public function delete()
    {
        Storage::disk('public')->delete($this->image);
        parent::delete();
    }
}
