@extends('layouts.three-columns')

@section('title')
	{{ $user->username }}
@endsection

@section('head')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profiles/show.css') }}">
	<meta name="_token" content="{{ csrf_token() }}">
@endsection



@section('centerColumn')
<div class="container">
	<h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
	<p>{{ $user->username }}</p>

	
	@if( $user->id == Auth::id() )
		<button type="button" class="btn btn-outline-primary">Edit Profile</button>
	@else
		<button type="button" class="follow-btn btn btn-outline-primary" value="{{ $user->id }}"><span>Follow</span></button>
	@endif



	<div class="container">
		<br>
		<br>
		<nav class="profile-nav">
			<a data-id="overview" class="section-tab active">Overview</a>
			<a data-id="sentences" class="section-tab">Sentences</a>
			@if( $user->id == Auth::id() )
				<a data-id="bookmarks" class="section-tab">Bookmarks</a>
			@endif
			<a data-id="followers" class="section-tab">Followers</a>
			<a data-id="following" class="section-tab">Following</a>
			<a data-id="tags" class="section-tab">Tags</a>
			<a data-id="badges" class="section-tab">Badges</a>

		</nav>
		<main>
			<div id="overview" class="section-pane active">
				<table class="table table-hover table-dark">
					<tr>
						<th>Native Language</th>
						<td>{{ $profile->language }}</td>
					</tr>
					<tr>
						<th>Age</th>
						<td>{{ $profile->age }}
							@if($profile->gender == 'm')
								<i class="fas fa-male"></i>
							@elseif($profile->gender == 'f')
								<i class="fas fa-female"></i>
							@else
							@endif
						</td>
					</tr>
					<tr>
						<th>Member since</th>
						<td>{{ date('M d, Y', strtotime($profile->member_since)) }}</td>
					</tr>
				</table>
			</div>
			<!-- SENTENCES-------------------------------------------------------------------------->
			<div id="sentences" class="section-pane">
				@if(count($user->sentences))
					@foreach ($user->sentences as $sentence)
						@include('includes.sentence-post', ['sentence' => $sentence])
					@endforeach
				@else
					<p>No sentences published yet.</p>
				@endif
			</div>
			<!-- BOOKMARKS------------------------------------------------------------------------------>
			<div id="bookmarks" class="section-pane">
				@if($user->id == Auth::id())
					@if(count($user->bookmarks))
						@foreach ($user->bookmarks as $bookmark)
							@include('includes.sentence-summary', ['sentence' => $bookmark])
						@endforeach
					@else
						<p>This is where your bookmarked sentences will appear.</p>
					@endif
				@endif
			</div>
			<!-- FOLLOWERS------------------------------------------------------------------------------>
			<div id="followers" class="section-pane">
				<ul>
					@if(count($user->followers))
						@foreach ($user->followers as $follower)
							@include('includes.member-card', ['member' => $follower])
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
							@include('includes.member-card', ['member' => $user_being_followed])
						@endforeach
					@else
						<p>Not following anyone yet.</p>
					@endif
				</ul>
			</div>
		</main>
	</div>

</div>
@endsection

@section('jsBottom')

<script type="text/javascript">
	// sections----------------------------------------------------------------------------------------------------
	document.querySelectorAll('.section-tab')
	  .forEach(e => e.addEventListener('click', _ => change(e.dataset.id)))


	function change(x) {
	  let panels = document.querySelectorAll('.section-pane')
	  panels.forEach(p => p.classList.remove('active'))
	  document.getElementById(x).classList.add('active')
	}
</script>



<script src="{{ asset('js/follow.js') }}"></script>
<script src="{{ asset('js/sentence.js') }}"></script>

@endsection