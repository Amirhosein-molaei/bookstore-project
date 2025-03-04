<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StorePublisherRequest;
use App\Http\Requests\Admin\Content\UpdatePublisherRequest;
use App\Models\Content\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::paginate(10);
        return view('admin.content.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublisherRequest $request)
    {
        $inputs = $request->all();
        Publisher::create($inputs);
        return to_route('admin.content.publisher.index')->with('swal-success', 'ناشر  با موفقیت ساخته شد');
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
    public function edit(Publisher $publisher)
    {

        return view('admin.content.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher)
    {
        $inputs = $request->all();
        $publisher->update($inputs);
        return to_route('admin.content.publisher.index')->with('swal-success', ' ناشر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return back()->with('swal-success', 'ناشر  با موفقیت حذف شد');
    }
}
