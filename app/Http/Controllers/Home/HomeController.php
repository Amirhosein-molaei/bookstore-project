<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StoreCommentRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $mosteSelledProducts=Product::select('*')
      ->withCount('cartItems') 
      ->whereHas('cartItems.cart', function ($query) {
          $query->where('status', 1); // فقط سبدهای خریدی که تکمیل شده‌اند
      })
      ->orderByDesc('cart_items_count')
      ->limit(8)
      ->get();

        return view('app.home',compact('mosteSelledProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->increment('view_count');
        $relatedProducts=Product::where('product_category_id',$product->category->id)->whereNot('id',$product->id)->limit(10)->get();
        $commentCount = $product->comments()->where('status',2)->count();
        $productFiles=$product->files()->get();
        $comments=$product->comments()->whereNull('parent_id')->where('status',2)->orderByDesc('created_at')->limit(10)->get();
        $commentAnswers=$product->comments()->whereNotNull('parent_id')->where('status',2)->orderByDesc('created_at')->limit(3)->get();
        return view('app.product',compact('product','relatedProducts','commentCount','productFiles','comments','commentAnswers'));

    }

    public function sendComment(StoreCommentRequest $request, Product $product)
    {
        $user=auth()->user();
        $inputs=$request->all();
        $inputs['user_id']=$user->id;
        $inputs['parent_id']=null;
        $inputs['commentable_type']='App\Models\Market\Product';
        $inputs['commentable_id']=$product->id;
        $inputs['status']=0;

        $comment=Comment::create($inputs);
        return redirect()->back()->with('swal-success', '  کامنت با موفقیت ثبت شد و پس از تایید نمایش داده میشود.');
    }

    public function likeComment(Comment $comment)
    {
        $user = auth()->user();   
    
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
    
        return redirect()->back()->with('swal-success', 'کامنت با موفقیت لایک شد');
    }
    
    public function dislikeComment(Comment $comment)
    {
        $user = auth()->user(); // کاربر فعلی
    
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
    
        return redirect()->back()->with('swal-success', 'کامنت با موفقیت دیس‌لایک شد');
    }

    public function answerComment(Request $request, Product $product)
    {
        $user = auth()->user();
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
