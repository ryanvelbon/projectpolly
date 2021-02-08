@extends('layouts.three-columns')

@section('title')
	Community
@endsection

@section('head')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/community.css') }}">
  <meta name="_token" content="{{ csrf_token() }}">
@endsection



@section('leftColumn')
	filters
@endsection


@section('centerColumn')


  @foreach($members as $member)
    @include('includes.member-card-alt', ['member' => $member])
  @endforeach



@endsection


@section('rightColumn')
<div>
  @include('includes.stats-table-1')
</div>
<!-- recommendations too -->
@endsection



















@section('jsBottom')
  <script src="{{ asset('js/follow.js') }}"></script>
@endsection