<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFile extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];
}
