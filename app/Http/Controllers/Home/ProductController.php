<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Home\StoreCommentRequest;
use App\Models\Market\Order;
use App\Models\User\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use ZipArchive;

class ProductController extends Controller
{
    public function show($productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();
        $product->increment('view_count');
        $relatedProducts = Product::where('product_category_id', $product->category->id)->whereNot('id', $product->id)->limit(10)->get();

        $commentCount = $product->comments()->where('status', 2)->count();
        $productFiles = $product->files()->get();

        $comments = $product->comments()->whereNull('parent_id')->where('status', 2)->orderByDesc('created_at')->paginate(10);

        $commentAnswers = $product->comments()->whereNotNull('parent_id')->where('status', 2)->orderByDesc('created_at')->limit(3)->get();

        $this->addToRecentlyViewedProducts($product->id);

        $recentlyViewds = Product::whereIn('id', $this->getRecentlyViewedProducts())->get();

        return view('app.product', compact(['product', 'relatedProducts', 'commentCount', 'productFiles', 'comments', 'commentAnswers', 'recentlyViewds']));
    }

    public function addToRecentlyViewedProducts($productId)
    {
        $recentProducts = session()->get('recently_viewed_products', []);

        if (!in_array($productId, $recentProducts)) {
            $recentProducts[] = $productId;
        }

        session()->put('recently_viewed_products', $recentProducts);
    }

    public function getRecentlyViewedProducts()
    {
        $products = session()->get('recently_viewed_products', []);
        return array_slice($products, -10);
    }

    public function download(Request $request, Product $product)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }

        $user = User::findOrFail(Auth::id());

        // for changing downloaded status and adding download_date to order 
        $order = $user->orders()->whereHas('orderItems', function($query) use ($product){
            $query->where('product_id', $product->id);
        })->first();

        if (!$user->hasPurchasedProduct($product->id)) {
            abort(404);
        }

        $files = $product->files()->get();

        // if product has more than 1 file we'll make a zip file anf put all files inside it and if it doesn't 
        // we'll simply return the file as a force-dowanload response
        
        if ($files->count() > 1) {

            $zipFileName =  str_replace(' ', '_', $product->title) . '.zip';
            $zipPath = storage_path('app/' . $zipFileName);

            // making zip file proccess
            $zip = new ZipArchive;
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

                foreach ($files as $file) {
                    if (Storage::exists($file->path)) {
                        $zip->addFile(  storage_path('app/private/' . $file->path), $file->name);
                    }
                }
                $zip->close();

            } else {
                return back()->with('error', 'خطا در دانلود فایل');
            }

            if (!$order->downloaded) {
                $order->downloaded = 1;
                $order->download_date = now();
                $order->save();
            }
            
            return response()->download($zipPath)->deleteFileAfterSend();

        } else {
            if (Storage::exists($files[0]->path)) {
                if (!$order->downloaded) {
                    $order->downloaded = 1;
                    $order->download_date = now();
                    $order->save();
                }

                return response()->download(storage_path('app/private/' . $files[0]->path), $files[0]->name);
            } 
        }

    }

    public function sendComment(StoreCommentRequest $request, Product $product)
    {
        $user = User::find(Auth::id());
        $inputs = $request->validated();
        $inputs['user_id'] = $user->id;
        $inputs['parent_id'] = null;
        $inputs['commentable_type'] = 'App\Models\Market\Product';
        $inputs['commentable_id'] = $product->id;
        $inputs['status'] = 0;
        
        //prevent user from rating again
        if ($product->comments()->where('user_id', Auth::id())->where('rate', '>', 0)->exists()) {
            $inputs['rate'] = 0;
        }
        
        $inputs['has_bought'] = $user->hasPurchasedProduct($product->id) ? 1 : 0;
        
        $comment = Comment::create($inputs);

        if ($inputs['has_bought'] == 1 and $inputs['suggested'] == 1 and !$user->hasSuggestedProduct($product)) {
            $product->increment('suggested_count');
        }

        return redirect()->back()->with('success', 'دیدگاه شما ثبت شد و پس از تایید نمایش داده میشود.');
    }

    public function likeComment(Comment $comment)
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

    public function dislikeComment(Comment $comment)
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

    public function answerComment(Request $request, Product $product)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'لطفا ابتدا وارد شوید');
        }

        $comment = Comment::findOrFail($request->comment_id);

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
        return redirect()->back()->with('success', 'کامنت با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد .');
    }
}
