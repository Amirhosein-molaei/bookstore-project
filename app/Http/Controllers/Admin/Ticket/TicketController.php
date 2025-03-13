<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Ticket\storeTicketRequest;
use App\Http\Requests\Admin\Ticket\updateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::where('parent_id', null)->latest()->paginate(10);
        return view('admin.ticket.ticket.index', compact('tickets')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeTicketRequest $request)
    {
        $inputs = $request->validated();
        $parentTicket = Ticket::find($inputs['parent_id']);

        $TicketAdmin = TicketAdmin::where('user_id', 7)->first();

        $inputs['subject'] = $parentTicket->subject;
        $inputs['category_id'] = $parentTicket->category_id;
        $inputs['parent_id'] = $parentTicket->id;
        $inputs['reference_id'] = $TicketAdmin->id;
        $inputs['user_id'] = 7;
        
        Ticket::create($inputs);
        return to_route(route: 'admin.ticket.ticket.index')->with('swal-success', 'پاسخ با موفقیت ثبت شد');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.ticket.ticket.show', compact('ticket'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $admins = TicketAdmin::all();
        return view('admin.ticket.ticket.edit', compact('ticket', 'admins'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(updateTicketRequest $request, Ticket $ticket)
    {
        $inputs = $request->validated();
        $ticket->update($inputs);
        
        return to_route(route: 'admin.ticket.ticket.index')->with('swal-success', 'تیکت با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return to_route(route: 'admin.ticket.ticket.index')->with('swal-success', 'تیکت و پاسخ های آن با موفقیت حذف شدند');
    }

    public function changeStatus(Ticket $ticket)
    {
        $ticket->update(['status' => !$ticket->status]);
        return to_route(route: 'admin.ticket.ticket.index')->with('swal-success', 'وضعیت تیکت با موفقیت تغییر یافت');
    }
}
