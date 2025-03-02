<?php

namespace App\Models\Market;

// use Cocur\Slugify\Slugify;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Cviebrock\EloquentSluggable\Services\SlugService;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use SoftDeletes,CascadeSoftDeletes;
    use Sluggable;

    protected $cascadeDeletes = ['subCategories'];

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true ,
                'unique' => true,
                'separator' => '-', 
               
            ]
        ];
    }
   

  
}

