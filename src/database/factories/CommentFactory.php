<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'item_id' => Item::inRandomOrder()->first()->id,
            'review' => $this->faker->randomElement([
                'サイズ感が知りたいです',
                '発送まで何日程度かかりますか？',
                'お値下げ交渉可能ですか？',
                'スムーズなお取引ありがとうございました！',
                '発送が早くて助かりました♡',
                '梱包がとても丁寧で状態も良かったです！また機会があれば取引したいです。',
            ]),
        ];
    }
}
