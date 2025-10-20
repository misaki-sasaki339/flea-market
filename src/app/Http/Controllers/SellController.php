<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SellController extends Controller
{
    //出品ビューの表示
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        $tempImg = session('temp_img');
        $user = Auth::user();

        return view('auth.sell', compact('categories', 'conditions', 'tempImg', 'user'));
    }

    //商品画像をセッションに保存して商品ページへリダイレクト
    public function tempUpload(Request $request)
    {
        $path = $request->file('img')->store('public/tmp');
        $filename = basename($path);
        session(['temp_img' => $filename]);
        return back();
    }

    //出品商品の情報をDBに保存
    public function store(ExhibitionRequest $request)
    {
        $filename = $request->input('temp_img');
        if ($filename && Storage::exists('public/tmp/' . $filename)) {
            Storage::move('public/tmp/' . $filename, 'public/img/item/' . $filename);
        }

        $item = Item::create([
            'img' => 'img/item/' . $filename,
            'user_id' => Auth::id(),
            'condition_id' => $request->condition_id,
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $item->categories()->sync($request->input('category_ids', []));
        session()->forget('temp_img');
        return redirect()->route('mypage')->with('flash_message', '商品を出品しました')->with('flash_type', 'success');
    }
}
