<div class="sentence-post">
  <div class="header">
    <?php 

      $langFlag = \App\Helpers\Flag::getFlagForLanguage($sentence->lang->code);
      $row = $sentence->likes->where('user_id', '=', Auth::id())->first();

      if($row){
        $user_likes = (bool) $row->is_like;  
      }
    ?>
  	<a href="profile/{{$author->username}}">
      <strong>{{ $author->first_name }} {{ $author->last_name }}</strong>
    	<small><em>{{ $author->username }}</em></small>
    </a>
    <span>.</span>
    <small><time datetime="2021-01-26T11:25:23.000Z">
    </time></small>
    <small><a href="#" data-toggle="tooltip" data-placement="bottom"
              title="{{ date('h:i A M d, Y', strtotime($sentence->created_at)) }}">
      {{ date('M d', strtotime($sentence->created_at)) }}
    </a></small>

    <img class="flag-icon" src="{{ asset('img/flags/svg/'.$langFlag.'.svg') }}">
  </div>
  <div class="body">
    {{ $sentence->body }}
  </div>
  <div class="footer">
  	<i id="like-btn-{{$sentence->id}}"
        class="like-btn fas fa-thumbs-up"
        data-sentence-id="{{ $sentence->id }}"
        @if($row)
          @if($user_likes)
            style="color: var(--like)" 
          @endif
        @endif      
    ></i>

  	<i id="dislike-btn-{{$sentence->id}}"
        class="dislike-btn fas fa-thumbs-down"
        data-sentence-id="{{ $sentence->id }}"
        class="like-btn fas fa-thumbs-up"
        data-sentence-id="{{ $sentence->id }}"
        @if($row)
          @if(!$user_likes)
            style="color: var(--dislike)" 
          @endif
        @endif
    ></i>
  	<i class="fas fa-heart"></i>
  	<i class="fas fa-bookmark"></i>
  	<i class="fas fa-share"></i>
  </div>
</div>