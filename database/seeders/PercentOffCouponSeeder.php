<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PercentOffCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('percent_off_coupons')->insert([
            'percent_off' => 10
        ]);
    }
}
