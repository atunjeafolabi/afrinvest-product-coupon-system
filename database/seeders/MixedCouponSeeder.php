<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MixedCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mixed_coupons')->insert([
            'value' => 10,
            'percent_off' => 10
        ]);
    }
}
