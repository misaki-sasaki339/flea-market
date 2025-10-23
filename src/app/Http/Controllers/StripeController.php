<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function checkout(Request $request, Order $order)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $item = $order->item;

        $paymentMethod = session('payment_method');
        $stripeSession = StripeSession::create([
            'payment_method_types' => [$paymentMethod],
            'line_items' => [[
                'price' => $item->stripe_price_id,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['order' => $order->id]),
            'cancel_url' => route('payment.cancel', ['order' => $order->id]),
        ]);

        return redirect($stripeSession->url);
    }
    public function success()
    {
        return redirect()->route('mypage')->with('flash_message', '注文が完了しました')->with('flash_type', 'success');
    }

    public function cancel()
    {
        return redirect()->route('mypage')->with('flash_message', '決済キャンセルされました')->with('flash_type', 'error');;
    }
}
