<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Models\User\Favorite;
use App\Models\Content\Writer;
use App\Http\Controllers\Controller;

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

      return view('app.profile.ticket', compact( 'unreviewedTickets', 'reviewedTickets'));
  }
  public function favoritWriters()
  {
    $user = auth()->user();
    $favoriteWriters = $user->favoriteWriters()
        ->wherePivotNull('deleted_at')       
        ->get();
    return view('app.profile.favorit-writer', compact( 'favoriteWriters'));

  }
}
