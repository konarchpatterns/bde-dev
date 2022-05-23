@extends('layouts.dashboard')
@section('style')
<style type="text/css">
</style>
@endsection

@section('content')
@include('meetings.viewmeeting.content')
@endsection

@section('script')  
@include('meetings.viewmeeting.script')
@endsection