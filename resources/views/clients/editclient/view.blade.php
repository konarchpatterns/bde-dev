@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}
.form-controlselect {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
    padding: 5px 5px;
    height: 40px;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.designation,.description,.first,.last {
     text-transform: capitalize;
  }

</style>
@endsection

@section('content')
    
@include('clients.editclient.content')

@endsection

@section('script')  

@include('clients.editclient.script')

@endsection