<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners =Banner::latest()->paginate(10);
        return view('admin.content.banners.index',compact('banners'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $bannerImageController =new imageBannerController();
        $fileNameImage =$bannerImageController->upload($request->image);
        Banner::create([
            'image'=>$fileNameImage['fileNameImage'],
            'is_selected' => false,
        ]);
        return redirect()->route('admin.content.banners.index')->with('swal-success', 'داده با موفقیت ذخیره شد!');

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
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();
        return redirect()->route('admin.content.banners.index')->with('swal-success', 'بنر با موفقیت حذف شد.');

    }
    public function select(Banner $banner)
    {

        $selectedCount = Banner::where('is_selected', true)->count();


        if ($selectedCount >= 2 && !$banner->is_selected) {
            return redirect()->route('admin.content.banners.index')->with('swal-error', 'شما فقط می‌توانید حداکثر دو بنر انتخاب کنید.');
        }

        $banner->is_selected = !$banner->is_selected;
        $banner->save();

        return redirect()->route('admin.content.banners.index')->with('swal-success', 'وضعیت انتخاب بنر با موفقیت به‌روزرسانی شد.');
    }
    }
