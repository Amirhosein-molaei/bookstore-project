<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Slider;
use App\Http\Controllers\Controller;
use App\Models\Content\Publisher;
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

    public function publisher(Publisher $publisher)
    {
        $textualHotDeals = $publisher->products()->where('hot_deal', 1)->where('type', 0)->get();
        $audioHotDeals = $publisher->products()->where('hot_deal', 1)->where('type', 1)->get();

        $mostSelledProducts = $publisher->products()
            ->withCount('cartItems')
            ->whereHas('cartItems.cart', function ($query) {
                $query->where('status', 1); 
            })
            ->orderByDesc('cart_items_count')
            ->limit(10)
            ->get();

        $mostViewedProducts = $publisher->products()->mostViewed()->get();

        $newProducts = $publisher->products()->orderByDesc('created_at')->take(10)->get();

        return view('app.publisher', compact(['publisher', 'textualHotDeals', 'audioHotDeals', 'mostSelledProducts', 'mostViewedProducts', 'newProducts']));
    }
}
