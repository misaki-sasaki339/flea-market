<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'img' => 'dummy/items/Armani+Mens+Clock.jpg',
                'user_id'=>'1',
                'condition_id'=>'1',
                'name'=>'腕時計',
                'brand'=>'Rolax',
                'description'=>'スタイリッシュなデザインのメンズ腕時計',
                'price'=>'15000',
                'stripe_price_id'=>'price_1SFdj7IF9VwpA1eugWUGBACN',
            ],
            [
                'img' => 'dummy/items/HDD+Hard+Disk.jpg',
                'user_id'=>'2',
                'condition_id'=>'2',
                'name'=>'HDD',
                'brand'=>'西芝',
                'description'=>'高速で信頼性の高いハードディスク',
                'price'=>'5000',
                'stripe_price_id'=>'price_1SFdjcIF9VwpA1euUdtR8N2z',
            ],
            [
                'img' => 'dummy/items/onion.jpg',
                'user_id'=>'3',
                'condition_id'=>'3',
                'name'=>'玉ねぎ3束',
                'brand'=>'なし',
                'description'=>'新鮮な玉ねぎ3束のセット',
                'price'=>'300',
                'stripe_price_id'=>'price_1SFdk8IF9VwpA1eu1L4vQFFH',
            ],
            [
                'img' => 'dummy/items/Leather+Shoes+Product+Photo.jpg',
                'user_id'=>'4',
                'condition_id'=>'4',
                'name'=>'革靴',
                'brand'=>'',
                'description'=>'クラシックなデザインの革靴',
                'price'=>'4000',
                'stripe_price_id'=>'price_1SFdkTIF9VwpA1euczhmXCTN',
            ],
            [
                'img' => 'dummy/items/Living+Room+Laptop.jpg',
                'user_id'=>'5',
                'condition_id'=>'1',
                'name'=>'ノートPC',
                'brand'=>'',
                'description'=>'高性能なノートパソコン',
                'price'=>'45000',
                'stripe_price_id'=>'price_1SFdknIF9VwpA1eukacGEMoB',
            ],
            [
                'img' => 'dummy/items/Music+Mic+4632231.jpg',
                'user_id'=>'6',
                'condition_id'=>'2',
                'name'=>'マイク',
                'brand'=>'',
                'description'=>'高音質のレコーディング用マイク',
                'price'=>'8000',
                'stripe_price_id'=>'price_1SFdl4IF9VwpA1euBoXenfW9',
            ],
            [
                'img' => 'dummy/items/Purse+fashion+pocket.jpg',
                'user_id'=>'7',
                'condition_id'=>'3',
                'name'=>'ショルダーバッグ',
                'brand'=>'',
                'description'=>'おしゃれなショルダーバッグ',
                'price'=>'3500',
                'stripe_price_id'=>'price_1SFdmJIF9VwpA1euXfQQLLpT',
            ],
            [
                'img' => 'dummy/items/Tumbler+souvenir.jpg',
                'user_id'=>'8',
                'condition_id'=>'4',
                'name'=>'タンブラー',
                'brand'=>'なし',
                'description'=>'使いやすいタンブラー',
                'price'=>'500',
                'stripe_price_id'=>'price_1SFdmlIF9VwpA1eu2XIOfx3S',
            ],
            [
                'img' => 'dummy/items/Waitress+with+Coffee+Grinder.jpg',
                'user_id'=>'9',
                'condition_id'=>'1',
                'name'=>'コーヒーミル',
                'brand'=>'Starbacks',
                'description'=>'手動のコーヒーミル',
                'price'=>'4000',
                'stripe_price_id'=>'price_1SFdn7IF9VwpA1eujdXEjhqy',
            ],
            [
                'img' => 'dummy/items/外出メイクアップセット.jpg',
                'user_id'=>'1',
                'condition_id'=>'2',
                'name'=>'メイクセット',
                'brand'=>'',
                'description'=>'便利なメイクアップセット',
                'price'=>'2500',
                'stripe_price_id'=>'price_1SFdnSIF9VwpA1eumysZc7Ld',
            ],
        ];
        DB::table('items')->insert($params);
    }
}
