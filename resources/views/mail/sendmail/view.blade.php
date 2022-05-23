@extends('layouts.dashboard')
@section('style')



@endsection

@section('content')
    
@include('mail.sendmail.content')

@endsection

@section('script')  

@include('mail.sendmail.script')

@endsection