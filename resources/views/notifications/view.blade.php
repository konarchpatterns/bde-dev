@extends('layouts.dashboard')
@section('style')
<style type="text/css">
  .card{
  width: 80%;
  height:calc(100vh - 160px);
}
.scrollable{
  overflow-y: auto;
  max-height:  calc(100vh - 250px);
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

/*#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}*/
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}
  table#notificationrecords td, th {
  position: relative;
  /*background: transparent ; */
 /* padding: 2px 4px !important;*/
 padding-left: 4px !important;
  padding-right: 4px !important;
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
  color:white;
 background-color: #565759;
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
   
   border-color: white;
}
#rolerecords_info{
  color: white;
}
</style>
@endsection

@section('content')
    
@include('notifications.content')

@endsection

@section('script')  

@include('notifications.script')

@endsection