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
        $sales = $user->sales()->orderBy('created_at', 'desc')->get();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        return view('auth.mypage', compact('user', 'sales', 'orders'));
    }

    //プロフィールの編集画面の表示
    public function edit(){
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    //プロフィールの更新
    public function update(ProfileRequest $request){
        $user = $request->only(['name', 'postcode', 'address', 'building']);
        User::find($request->id)->update($user);


        return redirect('mypage');
    }
}
