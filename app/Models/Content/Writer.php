<?php

namespace App\Models\Content;

use App\Models\Market\Product;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function favoritedByUsers()
    {
        return $this->morphToMany(User::class, 'favoriteable');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
