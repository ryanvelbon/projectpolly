@extends('layouts.master')

@section('title')
	Sign Up
@endsection




@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-6 offset-md-3">
		    <span class="anchor" id="formRegister"></span>
		    <hr class="mb-5">

		    <a href="" class="btn btn-outline-primary btn-block" role="button">Sign up with Google</a>
		    <a href="" class="btn btn-outline-primary btn-block" role="button">Sign up with Facebook</a>

		    <hr class="mb-1">

		    <div class="card card-outline-secondary">
		        <div class="card-header">
		            <h3 class="mb-0">Sign Up</h3>
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
                        
		            <form method="POST" action="{{ route('signup') }}" class="form" role="form" autocomplete="off">
    					<input type="hidden" name="_token" value="{{ csrf_token() }}">

    					<div class="form-group">
							<div class="form-row">
								<div class="col">
				                    <input type="text" 
				                    		class="form-control" 
				                    		name="first_name" 
				                    		placeholder="First name" 
				                    		value="{{ old('first_name') }}"
				                    		required>
				                    @error('first_name')
				                    	<small class="text-danger">
				                    		{{ $message }}
				                    	</small>
				                    @enderror
								</div>
								<div class="col">
				                    <input type="text" 
				                    		class="form-control" 
				                    		name="last_name" 
				                    		placeholder="Last name" 
				                    		value="{{ old('last_name') }}"
				                    		required>
				                    @error('last_name')
				                    	<small class="text-danger">
				                    		{{ $message }}
				                    	</small>
				                    @enderror
								</div>
							</div>
						</div>

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
		                    <input type="text"
		                    		 class="form-control"
		                    		 name="username"
		                    		 placeholder="Username"
		                    		 value="{{ old('username') }}"
		                    		 required>
		                    @error('username')
		                    	<small class="text-danger">
		                    		{{ $message }}
		                    	</small>
		                    @enderror
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" name="password" placeholder="Create password" required>
		                    @error('password')
		                    	<small class="text-danger">
		                    		{{ $message }}
		                    	</small>
		                    @enderror
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" name="password_confirmation" placeholder="Verify password" required>
		                </div>
		                <div class="form-group">
		                    <button type="submit" id="submit_btn" class="btn btn-success btn-lg btn-block">Register</button>
		                </div>
		                <div>
		                	By clicking <em>Register</em>, you agree to our
		                	<a href="">terms of service</a>,
		                	<a href="">privacy policy</a> and
		                	<a href="">cookie policy</a>.
		                </div>
		                <div>
		                	<small>Already a member?</small>
		                	<a href="{{ route('login') }}" class="btn btn-link" role="button">Sign In</a>
		                </div>
		                <input type="hidden" name="token" value="{{ Session::token() }}">
		            </form>
		        </div>
		    </div>
		</div>
    </div>
</div>
@endsection