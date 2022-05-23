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
</style>
@endsection
@section('content')
    
@include('usersummaryinfo.showdataentryusersummary.content')

@endsection

@section('script')  

@include('usersummaryinfo.showdataentryusersummary.script')

@endsection