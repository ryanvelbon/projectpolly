@extends('layouts.master')



@section('content')
<div id="column-container">
  <div id="left-column">
    @yield('leftColumn')
  </div>
  <div id="center-column">
    @yield('centerColumn')
  </div>
  <div id="right-column">
    @yield('rightColumn')
  </div> 
</div>
@endsection