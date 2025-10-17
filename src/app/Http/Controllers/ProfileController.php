<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;


class ProfileController extends Controller
{
    //プロフィール画面の表示
    public function index(Request $request){
        $user = Auth::user();
        $page = $request->query('page', 'sell');

        if ($page === 'sell'){ //出品商品の表示
            $items = Item::where('user_id', $user->id)->get();
        }elseif($page === 'buy'){ //購入商品の表示
            $orders = $user->orders()->with('item')->get();
            $items = $orders->pluck('item');
        }
        return view('auth.mypage', compact('user','items', 'page'));
    }

    //プロフィールの編集画面の表示
    public function edit(){
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    //プロフィールの更新
    public function update(ProfileRequest $request){
        auth()->user()->update($request->only(['avatar','name', 'postcode', 'address', 'building']));
        return redirect('auth.mypage');
    }
}
