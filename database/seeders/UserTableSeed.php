<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'phone' => '0835904783',
            'password' => bcrypt('123456'),
            'role' => 1,
            'gender' => 1,
            'is_protected' => 1,
            'agency_id' => null,
            'created_at' => now(),
            'address' => 'Trâu Quỳ, Gia Lâm, Hà Nội',
            'dob' => '1998-11-19',
        ]);
    }
}
