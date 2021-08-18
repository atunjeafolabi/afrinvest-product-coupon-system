<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RejectedCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rejected_coupons')->insert([
            'value' => 10
        ]);
    }
}
