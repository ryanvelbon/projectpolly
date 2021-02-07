<h2>Popular Languages</h2>
<table id="popular-languages-table" class="table table-hover table-dark">
  <thead>
    <tr>
      <th colspan="2">Language</th>
      <th scope="col">Sentences</th>
      <th scope="col">Native Speakers</th>
      <th scope="col">Learners</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($lang_stats as $item)
  		<?php 
  			$lang = \App\Models\Language::find($item->lang_id);
  			$flag = \App\Helpers\Flag::getFlagForLanguage($lang->code);
  		?>
	    <tr>
	      <td><img class="flag-icon" src="{{ asset('img/flags/svg/'.$flag.'.svg') }}"></td>
	      <td>{{ $lang->title }}</td>
	      <td>{{ $item->sentence_count }}</td>
	      <td>{{ $item->native_speaker_count }}</td>
	      <td>{{ $item->learner_count }}</td>
	    </tr>
	@endforeach
  </tbody>
</table>