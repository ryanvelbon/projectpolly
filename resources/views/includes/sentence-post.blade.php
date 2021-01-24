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
  	<i class="fas fa-thumbs-up"></i>
  	<i class="fas fa-thumbs-down"></i>
  	<i class="fas fa-heart"></i>
  	<i class="fas fa-bookmark"></i>
  	<i class="fas fa-share"></i>
  </div>
</div>