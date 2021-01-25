<div class="sentence-post">
  <div class="header">
    <?php $langFlag = \App\Helpers\Flag::getFlagForLanguage($sentence->lang->code) ?>
  	<strong>{{ $author->first_name }} {{ $author->last_name }}</strong>
  	<small><em>{{ $author->username }}</em></small>
    <img class="flag-icon" src="{{ asset('img/flags/svg/'.$langFlag.'.svg') }}">
  </div>
  <div class="body">
    {{ $sentence->body }}
  </div>
  <div class="footer">
  	<i id="like-btn-{{$sentence->id}}" class="like-btn fas fa-thumbs-up" data-sentence-id="{{ $sentence->id }}"></i>
  	<i id="dislike-btn-{{$sentence->id}}" class="dislike-btn fas fa-thumbs-down" data-sentence-id="{{ $sentence->id }}"></i>
  	<i class="fas fa-heart"></i>
  	<i class="fas fa-bookmark"></i>
  	<i class="fas fa-share"></i>
  </div>
</div>