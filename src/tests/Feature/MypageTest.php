<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MypageTest extends TestCase
{
    use RefreshDatabase;

    // マイページでユーザーは必要な情報を取得できる
    public function test_user_can_view_their_profile_information()
    {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'avatar' => 'avatar.png',
        ]);

        $sellingItem = Item::factory()
            ->for(Condition::factory())
            ->for($user)
            ->create([
                'name' => '出品商品A',
                'img' => 'sellingA.png',
            ]);

        $boughtItem = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create([
                'name' => '購入商品B',
                'img' => 'boughtB.png',
            ]);

        $boughtItem->order()->create(['user_id' => $user->id]);

        /** @var \App\Models\User $user */
        $response = $this->actingAs($user)->get(route('mypage'));
        $response->assertStatus(200);
        $response->assertSee('テストユーザー');
        $response->assertSee('avatar.png');
        $response->assertSee('出品商品A');
        $response->assertSee('sellingA.png');

        $response = $this->actingAs($user)->get(route('mypage', ['page' => 'buy']));
        $response->assertStatus(200);
        $response->assertSee('購入商品B');
        $response->assertSee('boughtB.png');
    }
}
