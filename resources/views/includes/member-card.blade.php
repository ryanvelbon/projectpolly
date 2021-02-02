<div class="members-container">
	<div class="member-card">

		<?php
			$following_ids = Session::get('following_ids');
		?>

		<img class="profile-img" src="{{ asset('img/profile-pics/default.png') }}">

		<img class="flag-icon" src="{{ asset('img/flags/svg/mt.svg') }}">

		<a href="/profile/{{$member->username}}">
			{{ $member->username }}
		</a>

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