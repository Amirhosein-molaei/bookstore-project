<?php

namespace App\Models\Ticket;

use App\Models\User\User;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['answers'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->hasOne(TicketFile::class);
    }

    public function admin()
    {
        return $this->belongsTo(TicketAdmin::class, 'reference_id');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
