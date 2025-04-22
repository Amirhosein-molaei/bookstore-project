<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Blog;
use App\Models\Content\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    // ذخیره نظر جدید
    public function store(Blog $blog, Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = $blog->comments()->create([
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'نظر شما با موفقیت ثبت شد.');
    }

    // لایک کردن نظر
    public function like(BlogComment $comment)
    {
        if ($comment->likes()->where('user_id', Auth::id())->exists()) {
            return back()->with('warning', 'شما قبلاً این نظر را لایک کرده‌اید.');
        }

        $comment->likes()->create(['user_id' => Auth::id()]);
        $comment->increment('likes_count');

        return back()->with('success', 'نظر مورد پسند شما قرار گرفت.');
    }

    // دیسلایک کردن نظر
    public function dislike(BlogComment $comment)
    {
        if ($comment->dislikes()->where('user_id', Auth::id())->exists()) {
            return back()->with('warning', 'شما قبلاً این نظر را دیسلایک کرده‌اید.');
        }

        $comment->dislikes()->create(['user_id' => Auth::id()]);
        $comment->increment('dislikes_count');

        return back()->with('success', 'نظر مورد پسند شما نبود.');
    }
}
