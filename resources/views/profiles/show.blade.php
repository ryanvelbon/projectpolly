@extends('layouts.master')

@section('title')
	{{ $user->username }}
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profiles/show.css') }}">
@endsection




@section('content')
<div class="container">
	<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
	<p>{{ $user->username }}</p>



	<div class="container">
		<nav class="profile-nav">
			<a data-id="overview" class="section-tab active">Overview</a>
			<a data-id="sentences" class="section-tab">Sentences</a>
			<a data-id="followers" class="section-tab">Followers</a>
			<a data-id="following" class="section-tab">Following</a>
		</nav>
		<main>
			<div id="overview" class="section-pane active">Overview</div>
			<!-- SENTENCES-------------------------------------------------------------------------->
			<div id="sentences" class="section-pane">
				@if(count($user->sentences))
					@foreach ($user->sentences as $sentence)
						@include('includes.sentence-post', ['sentence' => $sentence, 'author' => $user])
					@endforeach
				@else
					<p>No sentences published yet.</p>
				@endif
			</div>
			<!-- FOLLOWERS------------------------------------------------------------------------------>
			<div id="followers" class="section-pane">
				<ul>
					@if(count($user->followers))
						@foreach ($user->followers as $follower)
							<li>
								<a href="/profile/{{$follower->username}}">
									{{ $follower->username }}
								</a>
							</li>
						@endforeach
					@else
						<p>No followers yet.</p>
					@endif
				</ul>
			</div>
			<!-- FOLLOWING------------------------------------------------------------------------------>
			<div id="following" class="section-pane">
				<ul>
					@if(count($user->following))
						@foreach ($user->following as $user_being_followed)
							<li>
								<a href="/profile/{{$user_being_followed->username}}">
									{{ $user_being_followed->username }}								
								</a>
							</li>
						@endforeach
					@else
						<p>No followers yet.</p>
					@endif
				</ul>
			</div>
		</main>
	</div>

</div>
@endsection

@section('jsBottom')

<script type="text/javascript">
	document.querySelectorAll('.section-tab')
	  .forEach(e => e.addEventListener('click', _ => change(e.dataset.id)))


	function change(x) {
	  let panels = document.querySelectorAll('.section-pane')
	  panels.forEach(p => p.classList.remove('active'))
	  document.getElementById(x).classList.add('active')
	}
</script>

@endsection