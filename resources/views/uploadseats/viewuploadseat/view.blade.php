@extends('layouts.dashboard')
@section('style')
<style type="text/css">
    table#seatrecords td, th {
  position: relative;
  /*background: transparent ; */
 /* padding: 2px 4px !important;*/
  padding-left: 4px !important;
  padding-right: 4px !important;
  padding-top: 10px !important;
  padding-bottom: 10px !important;
  /*text-align: left;*/
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
/*  border-top: 0px;*/
  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
   max-width: 300px !important;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;  
  color:black;
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
   
   border-color: white;
}
table.dataTable thead .sorting {
    background-image:none;

  }
#userwithrolesrecords_info{
  color: white;
}

</style>
@endsection
@section('content')
    
@include('uploadseats.viewuploadseat.content')

@endsection

@section('script')  

@include('uploadseats.viewuploadseat.script')

@endsection