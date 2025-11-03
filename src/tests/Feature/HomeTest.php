<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    // 商品を全取得し画像と品名を表示する
    public function test_homepage_displays_all_items()
    {
        $items = Item::factory()
            ->count(5)
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $response = $this->get(route('home'));
        $response->assertStatus(200);

        foreach ($items as $item) {
            $response->assertSee($item->name);
            $response->assertSee($item->img);
        }
    }

    // 売り切れ商品にはSoldラベル表示
    public function test_sold_label_is_displayed_for_purchased_items()
    {
        $item = Item::factory()
            ->outOfStock()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    // ログイン中のユーザーが出品した商品は商品一覧に表示されない
    public function test_user_does_not_see_own_items_in_listing()
    {
        $user = User::factory()->create();

        // ログインユーザーの出品商品
        $ownItem = Item::factory()
            ->for($user)
            ->for(condition::factory())
            ->create(['name' => '自分の出品商品']);

        // ログインユーザー以外の出品商品
        $otherItem = Item::factory()
            ->for(User::factory())
            ->for(Condition::factory())
            ->create(['name' => '他人の出品商品']);

        /** @var \App\Models\User $user */
        $this->actingAs($user);
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertDontSee('自分の出品商品');
        $response->assertSee('他人の出品商品');
    }
}
