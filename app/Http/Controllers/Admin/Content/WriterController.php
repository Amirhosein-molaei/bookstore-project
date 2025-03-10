<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeWriterRequest;
use App\Http\Requests\Admin\Content\updateWriterRequest;
use App\Models\Content\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers = Writer::paginate(10);
        return view('admin.content.writer.index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeWriterRequest $request)
    {
        $inputs = $request->validated();
        Writer::create($inputs);
        
        return to_route('admin.content.writer.index')->with('swal-success', 'نویسنده با موفقیت ساخته شد');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writer $writer)
    {
        return view('admin.content.writer.edit', compact('writer'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(updateWriterRequest $request, Writer $writer)
    {
        $inputs = $request->validated();
        $writer->update($inputs);
        
        return to_route('admin.content.writer.index')->with('swal-success', 'نویسنده با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writer $writer)
    {
        $writer->delete();
        return to_route('admin.content.writer.index')->with('swal-success', 'نویسنده با موفقیت حذف شد');

    }
}
