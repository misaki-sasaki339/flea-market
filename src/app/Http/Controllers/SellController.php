<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();

        return view('auth.sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $items = $request->only('img', 'condition_id', 'name', 'brand', 'description', 'price');
        $items['category_ids'] = $request->category_ids;

        Item::create($items);
        return redirect()->route('mypage');
    }
}
