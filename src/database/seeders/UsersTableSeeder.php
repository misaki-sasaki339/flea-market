<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'モンキー・D・ルフィ',
            'email' => 'Luffy@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/ルフィー.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
            'building' => '皇居',
        ]);
        User::create([
            'name' => 'ロロノア・ゾロ',
            'email' => 'Zoro@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/ゾロ.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'ナミ',
            'email' => 'Nami@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/ナミ.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'そげキング',
            'email' => 'Usopp@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/そげキング.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'サンジ',
            'email' => 'Sanji@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/サンジ.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'トニートニー・チョッパー',
            'email' => 'Chopper@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/チョッパー.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'ニコ・ロビン',
            'email' => 'Robin@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/ニコロビン.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'フランキー',
            'email' => 'Franky@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/フランキー.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'ブルック',
            'email' => 'Brook@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/ブルック.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
    }
}
