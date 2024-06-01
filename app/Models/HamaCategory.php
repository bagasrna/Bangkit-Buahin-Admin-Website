<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HamaCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->belongsToMany(Hama::class, 'hama_category_pivot', 'hama_category_id', 'hama_id');
    }

    public function children()
    {
        return $this->hasMany(HamaCategory::class, 'parent_id', 'id');
    }

    // Fungsi rekursif untuk mendapatkan semua subkategori
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Fungsi rekursif untuk mendapatkan semua subkategori dan sub-subkategori
    public function getAllChildrenCategories()
    {
        return $this->allChildren()->with('allChildren');
    }

    // Relasi untuk mendapatkan kategori induk dari kategori
    public function parent()
    {
        return $this->belongsTo(HamaCategory::class, 'parent_id', 'id');
    }

    public function allParents()
    {
        return $this->parent ? $this->parent->allParents()->prepend($this->parent) : collect([$this]);
    }
}
