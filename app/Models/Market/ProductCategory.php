<?php

namespace App\Models\Market;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
   use SoftDeletes;
    use Sluggable;

    protected $guarded = ['id'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true ,
                'separator' => '-', 
               
            ]
        ];
    }
   

  
}

