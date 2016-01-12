@extends('html')

@section('metaTitle', 'About')

@section('bodyClass','about')

@section('content')

  @include('ajax.ajaxAboutNew')

@stop

@section('footJs')
  <script id="pageScript" src="http://local.lara/js/about.js"></script>
@stop
