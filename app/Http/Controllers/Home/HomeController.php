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
      ->limit(10)
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
        return redirect()->back()->with('swal-success', ' کامنت با موفقیت ثبت شد');
    }

    public function likeComment(Comment $comment)
    {
        $likes=$comment->increment('likes');
        return redirect()->back()->with('swal-success', ' کامنت با موفقیت لایک شد');

    }

    public function dislikeComment(Comment $comment)
    {
        $likes=$comment->decrement('likes');
        return redirect()->back()->with('swal-success', ' کامنت با موفقیت دیس لایک شد');
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
