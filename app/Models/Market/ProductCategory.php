<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
