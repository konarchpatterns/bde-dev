@extends('layouts.dashboard')

@section('style')
<style type="text/css">
 
select {
  color: blue !important;
}

label {
  color: black !important;
}


table#comp-table td, th {
    position: relative;
  padding-left: 4px !important;
  padding-right: 4px !important;
  padding-top: 15px !important;
  padding-bottom: 15px !important;
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;

  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
  max-width: 100px !important;

  white-space: nowrap !important;  
  color:black;
   border:1px #979DD6 solid;
  border-right: none;
  border-left: none; 
  
}
 .followupvisible{
  display: none;
}   
.Comp{

   width: 100% !important;
  
}
.Phon{

   width: 100% !important;
}
.Stat{

   width: 100% !important;
  
}
.Coun{

   width: 100% !important; 
}
.Time{

   width: 100% !important;  
}
.Disp{

   width: 100% !important;  
}
.Clie{
   width: 100% !important; 
}
.User{

   width: 100% !important;  
}
.Assi{

   width: 100% !important;  
}
</style>

@endsection

@section('content')
      @include('clicknewcompany.viewnewcompany.content')
      @include('cickclient.clickclientmodal.assignusermodal.content')
@endsection



@section('script')
      @include('clicknewcompany.viewnewcompany.script')
      @include('cickclient.clickclientmodal.assignusermodal.script')
@endsection