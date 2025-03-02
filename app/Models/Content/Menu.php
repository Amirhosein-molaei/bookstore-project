<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
=======
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Menu extends Model
{
    use SoftDeletes,CascadeSoftDeletes;
    protected $cascadeDeletes = ['subMenus'];
>>>>>>> menu-management

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
