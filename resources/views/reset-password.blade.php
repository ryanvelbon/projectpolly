@extends('layouts.master')

@section('title')
	Forgot Password
@endsection


@section('content')
<div class="container">
	<p>We'll send password reset instructions to the email address associated with your account.</p>
	<form method="POST" action="" class="form" role="form" autocomplete="off">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <div class="form-group">
	        <input type="email"
	        		 class="form-control"
	        		 name="email"
	        		 placeholder="Email address"
	        		 required>
	    </div>
		<div class="form-group">
	        <button type="submit" id="submit_btn" class="btn btn-success float-left">Reset Password</button>
	    </div>
	    <input type="hidden" name="token" value="{{ Session::token() }}">
	</form>
</div>
@endsection