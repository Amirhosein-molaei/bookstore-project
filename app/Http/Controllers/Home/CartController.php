<?php

namespace App\Http\Controllers\Home;

use App\Models\Market\Cart;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use App\Models\Market\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function addToCart(Request $request,Product $product)
    {
        $user = auth()->user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 0],
            ['total_price' => 0, 'total_off_price' => 0, 'expired_at' => now()->addDays(10)]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
        if($cartItem)
        {
            return back()->with('swal-error','محصول در سبد خرید شما وجود دارد.');
        }
        else{
            if($product->marketable)
            {
                return back()->with('swal-error','محصول قابل فروش نیست.');

            }
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->discounted_price ? $product->discounted_price : $product->price,
            ]);
        }
        
        $totalPrice = CartItem::where('cart_id', $cart->id)->sum('price');

        $cart->update(['total_price' => $totalPrice]);

        return redirect()->back()->with('swal-success', 'محصول با موفقیت به سبد خرید اضافه شد.');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
