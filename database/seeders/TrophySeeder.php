<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrophySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trophies')->insert(
            [
                [
                    'name' => "Copa absoluta masculina de la Comunidad Valenciana",
                ], 
                [
                    'name' => "Liga absoluta masculina División de Honor",
                ], 
                [
                    'name' => "Liga absoluta masculina Primera División",
                ], 
                [
                    'name' => "Liga absoluta masculina Segunda División",
                ], 
                [
                    'name' => "Copa absoluta femenina de la Comunidad Valenciana",
                ], 
                [
                    'name' => "Liga absoluta femenina División de Honor",
                ], 
                [
                    'name' => "Liga absoluta femenina Primera División",
                ], 
                [
                    'name' => "Liga absoluta femenina Segunda División",
                ], 
                [
                    'name' => "Liga absoluta masculina División de Honor Nacional",
                ], 
                [
                    'name' => "Liga absoluta masculina Primera División Nacional",
                ], 
                [
                    'name' => "Liga absoluta masculina Segunda División Nacional",
                ], 
            ]
        );
    }
}
