<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Copan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function isValid()
    {
        return $this->status == 1 and now()->between($this->start_date, $this->end_date);
    }
}
