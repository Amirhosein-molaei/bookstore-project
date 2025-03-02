<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\StoreMenuRequest;
use App\Http\Requests\Admin\Content\UpdateMenuRequest;

class MenuController extends Controller
{
    public function index()
    {
        $menus=Menu::all();
        return view('admin.content.menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Menu::where('parent_id', null)->get();
        return view('admin.content.menu.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $inputs=$request->all();
        Menu::create($inputs);
        return to_route('admin.content.menu.index')->with('swal-success', ' منو با موفقیت ساخته شد');


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
    public function edit(Menu $menu)
    {
        $parents = Menu::where('parent_id', null)->get()->except($menu->id);
        return view('admin.content.menu.edit', compact('parents','menu'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $inputs=$request->all();
        $menu->update($inputs);
        return to_route('admin.content.menu.index')->with('swal-success', ' منو با موفقیت ویرایش شد');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return to_route('admin.content.menu.index')->with('swal-success', ' منو با موفقیت حذف شد');

    }
}
