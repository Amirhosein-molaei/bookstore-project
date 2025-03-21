<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Menu;
use App\Models\Market\ProductCategory;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $setting = Setting::first();
        // $categories =ProductCategory::where('parent_id',null)->get();
        // $menus=Menu::where('parent_id', null)->get();
        // foreach ($menus as $menu) {
        //     $submenus = Menu::where('parent_id', $menu->id)->get();
        // }
        return view('app.home');
    }
}
