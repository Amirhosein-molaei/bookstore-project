<?php

namespace App\Http\Controllers\Home;

use App\Models\Market\Cart;
use Illuminate\Http\Request;
use App\Models\Market\CartItem;
use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->with('items.product')->first();

        $productsTotalPrice = 0;
        $productsTotalDiscount = 0;
        foreach ($cart->items as $item) {
            $productsTotalPrice += $item->product->price;
            $productsTotalDiscount += $item->product->discounted_price ? $item->product->price - $item->product->discounted_price : 0;
        }

        return view('app.cart', compact('cart', 'productsTotalPrice', 'productsTotalDiscount'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 0],
            ['total_price' => 0, 'total_off_price' => 0, 'expired_at' => now()->addDays(10)]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
        if ($cartItem) {
            return back()->with('error', 'محصول در سبد خرید شما وجود دارد.');
        } else {
            if ($product->marketable) {
                return back()->with('error', 'محصول قابل فروش نیست.');
            }
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'price' => $product->discounted_price ? $product->discounted_price : $product->price,
            ]);
        }

        $totalPrice = CartItem::where('cart_id', $cart->id)->sum('price');
        
        $cart->update(['total_price' => $totalPrice]);
        
        return redirect()->back()->with('success', 'کتاب به سبد خرید شما اضافه شد.');
    }
    
    public function removeFromCart(Request $request, CartItem $cartItem)
    {
        $cartItem = CartItem::findOrFail($cartItem->id);
        $cart = $cartItem->cart;
        $cartItem->delete();

        $cart->total_price = CartItem::where('cart_id', $cart->id)->sum('price');
        $cart->save();
        
        return redirect()->back()->with('error', 'کتاب از سبد خرید شما حذف شد');
    }
}
