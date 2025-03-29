<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
   public function index()
   {
    return view("app.profile.profile-dashboard");
   }
   public function showTicket()
   {
      $user = auth()->user();

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

      return view('app.profile.ticket', compact('unreviewedTickets', 'reviewedTickets'));
  }
}
