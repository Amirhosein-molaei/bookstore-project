<?php

namespace App\Models\Content;


use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Blog extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope برای مرتب‌سازی بر اساس پربازدیدترین‌ها
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->orderBy('view_count', 'desc');
    }

    /**
     * Scope برای مرتب‌سازی دینامیک
     */
    public function scopeSortBy(Builder $query, string $sortType): Builder
    {
        return match ($sortType) {
            'popular' => $query->popular(),
            default => $query->latest(),
        };

    }
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', '%'.$searchTerm.'%')
                ->orWhere('body', 'like', '%'.$searchTerm.'%');
        });
    }
    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }
}
