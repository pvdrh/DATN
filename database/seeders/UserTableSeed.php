<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'name' => 'Admin',
//            'phone' => '0835904783',
//            'password' => bcrypt('123456'),
//            'role' => 1,
//            'gender' => 1,
//            'is_protected' => 1,
//            'agency_id' => null,
//            'created_at' => now(),
//            'address' => 'Trâu Quỳ, Gia Lâm, Hà Nội',
//            'dob' => '1998-11-19',
//        ]);

        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'phone' => $faker->unique()->phoneNumber,
                'password' => bcrypt('123456'),
                'role' => $faker->numberBetween(2, 3),
                'gender' => $faker->randomElement([0, 1]),
                'is_protected' => 0,
                'agency_id' => $faker->numberBetween(1, 15),
                'created_at' => now(),
                'address' => $faker->address,
                'dob' => $faker->date('Y-m-d', '2005-01-01'),
            ]);
        }
    }
}
