<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Message;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'postcode',
        'address',
        'building',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // メール認証
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    // リレーション
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'favorites')->withTimestamps();
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function givenReviews() //したレビュー
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function receivedReviews() // されたレビュー
    {
        return $this->hasMany(Review::class, 'reviewed_id');
    }

    // レビュー平均の取得
    public function getAverageRatingAttribute()
    {
        if ($this->receivedReviews()->count() === 0) {
            return null;
        }

        return round($this->receivedReviews()->avg('score'));
    }

    // ユーザーの全未読件数取得
    public function totalUnreadMessagesCount(): int
    {
        return Message::where('is_read', false)
            ->where('user_id', '!=', $this->id) // 自分以外が送信
            ->whereHas('order', function ($q) {
                $q->where(function ($sub) {
                    $sub->where('user_id', $this->id) // 自分が購入者
                        ->orWhereHas('item', function ($iq) {
                            $iq->where('user_id', $this->id); // 自分が出品者
                        });
                })
                ->whereDoesntHave('buyerReview'); // 取引中
            })
            ->count();
    }
}
