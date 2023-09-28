<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            DB::table('categories')->insert([
                'title' => $faker->name,
                'slug' => $faker->slug,
                'describe' => $faker->text,
                'status' => 1,
            ]);
        }
    }
}
