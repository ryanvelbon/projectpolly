<div class="card member-card-alt">

	<?php
		$following_ids = Session::get('following_ids');
	?>

	<div class="card-header">

		<!-- <img class="img-fluid" src="{{ asset('img/profile-pics/default.png') }}"> -->
		<img class="img-fluid" src="{{ asset('img/profile-pics/' . rand(1, 10) . '.jpg') }}">

		<!-- <img class="flag" src="{{ asset('img/flags/svg/mt.svg') }}" alt="flag-image"/> -->
		<img class="flag" src="{{ asset('img/flags/png250px/es.png') }}" alt="flag-image"/>

	</div>
	<div class="card-body">
		<h5 class="card-title">
			<a href="/profile/{{$member->username}}">
				{{ $member->username }}
			</a>
		</h5>
		<p class="card-text">Lorem ipsum factus est.</p>
		<button type="button"
			class="follow-btn btn 
				@if(in_array($member->id, $following_ids))
					btn-primary following
				@else
					btn-outline-primary not-following
				@endif"
			value="{{ $member->id }}"><span>Follow</span></button>
	</div>
</div>