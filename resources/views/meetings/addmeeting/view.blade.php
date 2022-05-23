@extends('layouts.dashboard')
@section('style')
<style type="text/css">

/*.ui-timepicker-container {
    position: relative !important;
}*/
.edit-container {

    background-color: #ececec;
}
input[type=text], textarea {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;
}

.ui-timepicker-container .ui-timepicker-standard {
    opacity: 0.5 !important;
}

/*.reminders-container {
    display: none;
}*/

</style>

@endsection

@section('content')
@include('pages.meetings.modals.assign_user_modal')
@include('meetings.addmeeting.content')

@endsection

@section('script')  

@include('meetings.addmeeting.script')

@endsection