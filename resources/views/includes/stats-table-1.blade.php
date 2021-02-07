<h2>Top Contributors</h2>
<?php
	$results = \Illuminate\Support\Facades\DB::table('calc_top_contrib_stats')
							->where('timeframe', '=', 'this week')
							->orderByRAW('position ASC')
							->limit(5)
							->get();
?>
<table id="top-contributors-table" class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Member</th>
      <th scope="col">Published</th>
      <th scope="col">Language</th>

    </tr>
  </thead>
  <tbody>
  	@foreach($results as $result)
  		<?php 
  			$user = \App\Models\User::find($result->user_id);
  			$lang = \App\Models\Language::find($user->profile->native_lang);
  			$flag = \App\Helpers\Flag::getFlagForLanguage($lang->code);
  		?>
	    <tr>
	      <th scope="row">{{ $result->position }}</th>
	      <td>{{ $user->username }}</td>
	      <td>{{ $result->sentence_count }}</td>
	      <td><img class="flag-icon" src="{{ asset('img/flags/svg/'.$flag.'.svg') }}"></td>
	    </tr>   
	@endforeach
  </tbody>
</table>