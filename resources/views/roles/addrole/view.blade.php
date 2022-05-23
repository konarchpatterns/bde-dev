@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	table#roles th {
  border: 1px solid black;
  color: black;
  text-align: center;
  border-color:black; 
}
table#roles  td{
  border: 1px solid black;
  color: black;
  text-align: center;
  border-color:black; 
}
.form-check .form-check-label {
    display: inline-block;
    position: relative;
    cursor: pointer;
    padding-left: 35px;
    line-height: 20px;
    margin-bottom: inherit;
    text-transform: capitalize;
}
</style>
@endsection

@section('content')
    
@include('roles.addrole.content')

@endsection

@section('script')  

@include('roles.addrole.script')

@endsection