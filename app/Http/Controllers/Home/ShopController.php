<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $categorySlug = $request->query('category');
        
        $minPrice = $request->min_price ?? 0;
        $maxPrice = $request->max_price ?? PHP_INT_MAX;
    
        // start of query builder (based on builder design pattern)
        $query = Product::query();

        //filter by category
        if ($categorySlug != null) {
            $category = ProductCategory::where('slug', $categorySlug)->first();

            // if a main category is requested all of it's children books should be found to and if it's a child 
            // category we'll simply return it's books
            if ($category->parent == null and $category->subCategories()->count() > 0) {
                $categoryIds = $category->subCategories()->pluck(column: 'id')->toArray();
                $categoryIds[] = $category->id;

                $query->whereIn('product_category_id', $categoryIds);
                
            } else {
                $query->where('product_category_id', $category->id);
            }
            
        }

        // filter by price
        $query->where(function ($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('price', [$minPrice, $maxPrice])
              ->orWhereBetween('discounted_price', [$minPrice, $maxPrice]);
        });  
  
        $sort = $filter ?? 'all';
  
        // top nav filter (sorting match books)
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

        $products = $query->paginate(12)->withQueryString();
        return view('app.shop', compact(['products','sort']));
    }
}    
