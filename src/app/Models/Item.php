<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'user_id',
        'condition_id',
        'name',
        'brand',
        'description',
        'stock',
        'price',
        'stripe_price_id',
    ];

    // リレーション
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_items');
    }

    public function condition()
    {
        return $this->belongsTo('App\Models\Condition');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // ログインユーザがいいねしているかの判定
    public function isLikedByAuthUser(): bool
    {
        $id = Auth::id();

        return $this->favorites()->where('user_id', $id)->exists();
    }

    // いいね数の取得
    public function favoritesCount()
    {
        return $this->favorites()->count();
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // ローカルスコープ
    public function scopeKeyword($query, $keyword)
    {
        if (! empty($keyword)) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }
    }
}
