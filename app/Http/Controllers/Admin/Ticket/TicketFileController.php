<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketFile;
use Illuminate\Http\Request;

class TicketFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketFile::paginate(10);
        return view('admin.ticket.ticket-file.index', compact('tickets'));
    }

    public function download(TicketFile $ticketFile)
    {
        // Full path in storage folder
       
        $filePath = storage_path('app/public/' . $ticketFile->file_path);
        if (!file_exists($filePath)) {
            abort(404, 'فایل یافت نشد.');
        }

        return response()->download($filePath, basename($ticketFile->file_path));
    }

    public function destroy(TicketFile $ticketFile)
    {
        $ticketFile->delete();
        return to_route('admin.ticket.ticket-file.index')->with('swal-success', 'تیکت با موفقیت حذف شد');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
}
