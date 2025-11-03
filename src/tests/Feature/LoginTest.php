<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
        ]);
    }

    // ログイン成功パターン
    public function test_user_can_login()
    {
        $response = $this->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('mypage'));
        $this->assertAuthenticatedAs($this->user);
    }

    // 登録されていない情報でログイン失敗するパターン
    public function test_login_fails_with_invalid_password()
    {
        $response = $this->from(route('login'))->post(route('login'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('login'));
        $response = $this->get(route('login'));
        $response->assertSee('ログイン情報が登録されていません');
        $this->assertGuest();
    }

    // パスワード未入力のパターン
    public function test_login_fails_when_password_is_missing()
    {
        $response = $this->from(route('login'))->post(route('login'), [
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect(route('login'));
        $response = $this->get(route('login'));
        $response->assertSee('パスワードを入力してください');
        $this->assertGuest();
    }

    // メールアドレス未入力のパターン
    public function test_login_fails_when_email_is_missing()
    {
        $response = $this->from(route('login'))->post(route('login'), [
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));
        $response = $this->get(route('login'));
        $response->assertSee('メールアドレスを入力してください');
        $this->assertGuest();
    }

    // ログアウトの成功
    public function test_user_can_logout()
    {
        $this->actingAs($this->user);
        $this->assertAuthenticatedAs($this->user);

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }
}
