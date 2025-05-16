<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Slider;
use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Blog;
use App\Models\Content\Publisher;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        Auth::loginUsingId(6);
        $mosteSelledProducts = Product::where('sold_number', '>', 0)->orderByDesc('sold_number')->limit(10)->get();

        $sliders = Slider::where('status', 1)->orderBy('position')->get();

        $mostViewProducts = Product::mostViewed()->get();

        $banners = Banner::where('is_selected', 1)->limit(2)->get();

        $hotDeals = Product::where('hot_deal', 1)
            ->where('status', 0)->where('marketable', 0)->limit(10)->get();

        $suggesteds = Product::where('suggested_count', '>',  0)
            ->where('status', 0)->where('marketable', 0)
            ->orderByDesc('rate')->limit(10)->get();

        $latestBlogs = Blog::orderByDesc('created_at')->limit(8)->get();

        $latestProducts = Product::latest()->limit(8)->get();

        return view('app.home', compact(['sliders', 'banners', 'mosteSelledProducts', 'hotDeals', 'latestBlogs', 'suggesteds','mostViewProducts', 'latestProducts']));
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

    public function search()
    {
        $search = request('search');
        if ($search != '') {
            $matchProducts = Product::where('title', 'like', "%{$search}%")->get();
            $matchBlogs = Blog::where('title', 'like', "%{$search}%")->get();
            return view('app.search-result', compact(['matchProducts', 'matchBlogs', 'search']));
        } else {
            return view('app.home');
        }

    }
}
