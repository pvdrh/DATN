<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            DB::table('customer_services')->insert([
                'customer_id' => $faker->numberBetween(1, 30),
                'service_id' => $faker->numberBetween(1, 50),
                'user_id' => $faker->numberBetween(1, 15),
                'created_at' => now(),
            ]);
        }
    }
}
