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
        $comment->status = 1; // seen (not approved yet)

        $blog->comments()->save($comment);

        return back()->with('success', 'دیدگاه شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.');
    }

    public function like(Comment $comment)
    {
        $user = Auth::user();

        $existingLike = $comment->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            if ($existingLike->status == 1) {
                return redirect()->back()->with('error', 'شما قبلاً این کامنت را لایک کرده‌اید.');
            } elseif ($existingLike->status == 2) {
                $existingLike->delete();
                $comment->decrement('dislikes');
            }
        }

        $comment->likes()->create([
            'user_id' => $user->id,
            'status' => 1,
        ]);
        $comment->increment('likes');

        return redirect()->back();
    }

    public function dislike(Comment $comment)
    {
        $user = Auth::user(); // کاربر فعلی

        // چک کردن اینکه آیا کاربر قبلاً این کامنت رو لایک یا دیس‌لایک کرده
        $existingLike = $comment->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            if ($existingLike->status == 2) {
                return redirect()->back()->with('error', 'شما قبلاً این کامنت را دیس‌لایک کرده‌اید.');
            } elseif ($existingLike->status == 1) {
                // اگه قبلاً لایک کرده، لایک رو حذف کن و دیس‌لایک کن
                $existingLike->delete();
                $comment->decrement('likes');
            }
        }

        $comment->likes()->create([
            'user_id' => $user->id,
            'status' => 2,
        ]);
        $comment->increment('dislikes');

        return redirect()->back();
    }

}
