@extends('layouts.master')

@section('title')
	Log In
@endsection




@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-6 offset-md-3">
		    <span class="anchor"></span>
		    <hr class="mb-5">

		    <div class="card card-outline-secondary">
		        <div class="card-header">
		            <h3 class="mb-0">Log In</h3>
		        </div>
		        <div class="card-body">
		        		@if ($errors->any())
                        	<div class="alert alert-danger" role="alert">
                        		<ul>
                        			@foreach ($errors->all() as $error)
                        				<li>{{ $error }}</li>
                        			@endforeach
                        		</ul>
                        	</div>
                        @endif
                        
		            <form method="POST" action="{{ route('login') }}" class="form" role="form" autocomplete="off">
    					<input type="hidden" name="_token" value="{{ csrf_token() }}">
		                <div class="form-group">
		                    <input type="email"
		                    		 class="form-control"
		                    		 name="email"
		                    		 placeholder="Email address"
		                    		 value="{{ old('email') }}"
		                    		 required>
		                    @error('email')
		                    	<small class="text-danger">
		                    		{{ $message }}
		                    	</small>
		                    @enderror
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" name="password" placeholder="Password" required>
		                    @error('password')
		                    	<small class="text-danger">
		                    		{{ $message }}
		                    	</small>
		                    @enderror
		                </div>
		                <div class="form-group">
		                    <button type="submit" id="submit_btn" class="btn btn-success btn-lg btn-block">Log in</button>
		                </div>
		                <div>
		                	<a href="{{ route('pwdReset') }}" class="btn btn-link" role="button">Forgot password?</a>
		                </div>
		                <div style="text-align: center">
		                	<small>Not a member yet?</small>
		                	<a href="{{ route('signup') }}" class="btn btn-link" role="button">Sign up</a>
		                </div>
		                <input type="hidden" name="token" value="{{ Session::token() }}">
		            </form>
		        </div>
		    </div>
		</div>
    </div>
</div>
@endsection