<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\Content\Publisher;
use App\Models\Content\Tag;
use App\Models\Content\Writer;
use App\Models\User\Favorite;
use App\Models\User\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
                'unique' => true,
                'separator' => '-',
            ]
        ];
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeMostViewed($query)
    {
        return $query->orderBy('view_count', 'desc');
    }
    
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function isFavorited()
    {
        return Favorite::where('user_id', Auth::id())
            ->where('favoriteable_id', $this->id)
            ->where('favoriteable_type', Product::class)->exists();
    }
}
