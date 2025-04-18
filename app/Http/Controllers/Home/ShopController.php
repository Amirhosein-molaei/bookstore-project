<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('app.shop', compact('products'));
    }
    public function availableProduct()
    {
        $products = Product::where('marketable', 0)->get();
        return view('app.shop', compact('products'));
    }
    public function withPictureProduct()
    {
        $products = Product::where('marketable', 0)
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->get();
        return view('app.shop', compact('products'));
    }
    public function mostExpensiveProduct()
    {
        $products = Product::where('marketable', 0)
            ->orderByRaw('COALESCE(discounted_price, price) DESC')
            ->get();
        return view('app.shop', compact('products'));
    }
    public function cheapestProduct()
    {
        $products = Product::where('marketable', 0)
        ->orderByRaw('COALESCE(discounted_price, price) ASC')
        ->get();        return view('app.shop', compact('products'));
    }
}
