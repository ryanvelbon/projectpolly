@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('css')
	<!-- Temporarily deleted. All styling is being implemented in main.scss -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endsection




@section('content')




<!-- include('includes.filter-menu') -->
<!-- include('includes.statistics', []) -->


<div id="dashboard">
  <!---------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
  <div id="left-column">
  	@include('includes.vertical-nav')
  </div>
  <!---------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
  <div id="center-column">
		<section id="publish-sentence">
			<form name="publishSentenceForm" method="POST" action="/sentences">
				<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="nativeLang" value="{{Auth::user()->profile->native_lang}}">
				<div class="form-group">
					<textarea class="form-control" name='new-sentence' id="new-sentence"
							 rows="5" placeholder="write a sentence here" spellcheck="false"></textarea>
				</div>
				<div id="char-count-div">
					<span id="char-count">0</span>
					<span>/</span>
					<span id="char-max">255</span>
				</div>
				<button type="submit" id="publishSentenceBtn" class="btn btn-primary btn-lg">Publish</button>
				<input type="hidden" name="token" value="{{ Session::token() }}">
			</form>
		</section>
		<section id="sentences">
				<h2>Today's contributions</h2>
				@foreach ($sentences as $sentence)
					@include('includes.sentence-post', ['sentence' => $sentence])
				@endforeach
		</section>
		<div id="sentences-spinner" class="spinner">LOADING</div>
  </div>
  <!---------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
  <div id="right-column">
	  <div>
	  	A
	  </div>
	  <div>
	  	B
	  </div>
	  <div>
	  	@include('includes.stats-table-1')
	  </div>
	  <div>
	  	@include('includes.stats-table-2')
	  </div>
  </div> 
</div>












@include('includes.profile-setup', ['languages' => $languages])



@endsection

@section('jsBottom')
<script src="{{ asset('js/publish-sentence.js') }}"></script>
<script src="{{ asset('js/sentence.js') }}"></script>
<script src="{{ asset('js/profile-setup.js') }}"></script>

<script>
$(window).scroll(function() {
	// if($('body').scrollTop() + $(window).height() == $('body').height()) {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {

    	// make loading icon visible
    	document.getElementById("sentences-spinner").style.display = "block";

    	// AJAX request data from server
		$.ajax({
			type: "GET",
			url: "/fetch-next-n-sentences",
			data: {
				n: 3
			},
			success: function(response) {
				document.getElementById("sentences").innerHTML += response;
			},
			error: function(response) {
				console.log(response);
			}
		});

    	// append data to the div


    }
});
</script>

@endsection