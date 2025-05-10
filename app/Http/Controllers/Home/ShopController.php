<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $filter = null, $categorySlug = null)
    {
        $minPrice = $request->min_price ?? 0;
        $maxPrice = $request->max_price ?? PHP_INT_MAX;
        
        if ($categorySlug != null) {

            $category = ProductCategory::where('slug', $categorySlug)->first();
            
            if ($category->parent == null and $category->subCategories()->count() > 0) {
                
                $categoryIds = $category->subCategories()->pluck(column: 'id')->toArray();
                $products = Product::whereIn('product_category_id', $categoryIds)
                    ->orWhere('product_category_id', $category->id)
                    ->whereBetween('price', [$minPrice, $maxPrice])
                    ->orWhereBetween('discounted_price', [$minPrice, $maxPrice])
                    ->paginate(12)
                    ->withQueryString();

            } else {

                $products = $category->products()
                    ->whereBetween('price', [$minPrice, $maxPrice])
                    ->orWhereBetween('discounted_price', [$minPrice, $maxPrice])
                    ->paginate(12)
                    ->withQueryString();
            }
            
        } else {
            
            $products = Product::whereBetween('price', [$minPrice, $maxPrice])
                ->orWhereBetween('discounted_price', [$minPrice, $maxPrice])
                ->paginate(12)
                ->withQueryString();
        }
  
        $sort = $filter ?? 'all';
  
        if ($filter === 'available') {
            $products->where('marketable', 0);
          
        } elseif ($filter === 'with-picture') {
            $products->where('marketable', 0)
                ->whereNotNull('image')
                ->where('image', '!=', '');
          
        } elseif ($filter === 'most-expensive') {
            $products->where('marketable', 0)
                ->orderByRaw('COALESCE(discounted_price, price) DESC');
          
        } elseif ($filter === 'cheapest') {
            $products->where('marketable', 0)
                ->orderByRaw('COALESCE(discounted_price, price) ASC');
        }
        
        return view('app.shop', compact(['products','sort']));
    }
}    
