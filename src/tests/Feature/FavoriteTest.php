<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    // ユーザーは商品にいいねを登録できる
    public function test_user_can_favorite_item()
    {
        $user = User::factory()->create();
        $item = Item::factory()
            ->for(User::factory())
            ->for(Condition::factory())
            ->create();

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.favorite', $item->id));

        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    // ユーザーは商品にいいねを解除できる
    public function test_user_can_unfavorite_item()
    {
        $user = User::factory()->create();
        $item = Item::factory()
            ->for(User::factory())
            ->for(Condition::factory())
            ->create();

        $user->favorites()->attach($item->id);

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.unfavorite', $item->id));

        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    // 未認証ユーザーはいいねができない
    public function test_guest_cannot_favorite_item()
    {
        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $response = $this->post(route('item.favorite', $item->id));
        $response->assertRedirect(route('login'));
    }
}
