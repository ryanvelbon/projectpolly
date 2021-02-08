<div class="sentence-post">
  <?php 

    $author = $sentence->user;

    $bookmark_ids = Session::get('bookmark_ids');

    $langFlag = \App\Helpers\Flag::getFlagForLanguage($sentence->lang->code);
    
    $row = $sentence->likes->where('user_id', '=', Auth::id())->first();


    /* Which is more optimal for loading current user's like/dislike and bookmark info per sentence:
          1. using session variables; or
          2. querying the datavase
     */

    if($row){
      $user_likes = (bool) $row->is_like;  
    }
  ?>
  <div class="user-avatar">
    <img src="{{ asset('img/profile-pics/' . rand(1, 10) . '.jpg') }}" alt="Avatar" class="avatar">
    <div class="flag-overlay">
      <img class="flag-icon" src="{{ asset('img/flags/svg/'.$langFlag.'.svg') }}">        
    </div>
  </div>

  <div class="main">
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

    <p>{{ $sentence->body }}</p>
  </div>
  <div class="footer">
    <div class="icon">
    	<i id="like-btn-{{$sentence->id}}"
          class="like-btn fas fa-thumbs-up 
            @if($row)
              @if($user_likes)
                active
              @endif
            @endif 
          "
          data-sentence-id="{{ $sentence->id }}"     
      ></i>
    </div>

    <div class="icon">
    	<i id="dislike-btn-{{$sentence->id}}"
          class="dislike-btn fas fa-thumbs-down
            @if($row)
              @if(!$user_likes)
                active
              @endif
            @endif
          "
          data-sentence-id="{{ $sentence->id }}"
      ></i>
    </div>

    <div class="icon">
  	  <i class="fas fa-comment"></i>
    </div>

    <div class="icon">
    	<i class="fas fa-bookmark
        @if(in_array($sentence->id, $bookmark_ids))
          active
        @endif
        " 
        data-sentence-id="{{ $sentence->id }}"></i>
    </div>
    <div class="icon">
  	   <i class="fas fa-share"></i>
    </div>
  </div>
</div>