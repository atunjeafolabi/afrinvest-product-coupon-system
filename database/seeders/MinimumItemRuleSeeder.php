<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MinimumItemRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('minimum_item_rules')->insert([
            'value' => 1,
        ]);

        DB::table('minimum_item_rules')->insert([
            'value' => 3,
        ]);

        DB::table('minimum_item_rules')->insert([
            'value' => 3
        ]);

        DB::table('minimum_item_rules')->insert([
            'value' => 1,
        ]);
    }
}
