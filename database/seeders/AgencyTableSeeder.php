<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class AgencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('agencies')->insert([
                'name' => $faker->name,
                'phone' => $faker->unique()->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->email,
                'created_at' => now(),
            ]);
        }
    }
}
