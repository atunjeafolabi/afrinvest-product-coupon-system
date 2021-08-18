<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'code' => 'FIXED10',
            'coupon_type' => 'App\Models\FixedValueCoupon',
            'coupon_id' => 1,
        ]);

        DB::table('coupons')->insert([
            'code' => 'MIXED10',
            'coupon_type' => 'App\Models\MixedCoupon',
            'coupon_id' => 1,
        ]);

        DB::table('coupons')->insert([
            'code' => 'REJECTED10',
            'coupon_type' => 'App\Models\RejectedCoupon',
            'coupon_id' => 1,
        ]);

        DB::table('coupons')->insert([
            'code' => 'PERCENT10',
            'coupon_type' => 'App\Models\PercentOffCoupon',
            'coupon_id' => 1,
        ]);
    }
}
