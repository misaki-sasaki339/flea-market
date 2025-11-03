<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    // ユーザーは商品を購入できる
    public function test_user_can_purchase_item()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create([
                'img' => 'dummy.img',
            ]);

        Order::factory()
            ->create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);

        $item->update(['stock' => 0]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        // 商品一覧画面にリダイレクト後、商品にSold表示
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Sold');

        // プロフィールの購入した商品タブに追加されている
        /** @var \App\Models\User $user */
        $response = $this->actingAs($user)->get(route('mypage', ['page' => 'buy']));
        $response->assertStatus(200);
        $response->assertSee($item->name, false);
        $response->assertSee(asset('storage/'.$item->img), false);
    }
}
