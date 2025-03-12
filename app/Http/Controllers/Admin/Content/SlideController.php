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
        $leftTopSlide=Slider::where('position','2')->first();
        $leftDownSlide=Slider::where('position','3')->first();

        if($leftTopSlide && $inputs['position'] == '2')
        {
            return to_route('admin.content.slide.index')->with('swal-error', 'اسلاید با موقعیت بالا سمت چپ وجود دارد لطفا یا آن را حذف کرده و دوباره اقدام به ساخت نمایید یا همان را ویرایش کنید.');

        }
        if($leftDownSlide && $inputs['position'] == '3')
        {
            return to_route('admin.content.slide.index')->with('swal-error', 'اسلاید با موقعیت پایین سمت چپ وجود دارد لطفا یا آن را حذف کرده و دوباره اقدام به ساخت نمایید یا همان را ویرایش کنید.');
        }

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

        $leftTopSlide=Slider::where('position','2')->first();
        $leftDownSlide=Slider::where('position','3')->first();


        if ($request['position'] == '2' && $leftTopSlide && $leftTopSlide->id != $slide->id)
        {
                return to_route('admin.content.slide.index')->with('swal-error', 'اسلاید با موقعیت  سمت چپ بالا وجود دارد لطفا یا آن را حذف کرده و دوباره اقدام به ساخت نمایید یا همان را ویرایش کنید.');
        }
        if ($request['position'] == '3' && $leftDownSlide && $leftDownSlide->id != $slide->id)
        {  
                return to_route('admin.content.slide.index')->with('swal-error', 'اسلاید با موقعیت  سمت چپ پایین وجود دارد لطفا یا آن را حذف کرده و دوباره اقدام به ساخت نمایید یا همان را ویرایش کنید.'); 
        }

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
