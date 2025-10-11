<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    //商品一覧ページの表示
    public function index(Request $request){
        //tabパラメータの分岐：指定がなければrecommendをセット
        $tab = $request->query('tab', 'recommend');

        //マイリスト選択時お気に入り商品を表示、そうでない場合は全商品表示
        if ($tab === 'mylist'){
            $items =  auth()->check() ? auth()->user()->favorites : collect();
        }else{
            $items = Item::all();
        }
        return view('public.index', compact('items', 'tab'));
    }

    //商品詳細ページの表示
    public function show(Item $item){
        $item->load('comments.user');
        return view('public.exhibition', compact('item'));
    }

    //商品検索機能
    public function search(Request $request){
        $items = Item::keyword($request->input('keyword'))->get();
        return view('public.index', compact('items'));
    }
}
