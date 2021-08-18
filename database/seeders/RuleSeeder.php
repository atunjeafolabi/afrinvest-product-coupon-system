<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            'name' => 'MINIMUM_PRICE_RULE',
            'coupon_id' => 1,
            'rule_type' => 'App\Models\MinimumPriceRule',
            'rule_id'   => 1
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_ITEM_RULE',
            'coupon_id' => 1,
            'rule_type' => 'App\Models\MinimumItemRule',
            'rule_id'   => 1
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_PRICE_RULE',
            'coupon_id' => 2,
            'rule_type' => 'App\Models\MinimumPriceRule',
            'rule_id'   => 2
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_ITEM_RULE',
            'coupon_id' => 2,
            'rule_type' => 'App\Models\MinimumItemRule',
            'rule_id'   => 2
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_PRICE_RULE',
            'coupon_id' => 3,
            'rule_type' => 'App\Models\MinimumPriceRule',
            'rule_id'   => 3
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_ITEM_RULE',
            'coupon_id' => 4,
            'rule_type' => 'App\Models\MinimumItemRule',
            'rule_id'   => 3
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_PRICE_RULE',
            'coupon_id' => 4,
            'rule_type' => 'App\Models\MinimumPriceRule',
            'rule_id'   => 3
        ]);

        DB::table('rules')->insert([
            'name' => 'MINIMUM_ITEM_RULE',
            'coupon_id' => 3,
            'rule_type' => 'App\Models\MinimumItemRule',
            'rule_id'   => 4
        ]);
    }
}
