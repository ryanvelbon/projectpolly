<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Helpers\Lorem;

use Exception;

class ConversationSeeder extends Seeder
{
    function run()
    {
    	function randUser(){
    		return User::inRandomOrder()->first();
    	}

    	function randUsers($n){
    		return User::inRandomOrder()->limit($n)->get();
    	}

	    function seedConversationsTable($n){
	    	for($i=0; $i<$n; $i++){
	    		if(rand(0,10)>8){
	    			$admin = User::inRandomOrder()->first();
	    			$others = User::where('id', '!=', $admin->id)
	    								->inRandomOrder()
	    								->limit(rand(1,10))
	    								->pluck('id')
	    								->toArray();
	    			$admin->startGroupConversationWith($others);
	    		}else{
	    			$a = User::inRandomOrder()->first();
	    			$b = User::where('id', '!=', $a->id)
	    							->inRandomOrder()
	    							->first();
	    			try{
	    				$a->startPvtConversationWith($b->id);
	    			}catch(Exception $e){
	    				// echo $e->getMessage() . "\n";
	    			}
	    		}
	    	}
	    	echo "`conversations` table seeded\n";
	    	echo "`conversation_user` table seeded\n";
	    }

	    function seedMessagesTable($n){
	    	for($i=0; $i<$n; $i++){
	    		$user = User::inRandomOrder()->first();
				$conversations = $user->conversations;
				if($conversations){			
					$c = $conversations[rand(0,sizeof($conversations)-1)];
					// PENDING use stats_rand_gen_exponential() instead
					// however, this will require installing Statistics extension (PECL extension) on server
					$msg = Lorem::chatMsg(rand(1,10));
					$user->sendMsg($c->id, $msg);
				}
	    	}
	    	echo "`messages` table seeded\n";
	    }

	    

	    $time_start = microtime(true);

	    $n = 100; // number of conversations
	    $avg_msgs_per_conversation = 50;

        seedConversationsTable($n);

        seedMessagesTable($n*$avg_msgs_per_conversation);

        $time_end = microtime(true);

        $duration = $time_end - $time_start;


        echo "Duration: " . $duration . " sec \n";

    }
}
