<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class FollowingsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach($users as $user){

        	$users_to_follow = User::inRandomOrder()->limit(rand(0,20))->get();

        	foreach($users_to_follow as $user_to_follow){
        		try{
		        	DB::table('followings')->insert([
		        		'follower' => $user->id,
		        		'followed' => $user_to_follow->id,	        		
		        	]);
        		}
        		catch(exception $e){
        			echo $e->getMessage();
        		}
        	}
        }
    }
}
