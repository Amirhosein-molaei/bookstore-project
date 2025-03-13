<?php

namespace App\Models\Content;

use App\Models\Market\Product;
use App\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writer extends Model
{
    use HasFactory, SoftDeletes, Sluggable, CascadeSoftDeletes;

    protected $guarded = ['id'];
    protected $cascadeDeletes = ['products'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
                'unique' => true,
                'separator' => '-',
            ]
        ];
    }
    
    public function favoritedByUsers()
    {
        return $this->morphToMany(User::class, 'favoriteable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
