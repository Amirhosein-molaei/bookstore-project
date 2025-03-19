<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $logo = Setting::first();
        return view('app.home',compact('logo'));
    }
}
