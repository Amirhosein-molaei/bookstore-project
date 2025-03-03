<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function changeAccess(Request $request, User $user)
    {
        if ($user->activated) {
            if ($user->is_admin) {
                $user->update(['is_admin' => 0]);
            } else {
                $user->update(['is_admin' => 1]);
            }

            return redirect()->back()->with('swal-success', 'دسترسی کاربر با موفقیت تغییر یافت');
        } else {
            return redirect()->back()->with('swal-error', 'تغییر دسترسی برای حساب های فعال نشده امکان پذیر نیست!');
        }
    
    }

    public function changeTicketAdmin(User $user)
    {
        if ($user->ticketAdmin) {
            $ticketAdmin = TicketAdmin::where('user_id', $user->id)->first();
            $ticketAdmin->delete();
        } else {
            TicketAdmin::create(['user_id' => $user->id]);
        }
        
        return redirect()->back()->with('swal-success', 'دسترسی تیکت-ادمین با موفقیت تغییر یافت');
    }
}
