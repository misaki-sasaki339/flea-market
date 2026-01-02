<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Message;
use App\Http\Requests\MessageRequest;
use App\Models\Review;

class MessageController extends Controller
{
    // チャット画面の表示
    public function show(Order $order)
    {
        $order->load(['item.user', 'user']);

        if (
            auth()->id() !== $order->user_id &&
            auth()->id() !== $order->item->user_id
        ) {
            abort(403);
        }
        // 注文情報の取得
        $orders = Order::with('item.user')
            ->relatedToUser(auth()->id())
            ->whereDoesntHave('buyerReview')
            ->get();

        // メッセージの取得
        $messages = Message::where('order_id', $order->id)
            ->with('user')
            ->orderBy('created_at')
            ->get();

        $loginUser = auth()->user();
        $partner = $loginUser->id === $order->user_id
            ? $order->item->user //自分が購入者の場合は出品者
            : $order->user; //自分が出品者の場合は購入者

        $latestMyMessageId = Message::where('order_id', $order->id)
            ->where('user_id', auth()->id())
            ->latest()
            ->value('id');

        $isSeller = auth()->id() === $order->item->user_id;
        $buyerReviewed = Review::where('order_id', $order->id)
            ->where('reviewer_id', $order->user_id)
            ->exists();
        $sellerNotReviewed = ! Review::where('order_id', $order->id)
            ->where('reviewer_id', auth()->id())
            ->exists();

        $canSellerReview = $isSeller && $buyerReviewed && $sellerNotReviewed;

        // 既読処理
        Message::where('order_id', $order->id)
            ->where('user_id', '!=', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('auth.message',
        [
            'orders' => $orders,
            'partner' => $partner,
            'order' => $order,
            'messages' => $messages,
            'latestMyMessageId' => $latestMyMessageId,
            'canSellerReview' => $canSellerReview,
        ]);
    }

    // メッセージの投稿
    public function store(MessageRequest $request, Order $order)
    {
        Message::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'img' => $request->file('img')
                ? $request->file('img')->store('messages', 'public')
                : null,
        ]);

        return redirect()->route('messages.show', $order);
    }

    // メッセージの更新
    public function update(MessageRequest $request, Message $message)
    {
        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->update([
            'body' => $request->body,
        ]);

        return redirect()->back();
    }
    // 投稿済みメッセージの削除

    public function destroy(Message $message)
    {
        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->delete();
        return redirect()->back()->with('flash_message', 'メッセージを削除しました')->with('flash_type', 'success');
    }
}
