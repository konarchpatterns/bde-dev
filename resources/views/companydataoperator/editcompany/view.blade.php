@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}
.companyname,.description {
     text-transform: capitalize;
  }
</style>
@endsection

@section('content')
    
@include('companydataoperator.editcompany.content')

@endsection

@section('script')  

@include('companydataoperator.editcompany.script')

@endsection