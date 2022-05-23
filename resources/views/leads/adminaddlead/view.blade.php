@extends('layouts.dashboard')
@section('style')
<style type="text/css">
  .first,.last,.designation,.description {
     text-transform: capitalize;
  } {
     text-transform: capitalize;
  }

</style>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet">


@endsection

@section('content')
    
@include('leads.adminaddlead.content')

@endsection

@section('script')  

@include('leads.adminaddlead.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>

@endsection