@extends('html')

@section('metaTitle', 'Work')

@section('bodyClass','work')

@section('content')

  @include('ajax.ajaxWorkList')

@stop

@section('footJs')
  <script id="pageScript" src="http://local.lara/js/work.js"></script>
@stop
