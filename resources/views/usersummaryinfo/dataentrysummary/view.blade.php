@extends('layouts.dashboard')
@section('style')
<style type="text/css">
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
.assigncompanyname,.totalallocated,.selectdate,.totalselectdate,.statusinfo{
  cursor:pointer;
 }
 #usersummaryrecord tbody td.assigncompanyname:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 #usersummaryrecord tbody td.unallocated:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
   
 #usersummaryrecord tbody td.totalallocated:hover {
       background-color: cadetblue;
       cursor: pointer;
   }
 .selectdate:hover,.totalselectdate:hover,.statusinfo:hover,.unassignselectdate:hover{
     background-color: cadetblue;
      cursor: pointer;
 }
.table>thead>tr>th {
      color:white;
      text-align: center !important;
       
  }
.ui-datepicker-calendar.year {
   display: none;
}

    table#usersummaryrecord td, th {
  position: relative;
  /*background: transparent ; */
 /* padding: 2px 4px !important;*/
  padding-left: 4px !important;
  padding-right: 4px !important;
  padding-top: 15px !important;
  padding-bottom: 15px !important;
 /* text-align: left;*/
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

.testact {
  color: red;
}

</style>
@endsection
@section('content')
    
@include('usersummaryinfo.dataentrysummary.content')

@endsection

@section('script')  

@include('usersummaryinfo.dataentrysummary.script')

@endsection