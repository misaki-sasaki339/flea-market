<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    //プロフィール画面の表示
    public function index(){
        $user = Auth::user();
        $sells = $user->sales()->orderBy('created_at', 'desc')->get();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        return view('mypage', compact('users'));
    }

    //プロフィールの編集画面の表示
    public function edit(){
        return view('mypage.edit');
    }

    //プロフィールの更新
    public function update(ProfileRequest $request){
        $user = $request->only(['name', 'postcode', 'address', 'building']);
        User::find($request->id)->update($user);


        return redirect('mypage');
    }
}
