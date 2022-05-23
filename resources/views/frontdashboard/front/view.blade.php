@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	table th,td {
  border: 1px solid black;
  color: white;
  text-align: center;
  border-color:#D2B48C; 
}
</style>
@endsection

@section('content')
    
@include('frontdashboard.front.content')

@endsection

@section('script')  

@include('frontdashboard.front.script')

@endsection