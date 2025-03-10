<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeBlogRequest;
use App\Http\Requests\Admin\Content\updateBlogRequest;
use App\Models\Content\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.content.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBlogRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = 1;
        Blog::create($inputs);
        return redirect()->route('admin.content.blog.index')->with('swal-success','بلاگ با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.content.blog.edit', compact('blog'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(updateBlogRequest $request, Blog $blog)
    {
        $inputs = $request->validated();

        $blog->update($inputs);

        return redirect()->route('admin.content.blog.index')->with('swal-success','بلاگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back()->with('swal-success','بلاگ با موفقیت موفقیت حذف شد');
    }
}
