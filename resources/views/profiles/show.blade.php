@extends('layouts.master')

@section('title')
	{{ $user->username }}
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/profiles/show.css') }}">
@endsection




@section('content')
<div class="container">
	<h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
	<p>{{ $user->username }}</p>

	<button type="button" class="follow-btn btn btn-outline-primary" value="{{ $user->id }}"><span>Follow</span></button>



	<div class="container">
		<br>
		<br>
		<nav class="profile-nav">
			<a data-id="overview" class="section-tab active">Overview</a>
			<a data-id="sentences" class="section-tab">Sentences</a>
			<a data-id="followers" class="section-tab">Followers</a>
			<a data-id="following" class="section-tab">Following</a>
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
	// sections----------------------------------------------------------------------------------------------------
	document.querySelectorAll('.section-tab')
	  .forEach(e => e.addEventListener('click', _ => change(e.dataset.id)))


	function change(x) {
	  let panels = document.querySelectorAll('.section-pane')
	  panels.forEach(p => p.classList.remove('active'))
	  document.getElementById(x).classList.add('active')
	}

	// follow buttons-------------------------------------------------------------------------------------------------
	$(".follow-btn").click(function(event) {

		event.preventDefault();

		var btn = this;

		$.ajax({
			type: "POST",
			url: "/update-follow",
			data: {
				id: $(this).val(),
				_token: "{{ csrf_token() }}"
			},
			success: function(response) {
				console.log(response);
				if(response['isFollowing']){
					$(btn).removeClass("btn-outline-primary not-following");
					$(btn).addClass("btn-primary following");
				}else{
					$(btn).removeClass("btn-primary following");
					$(btn).addClass("btn-outline-primary not-following");
				}
			},
			error: function(response) {
				console.log(response);
			}
		});
	});
</script>

@endsection