<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
        	// LanguagesTableSeeder::class, // manually import app\database\raw\languages.csv
            CountriesTableSeeder::class,
        	UserSeeder::class,
        	ProfileSeeder::class,
        	FollowingsTableSeeder::class,
        	SentenceSeeder::class,

            ConversationSeeder::class, // seeds these tables: `conversations`, `conversation_user`, `messages`

        ]);
    }
}
