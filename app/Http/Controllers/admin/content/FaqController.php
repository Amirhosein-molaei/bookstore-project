<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Content\StoreFaqRequest;
use App\Http\Requests\Admin\Content\UpdateFaqRequest;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.content.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        $inputs = $request->all();
        $faq = Faq::create($inputs);

        return to_route('admin.content.faq.index')->with('swal-success', 'سوال با موفقیت ساخته شد');
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
    public function edit(Faq $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $inputs = $request->all();
        $faq = $faq->update($inputs);

        return to_route('admin.content.faq.index')->with('swal-success', 'سوال با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $result = $faq->delete();
        return back()->with('swal-success', 'سوال با موفقیت حذف شد');
    }
}
