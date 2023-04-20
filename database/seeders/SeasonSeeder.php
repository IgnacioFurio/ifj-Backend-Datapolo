<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seasons')->insert(
            [
                [
                    'id' => 1,
                    'season' => '2019-2020'
                ], 
                [
                    'id' => 2,
                    'season' => '2020-2021'
                ], 
                [
                    'id' => 3,
                    'season' => '2021-2022'
                ], 
                [
                    'id' => 4,
                    'season' => '2022-2023'
                ], 
            ]
        );
    }
}
