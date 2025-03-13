<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\storeTicketCategoryRequest;
use App\Http\Requests\Admin\Ticket\updateTicketCategoryRequest;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketCategory::latest()->paginate(10);
        return view('admin.ticket.ticket-category.index', compact('tickets'));
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
    public function store(storeTicketCategoryRequest $request)
    {
        $inputs = $request->validated();
        TicketCategory::create($inputs);
        return redirect()->route('admin.ticket.ticket-category.index')->with('swal-success', 'دسته بندی با موفقیت ثبت شد');
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
    public function edit(TicketCategory $ticket_category)
    {
        return view('admin.ticket.ticket-category.edit', compact('ticket_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateTicketCategoryRequest $request, TicketCategory $ticket_category)
    {
        $inputs = $request->validated();
        $ticket_category->update($inputs);

        return redirect()->route('admin.ticket.ticket-category.index')->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticketCategory = TicketCategory::findOrFail($id);
        $ticketCategory->delete();
        return redirect()->back()->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }
}
