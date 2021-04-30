
@extends('layouts.three-columns')

@section('title')
@endsection


@section('leftColumn')
	@include('includes.conversations-nav', ['conversations' => $conversations])
@endsection


@section('centerColumn')
	<h1>Welcome to your Inbox</h1>
	@if(!$conversations)
		<h2>Inbox is empty</h2>
	@endif
@endsection


@section('rightColumn')
@endsection



@section('jsBottom')
@endsection