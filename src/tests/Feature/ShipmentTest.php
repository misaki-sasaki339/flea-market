<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;

    // 配送先変更画面で登録した住所が商品購入画面に反映される
    public function test_changed_address_is_reflected_on_purchase_screen()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        /** @var \App\Models\User $user */
        $this->actingAs($user)
            ->withSession([
                'postcode' => '123-4567',
                'address' => '東京都渋谷区テスト1-2-3',
                'building' => 'テストアパート101',
            ])
            ->get(route('purchase', ['item' => $item->id]))
            ->assertSee('123-4567')
            ->assertSee('東京都渋谷区テスト1-2-3')
            ->assertSee('テストアパート101');
    }

    // 変更した配送先がshipmentsテーブルに保存される
    public function test_shipment_is_saved_on_order()
    {
        $user = User::factory()->create();
        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $order = Order::factory()
            ->for($user)
            ->for($item)
            ->create();

        $sessionData = [
            'postcode' => '123-4567',
            'address' => '東京都渋谷区テスト1-2-3',
            'building' => 'テストアパート101',
        ];

        Shipment::create(array_merge($sessionData, [
            'order_id' => $order->id,
        ]));

        /** @var \App\Models\User $user */
        $this->actingAs($user)
            ->withSession($sessionData)
            ->post(route('purchase.store', ['item' => $item->id]));

        $this->assertDatabaseHas('shipments', [
            'order_id' => $order->id,
            'postcode' => '123-4567',
            'address' => '東京都渋谷区テスト1-2-3',
            'building' => 'テストアパート101',
        ]);
    }
}
