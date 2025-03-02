<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Menu extends Model
{
    use SoftDeletes,CascadeSoftDeletes;
    protected $cascadeDeletes = ['subMenus'];

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
