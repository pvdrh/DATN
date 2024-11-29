<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerScheduleTableSeeder extends Seeder
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
                'start_time' => $faker->dateTimeBetween('now', '+2 weeks')->format('Y-m-d H:i:s'),
                'end_time' => null,
                'note' => $faker->sentence,
                'user_id' => $faker->numberBetween(1, 15),
            ]);
        }
    }
}
