<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class HomeController extends Controller
{
    //商品一覧ページの表示
    public function index(){
        $items = Item::all();
        return view('public.index', compact('items'));
    }

    //商品詳細ページの表示
    public function show(Item $item){
        $item->load('comments.user');
        return view('public.exhibition', compact('item'));
    }
}
