<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponChannelsTableSeeder extends Seeder
{
    public function run()
    {
        $channels = [
            'All Website',
            'Only Facebook',
            'Only Instagram',
            'Only Twitter',
            'Only Youtube',
            'Only Linkedin',
            'Only Whatsapp',
            'Only Telegram',
        ];

        foreach ($channels as $channel) {
            DB::table('coupon_channels')->insert([
                'name' => $channel,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
