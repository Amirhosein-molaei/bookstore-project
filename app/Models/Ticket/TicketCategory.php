<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function getStatusAttribute($status)
    {
        return $status ? 'فعال' : 'غیرفعال';
    }

}
