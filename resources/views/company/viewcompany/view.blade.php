@extends('layouts.dashboard')
@section('style')
<style type="text/css">

.inputBtnSection{
    display:inline-block;a
    vertical-align:top;
    font-size:0;
    font-family:verdana;
}
.disableInputField{
    display:inline-block;
    vertical-align:top;
    height: 27px;
    margin: 0;
    font-size:14px;
    padding:0 3px;
}

.fileUpload {
  position: relative;
  overflow: hidden;
    border:solid 1px gray;
    display:inline-block;
    vertical-align:top;
}
.uploadBtn{
    display:inline-block;
    vertical-align:top;
    background:rgba(0,0,0,0.5);
    font-size:14px;
    padding:0 10px;
    height:25px;
    line-height:22px;
    color:#fff;
}

.fileUpload input.upload {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
.Disp{
   width: 80%;
}
 /*input[type=file] {
   position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}*/

  table#compnyrecords td, th {
  position: relative;
  padding-left: 4px !important;
  padding-right: 4px !important;
  padding-top: 15px !important;
  padding-bottom: 15px !important;
  vertical-align: middle;
  overflow: hidden !important;
  text-overflow: ellipsis !important;

  font-size: 14px;
  clear: both;
  border-collapse: collapse;
  table-layout: fixed;
  word-wrap: break-word;
  max-width: 100px !important;

  white-space: nowrap !important;  
  color:black;
   border:1px #979DD6 solid;
  border-right: none;
  border-left: none;

  /*max-height: 1.1em ;
  border-collapse: separate;
   empty-cells: hide;*/
   
 /*  border-color: black;*/
}
table#compnyrecords tbody tr {
        background: transparent; 
    }
.No{
 width: 40%;
}
.Coun{
  width: 80%;
}
.Webs{
   width: 60%;
}
.Comp{
  width: 100%;
}
.User{
  width:50%;
}
.Phno{
   width: 80%;
}
.Stat{
   width: 60%;
}
.Assi{
    width: 60%;
}
.Emai{
   width: 80%;
}
.Time{
   width: 80%;
}


#userrecord_length > label {
  color: black;
}
.paginate_input {
   width: 30px;
    color: blue !important;
   font-weight: bold !important;
   font-style: 10px;
   font-weight: solid !important;

}


#compnyrecords_next{
 background-color: white;
  margin-left: 10px;
   margin-right: 10px;
}

#compnyrecords_previous{
  background-color: white;
   margin-left: 10px;
   margin-right: 10px;
}

.followupvisible{
  display: none;
}
.csvnotvisible{
  display: none;
}

</style>
@include('company.companymodal.companyinfoindisposition.style1')
@endsection
@section('content')
    
@include('company.viewcompany.content')

@endsection

@section('script')  

@include('company.viewcompany.script')

@endsection