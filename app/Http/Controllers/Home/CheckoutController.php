<?php

namespace App\Http\Controllers\Home;

use App\Models\Market\Cart;
use App\Models\Market\Copan;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Home;
use App\Models\Market\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->with('items.product')->first();

        return view('app.checkout', compact('cart'));
    }

    public function applyDiscount(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'سبد خرید یافت نشد');
        }
        
        $copan = Copan::where('code', $request->code)->first();
        
        if (!$copan or !$copan->isValid()) {
            return redirect()->back()->with('error', 'کد تخفیف نامعتبر است');
        }
        
        $discountAmount = $copan->amount_type == 0 ? min(($cart->total_price * $copan->amount / 100), $copan->discount_ceiling) : min($copan->amount, $cart->total_price);
        
        $cart->update([
            'copan_id' => $copan->id,
            'discount_status' => 1,
            'total_off_price' => $discountAmount,
            'total_price' => $cart->total_price - $discountAmount
        ]);
        
        return redirect()->back()->with('success', 'کد تخفیف با موفقیت اعمال شد');
    }

    public function removeDiscount(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'سبد خرید یافت نشد');
        }

        $cart->update([
            'copan_id' => null,
            'discount_status' => 0,
            'total_off_price' => 0
        ]);

        return redirect()->back()->with('success', 'کد تخفیف با موفقیت حذف شد');
    }

    public function submit(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->with('items.product')->first();
        
        if (!$cart or $cart->items->count() == 0) {
            return redirect()->route('home');
        }
        
        $productsTotalDiscount = 0;
        foreach ($cart->items as $item) {
            $productsTotalDiscount += $item->product->discounted_price ? $item->product->price - $item->product->discounted_price : 0;
        }
        
        try {
            DB::beginTransaction();
            // dd($productsTotalDiscount);

            $order = Order::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'copan_id' => $cart->copan_id,
                'order_final_amount' => $cart->total_price - $cart->total_off_price,
                'order_discount_amount' => $productsTotalDiscount,
                'order_total_discount' => $cart->total_off_price + $productsTotalDiscount,
                'order_status' => 0,
                'payment_type' => 0,
                'payment_status' => 0,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_object' => json_encode($item->product),
                    'price' => $item->product->price,
                    'total_price' => $item->product->price,
                    'status' => 0
                ]);
            }
            $cart->update(['status' => 1]);
            DB::commit();
            return redirect()->route('app.home')->with('success', 'سفارش شما با موفقیت ثبت شد. محصولات خریداری شده در پنل کاربری قابل مشاهده و دانلود هستند.');

        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            redirect()->back()->with('error', 'خطایی پیش آمد');
        }
    }
}
