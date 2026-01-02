<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
    ];

    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ユーザーが関係する取引の取得（出品・購入）
    public function scopeRelatedToUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->orWhereHas('item', fn($q) => $q->where('user_id', $userId));
    }

    // 購入者が書いたレビューを取得
    public function buyerReview()
    {
        return $this->hasOne(Review::class)
            ->whereColumn('reviewer_id', 'orders.user_id');
    }

    // 1取引あたりの未読件数取得
    public function unreadMessagesCountForUser(int $userId): int
    {
        return $this->messages()
            ->where('is_read', false)
            ->where('user_id', '!=', $userId)
            ->count();
    }

}
