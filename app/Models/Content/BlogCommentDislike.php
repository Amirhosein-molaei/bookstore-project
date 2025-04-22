<?php

namespace App\Models\Content;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogCommentDislike extends Model
{
    public function comment(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
