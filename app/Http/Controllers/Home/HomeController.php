<?php

namespace App\Http\Controllers\Home;
  
use App\Models\Content\Menu;
use App\Models\Content\Slider;
use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\View;
use App\Models\Market\ProductCategory;

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
      
      $sliders = Slider::where('status',1)->orderBy('position')->get();
      
        View::composer('app.layouts.*', function($view){
            $setting = Setting::first();
            $categories = ProductCategory::with('subCategories')->get();
            $menus = Menu::with('subMenus')->get();

            $view->with(['setting' => $setting, 'categories' => $categories, 'menus' => $menus]);
        });
      
        return view('app.home',compact('sliders', 'mosteSelledProducts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('app.product',compact('product'));
    }
}
