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
	<div id="conversation-container">
	    <div id="conv-header">
	    	<h2>{{$conversation_title}}</h2>
	    </div>
	    <div id="conv-body">
			@foreach($c->messages as $msg)
				@include('includes.message', ['msg' => $msg])
			@endforeach
	    </div>
	    <div id="conv-footer">
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

	$(document).ready(function() {
		// by default, scroll to the very bottom of conversation upon load
		var myDiv = document.getElementById('conv-body');
		myDiv.scrollTop = myDiv.scrollHeight;
	});

	$('#conv-body').on('scroll', function() {
		if($(this).scrollTop() == 0){
	  		$.ajax({
	  			type: "GET",
	  			url: "/fetch-prev-n-messages",
	  			data: {
	  				n: 5
	  			},
	  			success: function(response) {
	          		// prepend data to the div
	  				this.innerHTML = response + this.innerHTML;
	  			},
	  			error: function(response) {
	  				console.log(response);
	  			}
	  		});
		}
	});
</script>
@endsection