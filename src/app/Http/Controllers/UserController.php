<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        // 新規ユーザーを登録
        $input = $request->validated();
        $createUser = new CreateNewUser;
        $user = $createUser->create($input);

        // 認証メールの送信
        event(new Registered($user));

        Auth::login($user);

        // 認証メール送信完了画面
        return redirect()->route('verification.notice');
    }
}
