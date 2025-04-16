<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Slider;
use App\Http\Controllers\Controller;
use App\Models\Market\Product;

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

        $sliders = Slider::where('status', 1)->orderBy('position')->get();
        $mostViewProducts = Product::mostViewed()->get();

        $hotDeals = Product::where('hot_deal', 1)
            ->where('status', 0)->where('marketable', 0)->limit(10)->get();

        $suggesteds = Product::where('suggested_count', '>',  1)
            ->where('status', 0)->where('marketable', 0)
            ->orderByDesc('suggested_count')->limit(10)->get();

        return view('app.home', compact(['sliders', 'mosteSelledProducts', 'hotDeals', 'suggesteds','mostViewProducts']));
    }
}
