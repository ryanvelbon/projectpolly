<div class="profile-area-foobar">
	<img src="{{ asset('img/profile-pics/john.jpeg') }}" alt="Avatar" class="avatar">
    <div class="dropdown">  
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">  
            {{ Auth::user()->username }}
        </button>  
        <div class="dropdown-menu">  
            <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings & Privacy </a>  
            <a class="dropdown-item" href="#"> <i class="fa fa-question"></i> Help & Support </a>
            <a class="dropdown-item" href="#"> <i class="fa fa-sign-out-alt"></i> Log Out </a>
            <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> English </a>  
        </div>  
    </div>
</div>
<div class="side-menu">
	<a class="menu-link">
	  <div class="icon"><i class="fa fa-home"></i></div>
	  <div class="title">Home</div>
	</a>

	<a class="menu-link">
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

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-users"></i></div>
	  <div class="title">Community</div>
	</a>

	<a class="menu-link">
	  <div class="icon"><i class="fa fa-user-friends"></i></div>
	  <div class="title">Friends</div>
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