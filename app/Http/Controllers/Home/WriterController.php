<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        $writers = Writer::all();
        
        return view('app.writers.index',compact('writers'));

    }
   
     


}
