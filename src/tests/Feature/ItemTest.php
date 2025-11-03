<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    // 商品詳細ページを開くと必要な商品情報が表示される
    public function test_user_can_see_necessary_information_of_item()
    {
        $category = Category::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create([
                'name' => 'テスト商品',
                'brand' => 'テストブランド',
                'price' => 1000,
                'description' => 'テストテストテスト',
            ]);

        $item->categories()->attach($category->id);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $item->favorites()->attach($user->id);
        $item->comments()->create([
            'user_id' => $user->id,
            'review' => 'テストコメント',
        ]);

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);

        $response->assertSee($item->name);
        $response->assertSee($item->brand);
        $response->assertSee(number_format($item->price));
        $response->assertSee($item->description);
        $response->assertSee($category->content);
        $response->assertSee((string) $item->favorites->count());
        $response->assertSee((string) $item->comments->count());
    }

    // 複数選択したカテゴリが表示される
    public function test_all_chosen_categories_are_displayed_on_screen()
    {
        $categories = collect([
            Category::factory()->create(['content' => 'ベビー・キッズ']),
            Category::factory()->create(['content' => 'おもちゃ']),
        ]);

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create([
                'name' => 'テスト商品',
                'brand' => 'テストブランド',
                'price' => 1000,
                'description' => 'テストテストテスト',
            ]);

        $item->categories()->attach($categories->pluck('id')->toArray());

        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $item->favorites()->attach($user->id);
        $item->comments()->create([
            'user_id' => $user->id,
            'review' => 'テストコメント',
        ]);

        $response = $this->get(route('item.show', $item->id));
        $response->assertStatus(200);

        $response->assertSee($item->name);
        $response->assertSee($item->brand);
        $response->assertSee(number_format($item->price));
        $response->assertSee($item->description);
        $response->assertSee((string) $item->favorites->count());
        $response->assertSee((string) $item->comments->count());

        foreach ($categories as $category) {
            $response->assertSee($category->content);
        }
    }
}
