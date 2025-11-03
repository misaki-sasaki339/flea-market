<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    // おすすめタブでの部分検索
    public function test_user_can_search_by_partial_name()
    {
        Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'MacBook']);

        Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'Windows']);

        $response = $this->get(route('home', ['keyword' => 'Mac']));
        $response->assertStatus(200);
        $response->assertSee('MacBook');
        $response->assertDontSee('Windows');
    }

    // マイリストタブにも検索結果を保持して表示
    public function test_search_keyword_is_retained_in_mylist()
    {
        $user = User::factory()->create();

        $favoritedItem1 = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'MacBook']);

        $favoritedItem2 = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create(['name' => 'Windows']);

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.favorite', ['id' => $favoritedItem1->id]));
        $this->actingAs($user)->post(route('item.favorite', ['id' => $favoritedItem2->id]));

        $response = $this->get(route('home', ['keyword' => 'Mac']));
        $response->assertStatus(200);
        $response->assertSee('MacBook');
        $response->assertDontSee('Windows');

        $response = $this->actingAs($user)->get(route('home', ['tab' => 'mylist', 'keyword' => 'Mac']));
        $response->assertStatus(200);
        $response->assertSee('MacBook');
        $response->assertDontSee('Windows');
        $response->assertSee('value="Mac"', false);
    }
}
