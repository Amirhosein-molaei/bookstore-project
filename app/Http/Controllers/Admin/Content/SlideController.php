<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\Content\Slider;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use App\Http\Requests\Admin\Content\StoreSlideRequest;
use App\Http\Requests\Admin\Content\UpdateSlideRequest;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides=Slider::all();
        return view('admin.content.slide.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.slide.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlideRequest $request,ImageUploadService $imageUploadService)
    {
        $inputs=$request->all();

        if($request->hasFile('image'))
        {
          
            $result=$imageUploadService->uploadImage($request->file('image'));
            if ($result === false) {
                return back()->with('swal-error', 'خطا در آپلود فایل');
            }
            $inputs['image'] = $result;
        }
        Slider::create($inputs);
        return to_route('admin.content.slide.index')->with('swal-success', '  اسلاید با موفقیت ساخته شد');


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
    public function edit(Slider $slide)
    {
        return view('admin.content.slide.edit',compact('slide'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlideRequest $request,Slider $slide,ImageUploadService $imageUploadService)
    {
        $inputs=$request->all();
        if($request->hasFile('image'))
        {
            if(!empty($slide->image))
            {
                $imageUploadService->removeImage($slide->image);
            }
            $result=$imageUploadService->uploadImage($request->file('image'));
            if($result === false)
            {
                return back()->with('swal-error', 'خطا در آپلود فایل');

            }
            $inputs['image']=$result;
        }
        $slide->update($inputs);
        return to_route('admin.content.slide.index')->with('swal-success', ' اسلاید با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slide)
    {
        $slide->delete();
        return to_route('admin.content.slide.index')->with('swal-success', ' اسلاید با موفقیت حذف شد');

    }
}
