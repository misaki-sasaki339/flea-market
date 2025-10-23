<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ConditionsTableSeeder::class,
            ItemsTableSeeder::class,
            CategoryItemsTableSeeder::class,
        ]);
         Comment::factory()->count(15)->create();
    }
}
