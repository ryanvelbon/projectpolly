@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('css')
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}"> -->
@endsection




@section('content')
<div class="container">
	<section class="row post-a-sentence">
		<div class="col-md-6 col-md-offset-3">
			<!-- onsubmit="return validatePublishSentenceForm()" -->
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
				<button type="submit" id="publishSentenceBtn" class="btn btn-primary">Publish</button>
				<input type="hidden" name="token" value="{{ Session::token() }}">
			</form>
		</div>
	</section>
	<section class="row sentences">
		<div class="col-md-6 col-md-offset-3">
			<header><h2>Today's contributions</h2></header>
			@foreach ($sentences as $sentence)
				@include('includes.sentence-post', ['sentence' => $sentence, 'author' => $sentence->user])
			@endforeach
		</div>
	</section>
</div>

<div class="modal" id="nativeLangModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Cannot publish sentence. Complete your profile.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@endsection

@section('jsBottom')
<script src="{{ asset('js/post-a-sentence.js') }}"></script>
<script src="{{ asset('js/sentence.js') }}"></script>
@endsection