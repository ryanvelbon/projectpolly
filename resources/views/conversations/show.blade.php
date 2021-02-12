@extends('layouts.three-columns')

@section('title')
@endsection

@section('head')
	<meta name="_token" content="{{ csrf_token() }}">
@endsection


@section('leftColumn')
@endsection

@section('centerColumn')
	@foreach($c->messages as $msg)
		@include('includes.message', ['msg' => $msg])
	@endforeach
@endsection

@section('rightColumn')
@endsection








@section('jsBottom')
@endsection