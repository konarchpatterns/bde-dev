@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}
.designation,.description {
     text-transform: capitalize;
  }
</style>
@endsection

@section('content')
    
@include('clients.addclient.content')

@endsection

@section('script')  

@include('clients.addclient.script')

@endsection