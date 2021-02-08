@extends('layouts.three-columns')

@section('title')
	Community
@endsection

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/community.css') }}">
  <meta name="_token" content="{{ csrf_token() }}">
@endsection



@section('leftColumn')
	@include('includes.vertical-nav')
@endsection


@section('centerColumn')
<div id="members">
	<!-- AJAX response -->
</div>
@endsection


@section('rightColumn')
<div>
  @include('includes.stats-table-1')
</div>
<!-- recommendations too -->
@endsection



















@section('jsBottom')
<script src="{{ asset('js/follow.js') }}"></script>
<script>
	function ajaxFetchMembers(n) {
		$.ajax({
			type: "GET",
			url: "/fetch-next-n-community-members",
			data: {
				n: n
			},
			success: function(response) {
				document.getElementById("members").innerHTML += response;
			},
			error: function(response) {
				console.log(response);
			}
		});
	}

	$(document).ready(function(){
	  ajaxFetchMembers(15);
	});


	$(window).scroll(function() {
	    if($(window).scrollTop() == $(document).height() - $(window).height()) {
	    	// document.getElementById("sentences-spinner").style.display = "block";
	    	ajaxFetchMembers(3);
	    }
	});
</script>
@endsection