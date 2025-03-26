<?php

namespace App\Http\Controllers\Home;

use App\Models\Content\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeFaqController extends Controller
{
    public function index()
    {
     $faqs = Faq::all();
     return view("app.faq", compact("faqs"));
    }
}
