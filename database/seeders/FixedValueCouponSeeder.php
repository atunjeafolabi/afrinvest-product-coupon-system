<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class FixedValueCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fixed_value_coupons')->insert([
            'value' => 10,
        ]);
    }
}
