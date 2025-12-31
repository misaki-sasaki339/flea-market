<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stripe\Price;
use Stripe\Stripe;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $params = [
            [
                'img' => 'dummy/items/Armani+Mens+Clock.jpg',
                'user_id' => '1',
                'condition_id' => '1',
                'name' => '腕時計',
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => '15000',
            ],
            [
                'img' => 'dummy/items/HDD+Hard+Disk.jpg',
                'user_id' => '1',
                'condition_id' => '2',
                'name' => 'HDD',
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => '5000',
            ],
            [
                'img' => 'dummy/items/onion.jpg',
                'user_id' => '1',
                'condition_id' => '3',
                'name' => '玉ねぎ3束',
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => '300',
            ],
            [
                'img' => 'dummy/items/Leather+Shoes+Product+Photo.jpg',
                'user_id' => '1',
                'condition_id' => '4',
                'name' => '革靴',
                'brand' => '',
                'description' => 'クラシックなデザインの革靴',
                'price' => '4000',
            ],
            [
                'img' => 'dummy/items/Living+Room+Laptop.jpg',
                'user_id' => '1',
                'condition_id' => '1',
                'name' => 'ノートPC',
                'brand' => '',
                'description' => '高性能なノートパソコン',
                'price' => '45000',
            ],
            [
                'img' => 'dummy/items/Music+Mic+4632231.jpg',
                'user_id' => '2',
                'condition_id' => '2',
                'name' => 'マイク',
                'brand' => '',
                'description' => '高音質のレコーディング用マイク',
                'price' => '8000',
            ],
            [
                'img' => 'dummy/items/Purse+fashion+pocket.jpg',
                'user_id' => '2',
                'condition_id' => '3',
                'name' => 'ショルダーバッグ',
                'brand' => '',
                'description' => 'おしゃれなショルダーバッグ',
                'price' => '3500',
            ],
            [
                'img' => 'dummy/items/Tumbler+souvenir.jpg',
                'user_id' => '2',
                'condition_id' => '4',
                'name' => 'タンブラー',
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'price' => '500',
            ],
            [
                'img' => 'dummy/items/Waitress+with+Coffee+Grinder.jpg',
                'user_id' => '2',
                'condition_id' => '1',
                'name' => 'コーヒーミル',
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'price' => '4000',
            ],
            [
                'img' => 'dummy/items/外出メイクアップセット.jpg',
                'user_id' => '2',
                'condition_id' => '2',
                'name' => 'メイクセット',
                'brand' => '',
                'description' => '便利なメイクアップセット',
                'price' => '2500',
            ],
        ];

        foreach ($params as &$item) {
            $price = Price::create([
                'unit_amount' => $item['price'],
                'currency' => 'jpy',
                'product_data' => [
                    'name' => $item['name'],
                ],
            ]);
            $item['stripe_price_id'] = $price->id;
        }

        DB::table('items')->insert($params);
    }
}
