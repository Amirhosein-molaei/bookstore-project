<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index($filter = null)
    {
        $query = Product::query(); // ابتدا تمام محصولات رو می‌گیریم
        $sort = $filter ?? 'all';
        if ($filter === 'available') {
            $query->where('marketable', 0);
        } elseif ($filter === 'with-picture') {
            $query->where('marketable', 0)
                ->whereNotNull('image')
                ->where('image', '!=', '');
        } elseif ($filter === 'most-expensive') {
            $query->where('marketable', 0)
                ->orderByRaw('COALESCE(discounted_price, price) DESC');
        } elseif ($filter === 'cheapest') {
            $query->where('marketable', 0)
                ->orderByRaw('COALESCE(discounted_price, price) ASC');
        }
    
        $products = $query->paginate(12);       
        return view('app.shop', compact('products','sort'));
    }
}    
