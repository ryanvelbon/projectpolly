<div class="msg-container 
	@if($msg->user_id==Auth::id())
		is-current-user
	@endif
	">
	<div class="msg">
		{{$msg->msg_body}}
		<span class="sent_at">{{date('H:i', strtotime($msg->created_at))}}</span>
	</div>      
</div>