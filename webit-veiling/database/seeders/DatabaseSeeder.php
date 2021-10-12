<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Reno Simons',
            'email' => 'reno@skynet.be',
            'password' => Hash::make('password'),
            'admin' => 1,
        ]);
        
        for ($i=1; $i < 20; $i++) {
            DB::table('products')->insert([
                'name' => 'Brand new Playstation 5',
                'start_price' => 500.50,
                'img_url' => 'bl9yiZCHcWdjzLV2htUxDYu2M0reW640Nsl0Fbqh.png',
                'close_date' => '25/11/2021',
                'highest_offer' => 410.20,
                'description' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste mollitia ipsa illo, beatae similique nulla dolorum assumenda ea ex voluptatum quas ipsam molestias magni animi esse praesentium doloribus fugit repellat?"
            ]);

            DB::table('bids')->insert([
                'user_id' => '1',
                'product_id' => '1',
                'price' => 600.50,
                'created_at' => Carbon::now(),
            ]);
        }    
    }
}
