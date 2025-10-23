<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // 商品一覧ページの表示
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'recommend');
        $keyword = $request->query('keyword');

        // 未ログインかつマイリスト表示は空で返す
        if ($tab === 'mylist' && ! auth()->check()) {
            return view('public.index', [
                'items' => collect(), // 空配列
                'tab' => $tab,
                'keyword' => $keyword,
            ]);
        }

        if ($tab === 'mylist') { // 認証済みユーザーのマイリスト表示
            $query = auth()->user()->favorites();
        } else { // おすすめ表示
            $query = Item::query();
            if (Auth::check()) {
                $query->where('user_id', '!=', Auth::id()); // 商品のuser_idと認証user_idが一致する場合は除外
            }
        }

        // 検索機能
        if (filled($keyword)) {
            $query->keyword($keyword);
        }

        return view('public.index', [
            'items' => $query->get(),
            'tab' => $tab,
            'keyword' => $keyword,
        ]);

    }

    // 商品詳細ページの表示
    public function show(Item $item)
    {
        $item->load('comments.user');

        return view('public.exhibition', compact('item'));
    }

    // 商品検索機能
    public function search(Request $request)
    {
        $tab = $request->query('tab', 'recommend'); // 指定がなければおすすめ表示
        $keyword = $request->input('keyword');

        return redirect()->route('home', ['tab' => $tab, 'keyword' => $keyword]);
    }
}
