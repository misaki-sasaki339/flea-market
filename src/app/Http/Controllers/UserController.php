<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;


class UserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        //新規ユーザーを登録→ログイン
        $input = $request->validated();
        $createUser = new CreateNewUser();
        $user = $createUser->create($input);
        Auth::login($user);

        //プロフィール編集画面にリダイレクト
        return redirect()->route('mypage.edit');
    }

    
}
