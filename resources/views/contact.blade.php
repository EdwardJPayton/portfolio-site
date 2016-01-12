@extends('HTML')

@section('metaTitle', 'Contact')

@section('bodyClass','contact')

@section('content')
  @include('ajax.ajaxContact')
@stop

@section('footJs')
  <script id="pageScript" src="http://local.lara/js/contact.js"></script>
@stop
