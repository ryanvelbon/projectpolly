@extends('layouts.three-columns')

@section('title')
@endsection

@section('head')
	<meta name="_token" content="{{ csrf_token() }}">
@endsection


@section('leftColumn')
@endsection

<?php
	if($c->is_group_chat){
		
	}else{
		if($c->participants[0] == Auth::user()){
			$recipient = $c->participants[1];
		}else{
			$recipient = $c->participants[0];
		}
		$conversation_title = $recipient->username;
	}
?>


@section('centerColumn')
	<div class="conversation">
	    <div class="header">
	    	<h2>{{$conversation_title}}</h2>
	    </div>
	    <div class="body">
			@foreach($c->messages as $msg)
				@include('includes.message', ['msg' => $msg])
			@endforeach
	    </div>
	    <div class="footer">
	      <div class="input-group mb-3">
	        <textarea class="control-form" id="conversation-textarea"></textarea>
	        <div class="input-group-append">
	          <button class="btn btn-primary" type="button">Send</button>
	        </div>
	      </div>
	    </div>
	</div>
@endsection


@section('rightColumn')
@endsection



@section('jsBottom')
<script type="text/javascript">
  $('body').on('keydown input', '#conversation-textarea', function() {
    this.style.removeProperty('height');
    this.style.height = (this.scrollHeight+2) + 'px';
  });
</script>
@endsection