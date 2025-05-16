<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use App\Models\User\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{

    public function show()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        return view('app.profile.wallet', compact('wallet'));
    }


    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:5000|max:10000000'
        ]);

        $wallet = Wallet::where('user_id', Auth::id())->first();
        $wallet->balance += $request->input('amount');
        $wallet->save();

        return view('app.payment-success', compact('wallet'));
    }

}
