<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Home\StoreCommentRequest;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $relatedProducts = Product::where('product_category_id', $product->category->id)->whereNot('id', $product->id)->limit(10)->get();
        $commentCount = $product->comments()->where('status', 2)->count();
        $productFiles = $product->files()->get();
        $comments = $product->comments()->whereNull('parent_id')->where('status', 2)->orderByDesc('created_at')->limit(10)->get();
        $commentAnswers = $product->comments()->whereNotNull('parent_id')->where('status', 2)->orderByDesc('created_at')->limit(3)->get();
        return view('app.product', compact('product', 'relatedProducts', 'commentCount', 'productFiles', 'comments', 'commentAnswers'));
    }

    public function sendComment(StoreCommentRequest $request, Product $product)
    {
        $user = Auth::user();
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['parent_id'] = null;
        $inputs['commentable_type'] = 'App\Models\Market\Product';
        $inputs['commentable_id'] = $product->id;
        $inputs['status'] = 0;

        $comment = Comment::create($inputs);
        return redirect()->back()->with('swal-success', '  کامنت با موفقیت ثبت شد و پس از تایید نمایش داده میشود.');
    }

    public function likeComment(Comment $comment)
    {
        $user = Auth::user();

        $existingLike = $comment->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            if ($existingLike->status == 1) {
                return redirect()->back()->with('swal-error', 'شما قبلاً این کامنت را لایک کرده‌اید.');
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

    public function dislikeComment(Comment $comment)
    {
        $user = Auth::user(); // کاربر فعلی

        // چک کردن اینکه آیا کاربر قبلاً این کامنت رو لایک یا دیس‌لایک کرده
        $existingLike = $comment->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            if ($existingLike->status == 2) {
                return redirect()->back()->with('swal-error', 'شما قبلاً این کامنت را دیس‌لایک کرده‌اید.');
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

    public function answerComment(Request $request, Product $product)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('swal-error', 'لطفا ابتدا وارد شوید');
        }

        $comment = Comment::findOrFail($request->comment_id);
        if ($comment->parent_id != null) {
            return redirect()->back()->with('swal-error', 'شما تنها مجاز به پاسخگویی کامنت اصلی هستید.');
        }

        $request->validate([
            'body' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
        ]);

        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_type'] = 'App\Models\Market\Product';
        $inputs['commentable_id'] = $product->id;
        $inputs['status'] = 0;

        Comment::create($inputs);
        return redirect()->back()->with('swal-success', 'کامنت با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد .');
    }
}
