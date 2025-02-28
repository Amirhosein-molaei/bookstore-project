<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function subMenus()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
