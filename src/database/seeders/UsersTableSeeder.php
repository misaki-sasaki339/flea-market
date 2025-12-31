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
            'name' => '田中太郎',
            'email' => 'tanakatarou@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/pose_pien_uruuru_man.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => '甘楽',
            'email' => 'kanra@example.com',
            'password' => Hash::make('password123'),
            'avatar' => 'dummy/avatar/pose_pien_uruuru_woman.png',
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
        User::create([
            'name' => 'セットン',
            'email' => 'setton@example.com',
            'password' => Hash::make('password123'),
            'postcode' => '100-8111',
            'address' => '東京都千代田区千代田１−１',
        ]);
    }
}
