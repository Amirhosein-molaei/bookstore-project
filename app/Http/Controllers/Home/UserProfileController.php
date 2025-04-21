<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\storeTicketRequest;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketFile;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index()
    {
        return view("app.profile.profile-dashboard");
    }

    public function showTicket()
    {
        $user = Auth::user();

        $unreviewedTickets = Ticket::where('user_id', $user->id)
            ->where('status', 0)
            ->whereNull(columns: 'parent_id')
            ->with(['user', 'admin', 'file'])
            ->get();

        $reviewedTickets = Ticket::where('user_id', $user->id)
            ->where('status', 1)
            ->whereNull('parent_id')
            ->with(['user', 'admin', 'file', 'answers' => function ($query) {
                $query->with('admin');
            }])
            ->get();
        $ticketCategories = TicketCategory::where('status', 1)->get();
        return view('app.profile.ticket', compact(['unreviewedTickets', 'reviewedTickets', 'ticketCategories']));
    }

    public function sendTicket(storeTicketRequest $request)
    {
        $inputs = $request->validated();
        $ticketAdmin = TicketAdmin::withCount('tickets')->orderBy('tickets_count')->first();

        $inputs['reference_id'] = $ticketAdmin->id;
        $inputs['user_id'] = Auth::id();
        
        if ($request->file('image')) {
            unset($inputs['image']);
        }
        $ticket = Ticket::create($inputs);
        
        if($request->file('image')) {
            $file_size = $request->file('image')->getSize();
            $file_type = $request->file('image')->getMimeType();

            $imageUploadService = new ImageUploadService();
            $file_path = $imageUploadService->uploadImage($request->file('image'));

            if ($file_path === false) {
                return back()->with('error', 'خطا در آپلود فایل');
            }

            $file = TicketFile::create([
                'file_path' => $file_path,
                'file_size' => $file_size,
                'file_type' => $file_type,
                'user_id' => $ticket->user_id,
                'ticket_id' => $ticket->id
            ]);
        }

        return to_route('user-profile.tickets')->with('success', 'تیکت شما ثبت شد و در اسرع وقت رسیدگی خواهد شد');
    }
}
