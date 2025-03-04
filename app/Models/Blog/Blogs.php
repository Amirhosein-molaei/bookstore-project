<?php

namespace App\Models\Blog;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table= "blogs";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
