<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //会員登録成功パターン
    public function test_user_can_register()
    {
        $data = [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $data);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/email/verify');
    }

    //パスワードと確認用パスワードが不一致のパターン
    public function test_registration_fails_when_password_confirmation_not_match()
    {
        $data = [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => "differentpass123",
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password']);
    }

    //パスワードが短すぎるパターン
    public function test_registration_fails_when_password_too_short()
    {
        $data = [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => 'pass',
            'password_confirmation' => "pass",
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password']);
    }

    //パスワード未入力のパターン
    public function test_registration_fails_when_password_is_missing()
    {
        $data = [
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['password']);
    }

    //メールアドレス未入力のパターン
    public function test_registration_fails_when_email_is_missing()
    {
        $data = [
            'name' => 'テストユーザー',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['email']);
    }

        //名前未入力のパターン
    public function test_registration_fails_when_name_is_missing()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['name']);
    }
}
