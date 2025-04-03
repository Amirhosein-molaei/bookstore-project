<?php

namespace App\Providers;

use App\Models\Market\Cart;
use App\Models\Content\Menu;
use App\Models\Setting\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Market\ProductCategory;
use Illuminate\Support\Facades\Request;
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
        Auth::loginUsingId(1);
        if (Request::is('admin/*')) {
            Paginator::useBootstrap(); 
        } else {
            Paginator::useTailwind();
        }


        View::composer('*', function ($view) {
            $setting = Setting::first();
            $categories = ProductCategory::with('subCategories')->get();
            $menus = Menu::with('subMenus')->get();

            $view->with(['setting' => $setting, 'categories' => $categories, 'menus' => $menus]);
        });


        View::composer('*', function($view){
            $cart = null;
            $cartItemCount = 0;
            $cartTotalPrice = 0;

            if (Auth::check()) {
                $cart = Cart::firstOrCreate(
                    ['user_id' => Auth::id(), 'status' => 0],
                    ['total_price' => 0, 'total_off_price' => 0, 'expired_at' => now()->addDays(10)]
                );
                $cartItemCount = $cart ? $cart->items()->count() : 0;
                $cartTotalPrice = $cart ? $cart->total_price : 0;
            }

            $view->with([
                'cart' => $cart,
                'cartItemCount' => $cartItemCount,
                'cartTotalPrice' => $cartTotalPrice
            ]);

        });
    }
}
