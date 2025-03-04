<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Copan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreCopanRequest;
use App\Http\Requests\Admin\Market\UpdateCopanRequest;

class CopanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copans=Copan::paginate(10);
        return view('admin.market.copan.index',compact('copans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.market.copan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCopanRequest $request)
    {
        $inputs = $request->all();

        $realTimeStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimeStart);

        $realTimeEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimeEnd);

        $copan = Copan::create($inputs);

        return to_route('admin.market.copan.index')->with('swal-success', 'تخفیف با موفقیت ساخته شد');
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
    public function edit(Copan $copan)
    {
        return view('admin.market.copan.edit',compact('copan'));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCopanRequest $request, Copan $copan)
    {
        $inputs=$request->all();
        $realTimeStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:i:s', (int)$realTimeStart);

        $realTimeEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:i:s', (int)$realTimeEnd);

        $copan->update($inputs);
        return to_route('admin.market.copan.index')->with('swal-success', 'تخفیف با موفقیت ویرایش شد');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copan $copan)
    {
        $copan->delete();
        return to_route('admin.market.copan.index')->with('swal-success', 'تخفیف با موفقیت حذف شد');

    }
}
