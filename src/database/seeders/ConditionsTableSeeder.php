<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['良好', '目立った傷や汚れなし', 'やや傷や汚れあり', '状態が悪い'];

        foreach($statuses as $status){
            DB::table('conditions')->insert([
                'status' => $status,
            ]);
        }

    }
}
