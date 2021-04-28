<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Sentence;

class SentenceSeeder extends Seeder
{
    public function run()
    {
    	$users = User::all();

    	foreach($users as $user){

    		for($i=0; $i<rand(0,5); $i++){
    			
    			$sentence = new Sentence();

    			$sentence->body = explode('. ',file_get_contents('http://loripsum.net/api/1/short/plaintext'))[1].".";
    			$sentence->lang_id = $user->profile->native_lang;
    			$sentence->user_id = $user->id;

    			$sentence->save();
    		}
    	}
    }
}
