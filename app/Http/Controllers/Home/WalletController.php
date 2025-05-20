<?php

namespace App\Http\Controllers\Home;

use App\Models\User\Wallet;
use Illuminate\Support\Str;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Market\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function show()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $payments = Payment::where('user_id', $wallet->user_id)->whereIn('status', [2,3])->orderByDesc('created_at')->get();
        return view('app.profile.wallet', compact(['wallet', 'payments']));
    }


    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5000|max:10000000'
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();
        try {
            DB::beginTransaction();
            
            $wallet->balance += $request->input('amount');
            $wallet->save();

            Payment::create([
                'amount' => $request->amount,
                'user_id' => Auth::id(),
                'status' => 2,
                'gateway' => 'zarinPall',
                'transaction_id' => random_int(10000, 99999),
                'transaction_code' => Str::random()
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            return back()->with('error', 'مشکلی پیش آمد. لطفا مجددا تلاش کنید');
        }
        return view('app.payment-success', compact('wallet'));
    }

}
