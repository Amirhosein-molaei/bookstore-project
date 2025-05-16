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
use App\Http\Requests\Home\submitOrderRequest;
use App\Mail\orderDoneMail;
use App\Models\User\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->with('items.product')->first();
        
        $wallet = Wallet::where('user_id', Auth::id())->first();

        return view('app.checkout', compact('cart', 'wallet'));
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
            'total_price' => $cart->total_price + $cart->total_off_price,
            'total_off_price' => 0
        ]);

        return redirect()->back()->with('success', 'کد تخفیف با موفقیت حذف شد');
    }

    public function submit(submitOrderRequest $request)
    {
        $inputs = $request->validated();
        $cart = Cart::where('user_id', Auth::id())->where('status', 0)->with('items.product')->first();
        
        if (!$cart or $cart->items->count() == 0) {
            return redirect()->route('app.home');
        }
        
        if ($inputs['total_price'] != $cart->total_price) {
            return back()->with('error', 'عدم تطابق مبلغ!');
        }
        
        // check if wallet has enough money
        $wallet = Wallet::where('user_id', Auth::id())->first();
        if ($wallet->balance < $inputs['total_price'] and $inputs['payment_type'] == 0) {
            return back()->with('error', 'موجودی کیف پول کافی نمیباشد');
        }
        
        // sum of discount from products
        $productsTotalDiscount = 0;
        foreach ($cart->items as $item) {
            $productsTotalDiscount += $item->product->discounted_price ? $item->product->price - $item->product->discounted_price : 0;
        }
        
        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'copan_id' => $cart->copan_id,
                'order_final_amount' => $cart->total_price - $cart->total_off_price,
                'order_discount_amount' => $productsTotalDiscount,
                'order_total_discount' => $cart->total_off_price + $productsTotalDiscount,
                'order_status' => 1,
                'payment_type' => $inputs['payment_type'],
                'payment_status' => 1,
            ]);

            // withdraw from wallet
            if ($order->payment_type == 0) {
                $wallet->balance -= $order->order_final_amount;
                $wallet->save();
            }

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_object' => json_encode($item->product),
                    'price' => $item->product->price,
                    'total_price' => $item->product->price,
                    'status' => 0
                ]);

                $item->product->increment('sold_number');
            }

            $cart->update(['status' => 1]);
            DB::commit();
            
            Mail::to(Auth::user())->send(new orderDoneMail($order));

            return view('app.payment-success', compact('order'));

        } catch (\Throwable $th) {
            DB::rollBack();
            redirect()->back()->with('error', 'خطایی پیش آمد');
        }
    }
}
