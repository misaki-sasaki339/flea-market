<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MylistTest extends TestCase
{
    use RefreshDatabase;

    // お気に入り商品だけを表示
    public function test_user_can_see_only_favorited_items()
    {
        $user = User::factory()->create();
        $favoritedItem = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'お気に入り商品']);

        $otherItem = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'お気に入り外の商品']);

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.favorite', ['id' => $favoritedItem->id]));
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $favoritedItem->id,
        ]);

        $response = $this->actingAs($user)->get(route('home', ['tab' => 'mylist']));
        $response->assertStatus(200);

        $response->assertSee('お気に入り商品');
        $response->assertDontSee('お気に入り外の商品');
    }

    // お気に入り商品で購入済み商品はSold表示
    public function test_sold_label_is_displayed_for_favorited_sold_item()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->outOfStock()
            ->for(Condition::factory())
            ->for($user)
            ->create(['name' => '売り切れ商品']);

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.favorite', ['id' => $item->id]));
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $response = $this->actingAs($user)->get(route('home', ['tab' => 'mylist']));
        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    // 未認証ユーザーはマイリストで何も商品が表示されない
    public function test_guest_cannot_see_any_items_in_mylist()
    {
        $favoritedItem = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'お気に入り商品']);

        $response = $this->get(route('home', ['tab' => 'mylist']));
        $response->assertStatus(200);

        $response->assertDontSee('お気に入り商品');
        $response->assertDontSee('item-card');
    }
}
