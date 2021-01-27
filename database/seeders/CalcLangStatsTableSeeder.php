<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Language;
use App\Models\Sentence;
use App\Models\Profile;




class CalcLangStatsTableSeeder extends Seeder
{
	public function run()
	{
		$languages = Language::where('ranking', '<=', 15)->get();

		foreach($languages as $lang){

			try{
				DB::table('calc_lang_stats')->insert([
					'lang_id' => $lang->id,
					'sentence_count' => Sentence::where('lang_id', $lang->id)->count(),
					'native_speaker_count' => Profile::where('native_lang', $lang->id)->get()->count(),
					// 'learner_count' => , // pending
					'top_contributor_id' => Sentence::select('user_id')
												->where('lang_id', $lang->id)
												->groupBy('user_id')
												->orderByRaw('COUNT(*) DESC')
												->limit(1)
												->first()['user_id'],
				]);
			}
			catch(exception $e){
				echo $e->getMessage();
			}
		}
	}
}