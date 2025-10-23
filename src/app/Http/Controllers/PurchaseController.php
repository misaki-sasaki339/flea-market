<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;
use App\Models\Shipment;

class PurchaseController extends Controller
{
    //商品購入画面の表示
    public function create(Item $item)
    {
        $user = Auth::user();
        return view('auth.order.purchase', compact('item', 'user'));
    }

        //住所変更画面の表示
    public function editAddress(Request $request)
    {
        $user = Auth::user();

        if ($request->has('item_id')) {
            session(['item_id' => $request->item_id]);
        }
        return view('auth.order.address', compact('user'));
    }

        //変更先住所の登録
    public function updateAddress(AddressRequest $request)
    {
        $request->session()->put([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);
        $itemId = $request->input('item_id');
        return redirect()->route('purchase', ['item' => $itemId])->with('flash_message', '配送先を変更しました')->with('flash_type', 'success');;
    }

    //商品購入機能
    public function store(PurchaseRequest $request, Item $item)
    {

        $user = Auth::user();
        if (empty($user->address)) {
            return back()->withErrors([
                'address' => '住所が登録されていません マイページの『プロフィールを編集』をご確認ください',
            ]);
        }

        if ($item->stock > 0) {
            $item->stock = 0;
            $item->save();

            $order = Order::create([
                'user_id' => Auth()->id(),
                'item_id' => $item->id,
            ]);

            $shipment = Shipment::create([
                'order_id' => $order->id,
                'postcode' => session('postcode') ?? $user->postcode,
                'address' => session('address') ?? $user->address,
                'building' => session('building') ?? $user->building,
            ]);

            $request->session()->put('payment_method', $request->payment);
            $request->session()->save();
            return redirect()->route('payment.checkout', ['order' => $order->id]);
        }
    }

}
