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
                    'season' => '2019-2020'
                ], 
                [
                    'season' => '2020-2021'
                ], 
                [
                    'season' => '2021-2022'
                ], 
                [
                    'season' => '2022-2023'
                ], 
            ]
        );
    }
}
