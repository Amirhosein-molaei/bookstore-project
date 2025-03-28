<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Content\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $mosteSelledProducts = Product::select('*')
            ->withCount('cartItems')
            ->whereHas('cartItems.cart', function ($query) {
                $query->where('status', 1); // فقط سبدهای خریدی که تکمیل شده‌اند
            })
            ->orderByDesc('cart_items_count')
            ->limit(10)
            ->get();

        return view('app.home', compact('mosteSelledProducts'));
    }
}
