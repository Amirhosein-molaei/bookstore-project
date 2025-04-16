<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\storeBlogRequest;
use App\Http\Requests\Admin\Content\updateBlogRequest;
use App\Models\Content\Blog;
use App\Services\ImageUploadService;

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
    public function store(storeBlogRequest $request ,ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = 1;

        if($request->hasFile('image'))
        {

            $result=$imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }
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
    public function update(updateBlogRequest $request, Blog $blog, ImageUploadService $imageUploadService)
    {
        $inputs = $request->validated();

        if ($request->hasFile('image')) {

            if (!empty($blog->image)) {
                $imageUploadService->removeImage($blog->image);
            }

            $result = $imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }

        $blog->update($inputs);

        return redirect()->route('admin.content.blog.index')->with('swal-success','بلاگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, ImageUploadService $imageUploadService)
    {
        if ($blog->image != null) {
            $imageUploadService->removeImage($blog->image);
        }

        $blog->delete();
        return redirect()->back()->with('swal-success','بلاگ با موفقیت موفقیت حذف شد');
    }
}
