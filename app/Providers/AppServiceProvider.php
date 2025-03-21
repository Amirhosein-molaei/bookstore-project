<?php

namespace App\Providers;

use App\Models\Content\Menu;
use App\Models\Market\ProductCategory;
use App\Models\Setting\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function($view){
            $setting = Setting::first();
            $categories = ProductCategory::with('subCategories')->get();
            $menus = Menu::with('subMenus')->get();

            $view->with(['setting' => $setting, 'categories' => $categories, 'menus' => $menus]);
        });
        Auth::loginUsingId(1);
        Paginator::useBootstrap();
    }
}
