<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sentence;

class CalcTopContribStatsTableSeeder extends Seeder
{
    public function run()
    {
    	// truncate if exists

        $dates = array(
        	'today' => date('Y-m-d h:i:s', strtotime('-1 days')),
        	'this week' => date('Y-m-d h:i:s', strtotime('-7 days')),
        	'this month' => date('Y-m-d h:i:s', strtotime('-30 days')),
        	// 'max' => ,
        );

        $n = 5;

        foreach($dates as $date_key => $date_value){

        	$results = Sentence::select('user_id', DB::raw('count(*) as total'))
							->where('created_at', '>=', $date_value)
							->groupBy('user_id')
							->orderByRaw('COUNT(*) DESC')
							->limit($n)
							->get();

			$i = 1;

        	foreach($results as $result){
	        	try{
	        		DB::table('calc_top_contrib_stats')->insert([
	        			'user_id' => $result['user_id'],
	        			'timeframe' => $date_key,
	        			'sentence_count' => $result['total'],
	        			'position' => $i,
	        		]);
	        	}
	        	catch(exception $e){
	        		echo $e->getMessage();
	        	}
	        	$i++;
        	}
        }
    }
}