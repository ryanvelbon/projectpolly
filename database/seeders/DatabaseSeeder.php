<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
        	LanguagesTableSeeder::class,
            CountriesTableSeeder::class,
        	UserSeeder::class,
        	ProfileSeeder::class,
        	FollowingsTableSeeder::class,
        	SentenceSeeder::class,
        ]);
    }
}
