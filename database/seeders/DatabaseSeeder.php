<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
           CouponSeeder::class,
           FixedValueCouponSeeder::class,
           MinimumItemRuleSeeder::class,
           MinimumPriceRuleSeeder::class,
           MixedCouponSeeder::class,
           PercentOffCouponSeeder::class,
           RejectedCouponSeeder::class,
           RuleSeeder::class
        ]);
    }
}
