<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function favoritedByUsers()
    {
        return $this->morphToMany(User::class, 'favoriteable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}
