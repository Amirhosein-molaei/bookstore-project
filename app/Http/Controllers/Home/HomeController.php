<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Menu;
use App\Models\Content\Slider;
use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Market\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status',1)->orderBy('position')->get();
      
        View::composer('app.layouts.*', function($view){
            $setting = Setting::first();
            $categories = ProductCategory::with('subCategories')->get();
            $menus = Menu::with('subMenus')->get();

            $view->with(['setting' => $setting, 'categories' => $categories, 'menus' => $menus]);
        });
      
        return view('app.home',compact('sliders'));
    }
}
