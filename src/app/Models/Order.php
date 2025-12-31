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

    public function scopeRelatedToUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->orWhereHas('item', fn($q) => $q->where('user_id', $userId));
    }

    public function buyerReview()
    {
        return $this->hasOne(Review::class)
            ->whereColumn('reviewer_id', 'orders.user_id');
    }
}
