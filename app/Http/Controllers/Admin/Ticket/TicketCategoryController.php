<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets=TicketCategory::latest()->paginate(10);
        return view('admin.ticket.ticket-category.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.ticket-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request )
    {
        $request->validate([
            'name'=>'required',
        ]);
        TicketCategory::create([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.ticket.ticket-category.index')->with('swal-success','با موفقیت ثبت شد');
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
    public function edit(TicketCategory $ticket_category )
    {
        return view('admin.ticket.ticket-category.edit', compact('ticket_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketCategory $ticket_category )
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ticket_category->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.ticket.ticket-category.index')->with('swal-success', 'با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticketCategory = TicketCategory::findOrFail($id);
        $ticketCategory->delete();
        return redirect()->back()->with('swal-success','با موفقیت حذف شد');

    }
}
