<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SellTest extends TestCase
{
    use RefreshDatabase;

    // 必要な商品情報がデータベース上に保存される
    public function test_item_information_is_stored_on_db()
    {
        Storage::fake('public');
        $filename = 'dummy_' . uniqid() . '.jpg';
        Storage::put('public/tmp/' . $filename, 'dummycontent');

        $user = User::factory()->create();
        $condition = Condition::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        /** @var \App\Models\User $user */
        $response = $this->actingAs($user)
            ->withSession(['temp_img' => $filename])
            ->post(route('sell.store'), [
                'temp_img' => $filename,
                'name' => 'テスト商品',
                'brand' => 'テストブランド',
                'description' => 'テストテストテスト',
                'price' => 12345,
                'condition_id' => $condition->id,
                'category_ids' => [$category1->id, $category2->id],
            ]);
        $response->assertStatus(302);

        $item = Item::query()->latest('id')->first();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'brand' => 'テストブランド',
            'description' => 'テストテストテスト',
            'price' => 12345,
            'condition_id' => $condition->id,
        ]);

        $this->assertDatabaseHas('category_items', [
            'item_id' => $item->id,
            'category_id' => $category1->id,
        ]);
        $this->assertDatabaseHas('category_items', [
            'item_id' => $item->id,
            'category_id' => $category2->id,
        ]);
    }
}
