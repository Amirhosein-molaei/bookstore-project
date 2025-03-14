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
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function changeAdminAccess(Request $request, User $user)
    {
        if ($user->activated) {
            if ($user->is_admin) {
                // with tacking back admin access, ticket-admin access will be taken too
                if ($user->ticketAdmin) {
                    $ticketAdmin = TicketAdmin::where('user_id', $user->id)->first();
                    $ticketAdmin->delete();
                }
                $user->update(['is_admin' => 0]);
            } else {
                $user->update(['is_admin' => 1]);
            }

            return redirect()->back()->with('swal-success', 'دسترسی کاربر با موفقیت تغییر یافت');
        } else {
            return redirect()->back()->with('swal-error', 'تغییر دسترسی برای حساب های فعال نشده امکان پذیر نیست!');
        }
    
    }

    public function changeSuperAdminAccess(Request $request, User $user)
    {
        if ($user->activated) {
            // if access is changing from normal user to super-admin, admin access will be given too
            if (!$user->is_superAdmin and !$user->is_admin) {
                $user->update(['is_admin' => 1, 'is_superAdmin' => 1]);
            } else {
                $user->update(['is_superAdmin' => !$user->is_superAdmin]);
            }

            return redirect()->back()->with('swal-success', 'دسترسی سوپر ادمین با موفقیت تغییر یافت');
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
            TicketAdmin::restoreOrCreate(['user_id' => $user->id], ['user_id' => $user->id]);
        }
        
        return redirect()->back()->with('swal-success', 'دسترسی تیکت-ادمین با موفقیت تغییر یافت');
    }
}
