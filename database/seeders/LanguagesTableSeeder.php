<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    public function run()
    {
    	$array = array(
    		"de" => "German",
    		"en" => "English",
    		"es" => "Spanish",
    	);

    	foreach ($array as $k => $v) {
			DB::table('languages')->insert([
	        	'code' => $k,
	        	'title' => $v,
	        ]);
    	}
    }
}
