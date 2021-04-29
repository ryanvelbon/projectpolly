<div class="dropdown profile-dropdown">  
    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">  
        {{ Auth::user()->username }}
    </button>  
    <div class="dropdown-menu">  
    	<a class="dropdown-item" href="{{ route('profile.index') }}"><i class="fa fa-user"></i> Profile </a>  
        <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings & Privacy </a>  
        <a class="dropdown-item" href="#"> <i class="fa fa-question"></i> Help & Support </a>
        <a class="dropdown-item" href="{{ route('logout') }}"> <i class="fa fa-sign-out-alt"></i> Log Out </a>
        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> English </a>  
    </div>  
</div>