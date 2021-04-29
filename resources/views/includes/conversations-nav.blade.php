<?php 
// $messages_not_seen_ids = Session::get('messages_not_seen_ids'); 
?>

<div id="conversation-sidenav">

	<h1>Conversations</h1>

	@foreach($conversations as $c)
		<?php
			if($c->is_group_chat){
				$conversation_title = "group chat Z";
			}else{
				if($c->participants[0] == Auth::user()){
					$interlocutor = $c->participants[1];
				}else{
					$interlocutor = $c->participants[0];
				}
				$conversation_title = $interlocutor->first_name . " " . $interlocutor->last_name;
			}
		?>

		

		<div class="conversation-preview">
			<a href="/conversations/{{$c->slug}}">
				<span class="mimic-link"
							data-toggle="tooltip"
							data-placement="bottom"
							title="{{ $c->lastMsg->msg_body }}">
		    </span>
		  </a>
		  <div class="user-avatar">
		    <img src="{{ asset('img/profile-pics/default.png') }}" alt="Avatar" class="avatar">
		  </div>

		  <div class="main">
		  	<strong>{{ $conversation_title }}</strong>
		    
		    <small><a href="#" data-toggle="tooltip" data-placement="bottom"
		              title="{{ date('h:i A M d, Y', strtotime($c->lastMsg->created_at)) }}">
		      {{ date("H:i" , strtotime($c->lastMsg->created_at)) }}
		    </a></small>

		    <p class="last-msg-preview">{{ $c->lastMsg->msg_body }}</p>
		  </div>
		</div>
	@endforeach

</div>