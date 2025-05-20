<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Writer;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        $writers = Writer::all();
        
        return view('app.writers.index',compact('writers'));

    }
   
    public function writerBooks($writerSlug)  {
        $writer = Writer::where('slug', $writerSlug)->first();
        $products = $writer->products()->get();

        return view('app.writers.writer-books', compact(['products', 'writer']));
    }


}
