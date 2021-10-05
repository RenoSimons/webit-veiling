<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Brand new Playstation 5',
                'start_price' => 500.50,
                'img_url' => 'bl9yiZCHcWdjzLV2htUxDYu2M0reW640Nsl0Fbqh.png',
                'close_date' => '10/12/2021',
                'highest_offer' => 410.20,
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Reno Simons',
            'email' => 'reno@skynet.be',
            'password' => Hash::make('password'),
            'admin' => 1,
        ]);
    }
}
