<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags =Tag::latest()->paginate(10);
        return view('admin.content.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);
        Tag::create([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.content.tag.index')->with('swal-success','تگ مورد نظر شما ذخیره شد');
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
    public function edit(Tag $tag)
    {
        return view('admin.content.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $tag->update([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.content.tag.index')->with('swal-success','تگ مورد نظر شما ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $tag=Tag::findOrFail($id);
      $tag->destroy($id);
      return redirect()->back()->with('swal-success', ' تگ با موفقیت حذف شد');
    }
}
