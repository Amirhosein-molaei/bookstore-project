<?php

namespace App\Models\Content;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }
    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

}
