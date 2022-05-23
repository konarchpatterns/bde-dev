@extends('layouts.dashboard')
@section('style')
<style type="text/css">
	.modal.fade:not(.in).right .modal-dialog {
    -webkit-transform: translate3d(35%, 0, 0);
    transform: translate3d(35%, 0, 0);
}

  .form-check .form-check-sign1::after{
    color:#FE5961;
  }
  .form-check .form-check-sign1::before{
    color:#FE5961;
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
.form-check .form-check-label {
    display: inline-block;
    position: relative;
    cursor: pointer;
    padding-left: 35px;
    line-height: 20px;
    margin-bottom: inherit;
    text-transform: capitalize;
}
.followupvisible{
  display: none;
}

</style>
@endsection
@section('content')
    
@include('users.adduser.content')

@endsection

@section('script')  

@include('users.adduser.script')

@endsection