<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
    public function faq()
    {
        $faqs = Faq::all();
        return view("app.faq", compact("faqs"));
    }

    public function aboutUs()
    {
        return view('app.about-us');
    }
}
