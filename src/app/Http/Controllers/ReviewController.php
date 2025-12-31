<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompletedMail;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'score' => 'required|integer|min:1|max:5',
        ]);

        $reviewerId = auth()->id();

        $reviewedId = $order->user_id === $reviewerId // 評価者＝注文者の場合
            ? $order->item->user_id // 出品者を評価
            : $order->user_id; // そうでなければ注文者を評価

        Review::create([
            'order_id' => $order->id,
            'reviewer_id' => $reviewerId,
            'reviewed_id' => $reviewedId,
            'score' => $request->score,
        ]);

        Mail::to($order->item->user->email)
            ->send(new TransactionCompletedMail($order));

        return redirect()->route('home')->with('flash_message', '評価ありがとうございます')->with('flash_type', 'success');
    }
}
