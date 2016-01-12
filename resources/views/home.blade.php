@extends('HTML')

@section('metaTitle', null)

@section('bodyClass','home')

@section('content')
  @include('ajax.ajaxHomeNew')
@stop

@section('footJs')
  <script id="pageScript" src="http://local.lara/js/home.js"></script>
@stop
