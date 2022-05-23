@extends('layouts.dashboard')
@section('style')
<style type="text/css">
  .first,.last,.designation {
     text-transform: capitalize;
  }
  .description {
     text-transform: capitalize;
  }
</style>
@endsection
@section('content')
    
@include('company.addcompany.content')

@endsection

@section('script')  

@include('company.addcompany.script')

@endsection