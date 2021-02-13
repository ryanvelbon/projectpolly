<?php
  $current_user = Auth::user();
  $native_lang = $current_user->profile->native_lang;
?>


@extends('layouts.three-columns')


@section('title')
	Dashboard
@endsection


@section('head')
	<!-- Temporarily deleted. All styling is being implemented in main.scss -->
@endsection


@section('leftColumn')
	@include('includes.vertical-nav')
@endsection


@section('centerColumn')
<section id="publish-sentence">
  <form name="publishSentenceForm" method="POST" action="/sentences">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="nativeLang" value="{{$native_lang}}">
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
    <!-- HTML generated via AJAX -->
</section>
<div id="sentences-spinner" class="spinner">LOADING</div>
@endsection


@section('rightColumn')
<div>
  @include('includes.stats-table-2')
</div>
@endsection


@if(!$native_lang)
  @include('includes.profile-setup', ['languages' => $languages])
@endif


@section('jsBottom')
  <script src="{{ asset('js/publish-sentence.js') }}"></script>
  <script src="{{ asset('js/sentence.js') }}"></script>
  @if(!$native_lang)
    <script src="{{ asset('js/profile-setup.js') }}"></script>
  @endif

  <script>

  function fetchAndRenderNextSentences(n) {
    $.ajax({
      type: "GET",
      url: "/fetch-next-n-sentences",
      data: {
        n: n
      },
      success: function(response) {
        // append data to the div
        document.getElementById("sentences").innerHTML += response;
      },
      error: function(response) {
        console.log(response);
      }
    });
  }

  $(document).ready(function() {
    fetchAndRenderNextSentences(20);
  });

  $(window).scroll(function() {
      if($(window).scrollTop() == $(document).height() - $(window).height()) {

      	// make loading icon visible
      	document.getElementById("sentences-spinner").style.display = "block";

      	// AJAX request data from server
        fetchAndRenderNextSentences(10);
      }
  });
  </script>
@endsection