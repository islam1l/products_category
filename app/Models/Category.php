<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
protected $guarded=[];
    // Define self-referential relationship for parent category
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define self-referential relationship for subcategories
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
