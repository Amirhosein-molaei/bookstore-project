<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Blog;
use App\Models\Content\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $validated['body'];
        $comment->user_id = Auth::id();
        $comment->status = 1; // وضعیت تایید شده

        $blog->comments()->save($comment);

        return back()->with('success', 'دیدگاه شما با موفقیت ثبت شد.');
    }

    public function like(Comment $comment)
    {
        $comment->increment('likes');
        return back();
    }

    public function dislike(Comment $comment)
    {
        $comment->increment('dislikes');
        return back();
    }

    public function reply(Request $request, Blog $blog, Comment $comment)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $reply = new Comment();
        $reply->body = $validated['body'];
        $reply->user_id = Auth::id();
        $reply->parent_id = $comment->id;
        $reply->status = 1; // وضعیت تایید شده

        $blog->comments()->save($reply);

        return back()->with('success', 'پاسخ شما با موفقیت ثبت شد.');
    }
    }
