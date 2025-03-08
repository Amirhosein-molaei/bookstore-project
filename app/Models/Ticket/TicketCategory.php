<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketCategory extends Model
{
    use SoftDeletes;
    protected $table='ticket_categories';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }
    public function getStatusAttribute($status)
    {
        return $status ? 'فعال' : 'غیرفعال';
    }

}
