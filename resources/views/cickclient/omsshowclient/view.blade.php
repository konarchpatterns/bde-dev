@extends('layouts.newdashbord')
@section('style')
<style type="text/css">
.form-control {
		    border: 1px solid #8294B8;
  }
.from-control-3 {
    border: none;
    border-bottom: 1px solid ;  
  }
input[type=time] {
     font-size: 12px;
}
span.spantext{
    font-size: 17px;
    font-weight: 775;
    color: #333333;

}
span.modalspantext{
    font-size: 12px;
    font-weight: 775;
    color: #333333;

}

.form-check .form-check-sign::before, .form-check .form-check-sign::after{
    font-size: 23px;
    margin-left: -23px;
}
.form-control:focus {
  box-shadow: 0 0 10px rgba(232, 126, 4, 1);
 /* padding: 3px 0px 3px 3px;*/
 /* margin: 5px 1px 3px 0px;*/
  border: 1px solid rgba(232, 126, 4, 1);
}
#collapseTwo{
  display: none;  
}
#collapseThree{
  display: none;  
}
.pagination{
   display: none;  
}
.dataTables_info{
     display: none;  
}
table.dataTable.no-footer {
     border-bottom: 1px solid #E3E3E3; 
}
label.labviewcolor{
    font-weight: bold;
  	color: #77B5CB;
}
.s{
 box-shadow: 2px 2px 5px #77B5CB;
}
.ts{
 text-shadow: 1px 2px 9px #737373;
 color: #242525;
}
.first,.last,.designation {
     text-transform: capitalize;
}
.description {
     text-transform: capitalize;
}
 
.active{
    color:#1B1B1B !important;
}
.btn3 {
        background-color: gray;
        color: black;
        height: 40px; 
        padding: 6px 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 0px 0px;
        cursor: pointer;
        border-radius: 1px;
        border: 1px solid #495057;
}
</style>

@endsection
@section('content')
    
@include('cickclient.omsshowclient.content')

@endsection

@section('script')  

@include('cickclient.omsshowclient.script')

@endsection