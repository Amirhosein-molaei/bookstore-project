<?php

namespace App\Http\Controllers\Home;

use Nette\Utils\Random;
use App\Models\User\Otp;
use App\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use Illuminate\Validation\Rule;
use App\Services\Sms\SmsService;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketAdmin;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket\TicketCategory;
use App\Http\Requests\Home\storeTicketRequest;
use App\Models\Market\Order;

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

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', Rule::unique(User::class)->ignore(Auth::id())]
        ]);

        User::find(Auth::id())->update([
            'email' => $request->input('email'),
            'email_verified_at' => null,
            'activated' => 0
        ]);

        $request->user()->sendEmailVerificationNotification();

        return to_route('user-profile.edit')->with('success', 'ایمیل فعال سازی ارسال شد.');
    }

    public function updateMobile(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'regex:/^(09[0-9]{9})$/', Rule::unique(User::class)->ignore(Auth::id())]
        ]);

        User::find(Auth::id())->update([
            'mobile' => $request->input('mobile'),
            // 'mobile_verified_at' => null,
            // 'activated' => 0
        ]);

        // $otpCode = random_int(1000, 9999);
        // Otp::create([
        //     'token' => Str::random(32),
        //     'user_id' => Auth::id(),
        //     'otp_code' => $otpCode,
        //     'used' => 0,
        //     'attempts' => 0,
        //     'expires_at' => now()->addMinutes(3)->toDateTimeString()
        // ]);

        // $smsService->sendSmsOtp($request->input('mobile'), $otpCode);

        return to_route('user-profile.edit')->with('success', 'شماره همراه شما با موفقیت تغییر یافت.');
    }

    public function favoriteProducts()
    {
        $user = User::find(Auth::id());
        $favoriteProducts = $user->favoriteProducts()->get();
        return view('app.profile.favorite-products', compact('favoriteProducts'));
    }

    public function orders()
    {
        $finishedOrders = Order::where('user_id', Auth::id())->where('order_status', 1)->get();
        $canceledOrders = Order::where('user_id', Auth::id())->where('order_status', 2)->get();
        $pendingOrders = Order::where('user_id', Auth::id())->where('order_status', 0)->get();


        return view('app.profile.orders', compact(['finishedOrders', 'canceledOrders', 'pendingOrders']));
    }

    public function orderDetails(Order $order)
    {
        return view('app.profile.order-details', compact('order'));
    }
}
