<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blogs;
use Illuminate\Http\Request;
use function Sodium\increment;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Blogs $blog)
    {
        $blogs=Blogs::latest()->paginate(10);
        $blog->increment('view_count');
        return view('admin.blogs.index',compact('blogs','blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);
        Blogs::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>auth()->id(),

        ]);
        return redirect()->route('admin.content.blogs.index')->with('swal-success','با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogs $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blog)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.content.blogs.index')->with('swal-success','با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blog)
    {
        $blog->delete();
        return redirect()->back()->with('swal-success','با موفقیت حذف شد');
    }
}
