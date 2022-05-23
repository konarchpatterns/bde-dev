@extends('layouts.dashboard')
@section('style')
<style type="text/css">
  table#dispositionlog td, th {
  position: relative;
 /* background: transparent ; */
 /* padding: 2px 4px !important;*/
 padding-left: 4px !important;
  padding-right: 4px !important;
  /*text-align: left;*/
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
 /* border-top: 0px;*/
  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
   max-width: 200px !important;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;
  color:black; 
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
}
  table#activitylog td, th {
  position: relative;
 /* background: transparent ; */
 /* padding: 2px 4px !important;*/
 padding-left: 4px !important;
  padding-right: 4px !important;
  /*text-align: left;*/
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
 /* border-top: 0px;*/
  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
   max-width: 200px !important;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;
  color:black;
 
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
}


.btn3d {
  position: relative;
  top: -6px;
  border: 0;
  transition: all 40ms linear;
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: 2px; 
  margin-right: 2px;
}

.btn3d:active:focus,
.btn3d:focus:hover,
.btn3d:focus {
  -moz-outline-style: none;
  outline: medium none;
}

.btn3d:active,
.btn3d.active {
  top: 2px;
}
.btn3d.btn-default {
  color: #666666;
  box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #BEBEBE, 0 8px 8px 1px rgba(0, 0, 0, .2);
  background-color: #f9f9f9;
}

.btn3d.btn-default:active,
.btn3d.btn-default.active {
  color: #666666;
  box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
  background-color: #f9f9f9;
}
.No{
width: 60%;
}
.followupvisible{
  display: none;
}
</style>
@include('clients.clientmodal.clientinfoindisposition.style1')
@endsection
@section('content')
    
@include('clients.showclient.content')

@endsection

@section('script')  

@include('clients.showclient.script')

@endsection