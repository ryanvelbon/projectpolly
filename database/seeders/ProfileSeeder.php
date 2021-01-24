<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Profile;



class ProfileSeeder extends Seeder
{
    public function run()
    {
    	$users = User::all();

    	$languages = DB::select('SELECT * FROM languages WHERE ranking <= 15');
    	$countries = DB::select('SELECT * FROM countries');

    	foreach($users as $user){

    		$bio = explode('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',file_get_contents('http://loripsum.net/api/1/medium/plaintext'))[1];

    		$profile = new Profile();

    		$profile->user_id = $user->id;
    		$profile->native_lang = $languages[array_rand($languages)]->id;
    		$profile->nationality = $countries[array_rand($countries)]->id;
    		$profile->dob = date("Y-m-d", rand(
    									strtotime("-40 year"),
    									strtotime("-13 year")));
    		$profile->gender = rand(0,1);
    		$profile->bio = substr($bio, 0, 300);

    		$profile->save();
    	}
    }
}