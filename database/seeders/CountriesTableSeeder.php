<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
	 	$array = array(
    		"de" => "Germany",
    		"gb" => "English",
    		"es" => "Spanish",
    		"mt" => "Malta",
    		"it" => "Italy",
    	);

    	foreach ($array as $k => $v) {
			DB::table('countries')->insert([
	        	'code' => $k,
	        	'title' => $v,
	        ]);
    	}
    }
}