<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'avatar'=> 'img/avatar/ルフィー.png'
        ]);
        User::create([
            'name' => 'ロロノア・ゾロ',
            'email' => 'Zoro@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/ゾロ.png'
        ]);
        User::create([
            'name' => 'ナミ',
            'email' => 'Nami@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/ナミ.png'
        ]);       
        User::create([
            'name' => 'そげキング',
            'email' => 'Usopp@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/そげキング.png'
        ]);      
        User::create([
            'name' => 'サンジ',
            'email' => 'Sanji@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/サンジ.png'
        ]);        
        User::create([
            'name' => 'トニートニー・チョッパー',
            'email' => 'Chopper@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/チョッパー.png'
        ]);        
        User::create([
            'name' => 'ニコ・ロビン',
            'email' => 'Robin@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/ニコロビン.png'
        ]);        
        User::create([
            'name' => 'フランキー',
            'email' => 'Franky@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/フランキー.png'
        ]);        
        User::create([
            'name' => 'ブルック',
            'email' => 'Brook@example.com',
            'password' => Hash::make('password123'), 
            'avatar'=> 'img/avatar/ブルック.png'
        ]);        
    }
}
