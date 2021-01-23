@extends('layouts.master')



@section('title')

@endsection




@section('css')

@endsection




@section('content')
<div class="container language-menu">
  @foreach($languages as $language)
    <div class="optionContainer">
      <img class="optionImg" src="{{ asset('img/flags/png1000px/'.$language->code.'.png') }}" style="width:100%;">
      <div class="optionTxt">{{ $language->title }}</div>
    </div>
  @endforeach
</div>



@endsection



@section('jsBottom')

@endsection