<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Content\Writer;
use App\Models\Market\Order;
use App\Models\Market\Product;
use App\Models\Ticket\TicketAdmin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'activated',
        'is_superAdmin',
        'mobile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function ticketAdmin()
    {
        return $this->hasOne(TicketAdmin::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    public function favoriteProducts()
    {
        return $this->morphedByMany(Product::class, 'favoriteable', 'favorites');
    }

    public function favoriteWriters()
    {
        return $this->morphedByMany(Writer::class, 'favoriteable', 'favorites')->whereNull('favorites.deleted_at');
    }

    public function hasPurchasedProduct($productId)
    {
        return $this->orders()
            ->where('order_status', 1) 
            ->whereHas('orderItems', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->exists();
    }

    public function hasFollowedWriter(Writer $writer): bool
    {
        return Favorite::where('user_id', $this->id)
            ->where('favoriteable_id', $writer->id)
            ->where('favoriteable_type', Writer::class)
            ->exists();
    }

}
