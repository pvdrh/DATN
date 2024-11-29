<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->email,
                'gender' => $faker->randomElement([0, 1]),
                'medical_information' => '',
                'created_at' => now(),
                'dob' => $faker->date('Y-m-d', '2005-01-01'),
                'agency_id' => $faker->numberBetween(1, 20),
            ]);
        }
    }
}
