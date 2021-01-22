@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
@endsection




@section('content')
<div class="container">
	<section class="row post-a-sentence">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>Write a sentence!</h3></header>
			<form method="POST" action="/sentences">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<textarea class="form-control" name='new-sentence' id="new-sentence" rows="5" placeholder="write a sentence here"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Publish</button>
				<input type="hidden" name="token" value="{{ Session::token() }}">
			</form>
		</div>
	</section>
	<section class="row sentences">
		<div class="col-md-6 col-md-offset-3">
			<header><h3>Today's contributions</h3></header>
			<article class="sentence">
				<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
				<div class="info">
					Posted by sexobajt69 on 21 Feb 2021
				</div>
				<div class="interaction">
					<a href="">Like</a>
					<a href="">Dislike</a>
					<a href="">Edit</a>
					<a href="">Delete</a>
				</div>
			</article>
			@foreach ($sentences as $sentence)
				<article class="sentence">
					<p>{{ $sentence->body }}</p>
					<div class="info">
						Posted by {{ $sentence->user->username }} on {{ $sentence->created_at }}
					</div>
				</article>
			@endforeach
		</div>
	</section>
</div>
@endsection