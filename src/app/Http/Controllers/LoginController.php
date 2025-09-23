<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //ログインフォーム表示
    public function create(){
        return view('auth.login');
    }

    //ログイン処理
    public function store(LoginRequest $request){
        $credentials = $request->validated();

        //認証成功
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/mypage');
        }
        
        //認証失敗
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput($request->except('password'));
    }

}
