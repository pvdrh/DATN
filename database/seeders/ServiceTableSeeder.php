<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('services')->insert([
                'name' => $faker->name,
                'price' => $faker->randomFloat(0, 1000, 100000), // Giá ngẫu nhiên từ 1000 đến 100000 với 2 chữ số thập phân
                'duration' => $faker->randomElement([
                    $faker->numberBetween(1, 5) . ' năm',
                    $faker->numberBetween(1, 12) . ' tháng',
                    $faker->numberBetween(13, 24) . ' tháng',
                ]),                'agency_id' => $faker->numberBetween(2, 3),
                'description' => $faker->paragraph,
                'type' => $faker->numberBetween(1, 3),
                'status' => 1,
                'created_at' => now(),
            ]);
        }    }
}
