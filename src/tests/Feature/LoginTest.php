<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);
    }

    //ログイン成功パターン
    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/mypage');
        $this->assertAuthenticatedAs($this->user);
    }

    //登録されていない情報でログイン失敗するパターン
    public function test_login_fails_with_invalid_password()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    //パスワード未入力のパターン
    public function test_login_fails_when_password_is_missing()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors(['password']);
        $response->assertRedirect('/login');
        $response = $this->get('/login');
        $response->assertStatus(200);
        $this->assertGuest();
    }
}
