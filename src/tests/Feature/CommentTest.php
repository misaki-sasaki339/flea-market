<?php

namespace Tests\Feature;

use App\Models\Condition;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    // ログイン済みユーザーはコメントを送信できる
    public function test_user_can_send_comment()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        /** @var \App\Models\User $user */
        $this->actingAs($user)->post(route('item.comment', $item->id), [
            'review' => 'テストコメント',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'review' => 'テストコメント',
        ]);
    }

    // 未認証ユーザーはコメントを送信できない
    public function test_guest_cannot_send_any_comments()
    {
        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $response = $this->post(route('item.comment', $item->id));
        $response->assertRedirect(route('login'));
    }

    // コメントが未入力の場合はバリデーションメッセージが表示される
    public function test_validation_message_is_shown_when_comment_is_missing()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        /** @var \App\Models\User $user */
        $response = $this->actingAs($user)
            ->from(route('item.show', ['item' => $item->id]))
            ->followingRedirects()
            ->post(route('item.comment', ['item_id' => $item->id]), [
                'review' => '',
            ]);

        $response->assertSee('コメントを入力してください');
    }

    // コメントが255文字を超える場合はバリデーションメッセージが表示される
    public function test_validation_message_is_shown_when_comment_is_over_256_words()
    {
        $user = User::factory()->create();

        $item = Item::factory()
            ->for(Condition::factory())
            ->for(User::factory())
            ->create();

        $longComment = str_repeat('あ', 256);

        /** @var \App\Models\User $user */
        $response = $this->actingAs($user)
            ->from(route('item.show', ['item' => $item->id]))
            ->followingRedirects()
            ->post(route('item.comment', ['item_id' => $item->id]), [
                'review' => $longComment,
            ]);

        $response->assertSee('コメントは255文字以内で入力してください');
    }
}
