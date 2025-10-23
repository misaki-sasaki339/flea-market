<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // プロフィール画面の表示
    public function index(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page', 'sell');

        if ($page === 'sell') { // 出品商品の表示
            $items = Item::where('user_id', $user->id)->get();
        } elseif ($page === 'buy') { // 購入商品の表示
            $orders = $user->orders()->with('item')->get();
            $items = $orders->pluck('item');
        }

        return view('auth.mypage', compact('user', 'items', 'page'));
    }

    // プロフィールの編集画面の表示
    public function edit()
    {
        $user = Auth::user();
        $tempImg = session('temp_img');

        return view('auth.edit', compact('user', 'tempImg'));
    }

    // アバター画像をセッションに保存して商品ページへリダイレクト
    public function tempUpload(Request $request)
    {
        $path = $request->file('avatar')->store('public/tmp');
        $filename = basename($path);
        session(['temp_avatar' => $filename]);

        return back();
    }

    // プロフィールの更新
    public function update(ProfileRequest $request)
    {
        $filename = $request->input('temp_avatar');
        if ($filename && Storage::exists('public/tmp/'.$filename)) {
            Storage::move('public/tmp/'.$filename, 'public/img/avatar/'.$filename);
            $request->merge(['avatar' => 'img/avatar/'.$filename]);
        }

        auth()->user()->update($request->only(['avatar', 'name', 'postcode', 'address', 'building']));
        session()->forget('temp_avatar');

        return redirect()->route('mypage')->with('flash_message', '情報を更新しました')->with('flash_type', 'success');
    }
}
