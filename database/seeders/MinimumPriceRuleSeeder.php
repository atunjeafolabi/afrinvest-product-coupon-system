<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MinimumPriceRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('minimum_price_rules')->insert([
            'value' => 50
        ]);

        DB::table('minimum_price_rules')->insert([
            'value' => 200
        ]);

        DB::table('minimum_price_rules')->insert([
            'value' => 1000
        ]);

        DB::table('minimum_price_rules')->insert([
            'value' => 100
        ]);
    }
}
