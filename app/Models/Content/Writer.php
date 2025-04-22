<?php

namespace App\Models\Content;

use App\Models\User\User;
use App\Models\User\Favorite;
use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writer extends Model
{
    use HasFactory, SoftDeletes, Sluggable, CascadeSoftDeletes;

    protected $guarded = ['id'];
    protected $cascadeDeletes = ['products'];
    protected $softCascade = ['favorites'];

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
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }
}
