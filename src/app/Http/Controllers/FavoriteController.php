<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //ログインユーザーのみ引数内のメソッド利用可能
    public function __construct(){
        $this->middleware(['auth', 'verified'])->only('favorite', 'unfavorite');
    }

    //いいねの登録機能
    public function favorite($id){
        $item = Item::find($id);
        $item->favorites()->syncWithoutDetaching([Auth::id()]);
        return redirect()->back();
    } 

    //いいねの解除機能
    public function unfavorite($id){
        $item = Item::find($id);
        $item->favorites()->detach(Auth::id());
        return redirect()->back();
    }
}
