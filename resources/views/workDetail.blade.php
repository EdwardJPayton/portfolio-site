@extends('html')

@section('metaTitle', $projectArr['title'])

@section('bodyClass','work')

@section('content')
    @include('ajax.ajaxWorkDetail')
@stop

@section('footJs')
  <script id="pageScript" src="http://local.lara/js/work.js"></script>
@stop