@extends('htmlAjax')

@section('metaTitle', 'Two')

@section('headCSS')
<style>

</style>
@stop

@section('content')
   <div id="main">
   @include('ajaxId')
   Not ajax
   </div>
@stop


@section('footJs')
<script>


</script>
@stop
