@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}


table#company th {
  border: 1px solid black;
  color: white;
  text-align: center;
  border-color:#D2B48C; 
}
table#company  td{
  border: 1px solid black;
  color: white;
  text-align: center;
  border-color:#D2B48C; 
}
</style>
@endsection

@section('content')
    
@include('users.showuserrole.content')

@endsection

@section('script')  

@include('users.showuserrole.script')

@endsection