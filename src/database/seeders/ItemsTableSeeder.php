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
                'img' => 'img/item/Armani+Mens+Clock.jpg',
                'user_id'=>'1',
                'condition_id'=>'1',
                'name'=>'腕時計',
                'brand'=>'Rolax',
                'description'=>'スタイリッシュなデザインのメンズ腕時計',
                'price'=>'15000',
            ],
            [
                'img' => 'img/item/HDD+Hard+Disk.jpg',
                'user_id'=>'2',
                'condition_id'=>'2',
                'name'=>'HDD',
                'brand'=>'西芝',
                'description'=>'高速で信頼性の高いハードディスク',
                'price'=>'5000',
            ],
            [
                'img' => 'img/item/onion.jpg',
                'user_id'=>'3',
                'condition_id'=>'3',
                'name'=>'玉ねぎ3束',
                'brand'=>'なし',
                'description'=>'新鮮な玉ねぎ3束のセット',
                'price'=>'300',
            ],
            [
                'img' => 'img/item/Leather+Shoes+Product+Photo.jpg',
                'user_id'=>'4',
                'condition_id'=>'4',
                'name'=>'革靴',
                'brand'=>'',
                'description'=>'クラシックなデザインの革靴',
                'price'=>'4000',
            ],
            [
                'img' => 'img/item/Living+Room+Laptop.jpg',
                'user_id'=>'5',
                'condition_id'=>'1',
                'name'=>'ノートPC',
                'brand'=>'',
                'description'=>'高性能なノートパソコン',
                'price'=>'45000',
            ],
            [
                'img' => 'img/item/Music+Mic+4632231.jpg',
                'user_id'=>'6',
                'condition_id'=>'2',
                'name'=>'マイク',
                'brand'=>'',
                'description'=>'高音質のレコーディング用マイク',
                'price'=>'8000', 
            ],
            [
                'img' => 'img/item/Purse+fashion+pocket.jpg',
                'user_id'=>'7',
                'condition_id'=>'3',
                'name'=>'ショルダーバッグ',
                'brand'=>'',
                'description'=>'おしゃれなショルダーバッグ',
                'price'=>'3500', 
            ],
            [
                'img' => 'img/item/Tumbler+souvenir.jpg',
                'user_id'=>'8',
                'condition_id'=>'4',
                'name'=>'タンブラー',
                'brand'=>'なし',
                'description'=>'使いやすいタンブラー',
                'price'=>'500', 
            ],
            [
                'img' => 'img/item/Waitress+with+Coffee+Grinder.jpg',
                'user_id'=>'9',
                'condition_id'=>'1',
                'name'=>'コーヒーミル',
                'brand'=>'Starbacks',
                'description'=>'手動のコーヒーミル',
                'price'=>'4000', 
            ],
            [
                'img' => 'img/item/外出メイクアップセット.jpg',
                'user_id'=>'1',
                'condition_id'=>'2',
                'name'=>'メイクセット',
                'brand'=>'',
                'description'=>'便利なメイクアップセット',
                'price'=>'2500',
            ],
        ];
        DB::table('items')->insert($params);
    }
}