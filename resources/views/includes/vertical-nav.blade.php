<div class="profile">
	<img src="{{ asset('img/profile-pics/john.jpeg') }}" alt="Avatar" class="avatar">
	@include('includes.profile-dropdown-menu')
</div>
<div class="side-menu">
	<a class="menu-link">
	  <div class="icon"><i class="fa fa-home"></i></div>
	  <div class="title">Home</div>
	</a>

	<a class="menu-link" href="{{ route('profile.index') }}">
	  <div class="icon"><i class="fa fa-user"></i></div>
	  <div class="title">Profile</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-comments"></i></div>
	  <div class="title">Messages</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-bell"></i></div>
	  <div class="title">Notifications</div>
	</a>

	<a class="menu-link" href="{{ route('community') }}">
	  <div class="icon"><i class="fa fa-users"></i></div>
	  <div class="title">Community</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-user-friends"></i></div>
	  <div class="title">Friends</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-book-reader"></i></div>
	  <div class="title">Learn</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-pencil-alt"></i></div>
	  <div class="title">Publish</div>
	</a>
</div>
<div class="footer-links">
	<nav>
		<a href="">Terms of Service</a>
		<a href="">Privacy Policy</a>
		<a href="">Cookie Policy</a>
		<a href="">Ads info</a>
		<a href="">More ...</a>
		<a href="">&copy; <?php echo date("Y"); ?> Project Polly, Inc.</a>
		<a href=""></a>
	</nav>
</div>