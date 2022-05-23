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
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet">
@endsection

@section('content')
    
@include('leads.editlead.content')

@endsection

@section('script')  

@include('leads.editlead.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
@endsection