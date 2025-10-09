<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    //商品購入画面の表示
    public function create(Item $item){
        $user = Auth::user();
        return view('auth.order.purchase', compact('item', 'user'));
    }

    //商品購入機能
    public function store(){

    }

    //住所変更画面の表示
    public function editAddress(){

    }

    //
}
