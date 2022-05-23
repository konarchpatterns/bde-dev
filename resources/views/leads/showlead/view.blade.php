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
  /*color:white;*/
 background: transparent;
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
}
table#clientdispositionlog td, th {
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
  background: transparent;
  /*color:white;
 background-color: #565759;*/  
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
}
  table#clientrecords td, th {
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
   max-width: 300px !important;
   background: transparent;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;
 /* color:white;
 background-color: #565759;*/  
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
   background: transparent;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;
/*  color:white;
 background-color: #565759; */ 
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
}

h6{
    text-transform:capitalize;
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
width: 80%;
}
.Reco{
  width: 90%;
}
.Acti{
  width:90%;
}
.followupvisible{
  display: none;
}

.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.my-custom-scrollbar1 {
position: relative;
height: 450px;
overflow: auto;
}
.table-wrapper-scroll-y1 {
display: block;
}
.table>thead>tr>th {
     color:white;
     text-align: center !important;
  }
  table#dispositionlistitable thead th {
  background-color: #5D6D7E;
   text-align-last: center;
    color: white;
}
#dispositionlistitable_info{
  display: none;
}
table#clientlistitable thead th {
  background-color: #5D6D7E;
   text-align-last: center;
    color: white;
    font-weight: bold;
}
 table#clientlistitable td, th {
   position: relative;
   padding-left: 4px !important;
   padding-right: 4px !important;
   border-color: white;
   vertical-align: middle;
   overflow: hidden !important;
   text-overflow: ellipsis !important;
   font-size: 14px;
   clear: both;
   border-collapse: collapse;
   table-layout: fixed;
   word-wrap: break-word;
   white-space: nowrap !important;
   color:white;
   background-color: #5D6D7E;  
   border-color: white;
 }

  table#dispositionlistitable td, th {
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
   max-width: 70px !important;
 /*color: white !important;
  color: blue !important; */
  white-space: nowrap !important;
  background: transparent;
  /*color:white;
 background-color: #5D6D7E; */ 
  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
  border-color: white;
  }
</style>
@include('clients.clientmodal.clientinfoindisposition.style1')
@endsection
@section('content')
    
@include('leads.showlead.content')

@endsection

@section('script')  

@include('leads.showlead.script')

@endsection