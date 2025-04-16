<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class);
    }

    public function hasProduct($productId)
    {
        if ($this->items()->count() == 0 or $this === null) {
            return false;
        }
        return $this->items()->where('product_id', $productId)->exists();
    }
}
