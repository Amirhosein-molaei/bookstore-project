<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\User\Favorite;
use App\Models\Content\Writer;
use App\Http\Controllers\Controller;
use Nette\Utils\Random;
use App\Models\User\Otp;
use App\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Services\Sms\SmsService;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketAdmin;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket\TicketCategory;
use App\Http\Requests\Home\storeTicketRequest;
use App\Models\Market\Order;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $finishedOrders = Order::where('user_id', Auth::id())->where('order_status', 1)->get();
        $canceledOrders = Order::where('user_id', Auth::id())->where('order_status', 2)->get();
        $pendingOrders = Order::where('user_id', Auth::id())->where('order_status', 0)->get();

        $latestOrder = Order::orderByDesc('created_at')->first();

        return view("app.profile.profile-dashboard", compact(['user', 'finishedOrders', 'canceledOrders', 'pendingOrders', 'latestOrder']));
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

    public function favoritWriters()
    {
        $user = User::find(Auth::id());
        $favoriteWriters = $user->favoriteWriters()->get();
        return view('app.profile.favorit-writer', compact('favoriteWriters'));
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

        if ($request->file('image')) {
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

    public function edit()
    {
        return view('app.profile.edit');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255'
        ]);

        User::find(Auth::id())->update(['name' => $request->input('name')]);

        return to_route('user-profile.edit')->with('success', 'نام کاربری شما با موفقیت تغییر یافت.');
    }

    public function favoriteProducts()
    {
        $user = User::find(Auth::id());
        $favoriteProducts = $user->favoriteProducts()->paginate(4);
        return view('app.profile.favorite-products', compact('favoriteProducts'));
    }
    
    public function favoriteWriters()
    {
        $user = User::find(Auth::id());
        $favoriteWriters = $user->favoriteWriters()->paginate(4);
        return view('app.profile.favorite-writers', compact('favoriteWriters'));
    }

    public function orders()
    {
        $finishedOrders = Order::where('user_id', Auth::id())->where('order_status', 1)
            ->orderByDesc('created_at')->get();
            
        $canceledOrders = Order::where('user_id', Auth::id())->where('order_status', 2)
            ->orderByDesc('created_at')->get();
            
        $pendingOrders = Order::where('user_id', Auth::id())->where('order_status', 0)
            ->orderByDesc('created_at')->get();
            


        return view('app.profile.orders', compact(['finishedOrders', 'canceledOrders', 'pendingOrders']));
    }

    public function orderDetails(Order $order)
    {
        return view('app.profile.order-details', compact('order'));
    }
}
