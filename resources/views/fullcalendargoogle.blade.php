@extends('layouts.calanderdashboard')

@section('style')
<style type="text/css">

  .form-check .form-check-sign::after{
    color:#2A2826;
  }
  .form-check .form-check-sign::before{
    color:#2A2826;
  }
  #companyrecords_info{
    display: none;
  }
  .modal.fade:not(.in).tt .modal-dialog {
    -webkit-transform: translate3d(25%, 0, 0);
    transform: translate3d(25%, 0, 0);
}

</style>
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 -->

<!-- <link href="{{ asset('fullcalendar/fullcalendar.css')}}" rel="stylesheet"> -->
<link href="{{ asset('fullcalendar/css/fullcalendar.print.css')}}" rel="stylesheet" media="print">

<link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css')}}" />
<link rel="stylesheet" href="{{ asset('fullcalendar/css/jquery.qtip.min.css')}}" />

<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" /> -->

<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
 -->

 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

 <style type="text/css">

   .dialogbtn {
    background-color: #D3D3D3;
   }

.mycontent {
    font-family: 'Open Sans',sans-serif;
    font-size: 14px;
    line-height: 1.36;
    color: #333;
    background-color: #ececec;

}
.addgtextbox{
   display: none;
}
.addutextbox{
   display: none;
}

 box-shadow: 5px 5px 10px #D2B48C;
}
.sr{
 box-shadow: 2px 2px 5px #D2B48C;
}
.ts{
 text-shadow: 1px 2px 10px black;
}
.tsemail{
 text-shadow: 1px 2px 10px #D2B48C;
}
.btn3d {
  position: relative;
  top: -6px;
  border: 0;
  transition: all 40ms linear;
  margin-top: 10px;
  margin-bottom: 10px;
  margin-left: 2px;
  margin-right: 2px;
}

.btn3d:active:focus,
.btn3d:focus:hover,
.btn3d:focus {
  -moz-outline-style: none;
  outline: medium none;
}

.btn3d:active,
.btn3d.active {
  top: 2px;
}
.btn3d.btn-default {
  color: #666666;
  box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 2px rgba(255, 255, 255, 0.10) inset, 0 8px 0 0 #BEBEBE, 0 8px 8px 1px rgba(0, 0, 0, .2);
  background-color: #f9f9f9;
}

.btn3d.btn-default:active,
.btn3d.btn-default.active {
  color: #666666;
  box-shadow: 0 0 0 1px #ebebeb inset, 0 0 0 1px rgba(255, 255, 255, 0.15) inset, 0 1px 3px 1px rgba(0, 0, 0, .1);
  background-color: #f9f9f9;
}
 div.ui-datepicker{
 font-size:12px;
}
.followupvisible{
  display: none;
}
 </style>

@endsection


@section('content')

<div class="row mr-1 ml-1">
    <table width="100%" >   
     <tr>
      @if ($errors->any())
     <script type="text/javascript">
      var users =  {!! json_encode($errors->all()) !!};
        var result = [];
        for(var i in users){  
            result.push([users [i]]); 
          }
            result=result.join("\n");
                            swal({
                                text: " "+result+"",
                                icon: "error",
                                //buttons: true,
                                //dangerMode: true,
                            });
      </script>
      @endif
    <td  valign="top">
        <label class="mt-2" style="color:#4d5ec8">Google Calendar</label>
        <a class="btn btn-primary mt-1" id="createdirectevent">+ Create</a>
       <div id="datepicker" class="mt-1 pt-3"></div>
        <a href="{{route('localeventindex1')}}" class="btn  btn-primary mt-3" id="patternsevent"><i class="fa fa-refresh" aria-hidden="true"></i> Local Event</a>
    <table class="mt-1 ml-0" align="">

    <table class="mt-1 ml-0" align="">
    <tr>
    <td> <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="event" checked="checked" id="e1">
            <span class="form-check-sign"></span>
        </label>
    </div></td><td style=" font-weight: bold;">Events</td>
    </tr>
    <tr>
    <td> <div class="form-check">
        <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="task" checked="checked" id="e2" >
            <span class="form-check-sign" ></span>   
        </label>
    </div></td><td style=" font-weight: bold;">Tasks</td>
    </tr>
   @role('admin')
         <tr>
              <select class="form-control mt-2" id="user_selector">
                <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                @foreach($userdatas as  $userdata )
                   @if($userdata->name == "Nouser" || $userdata->name == Auth::user()->name)
                   @else
                    <option value="{{$userdata->id}}">{{$userdata->name}}</option>
                   @endif
                @endforeach
              </select>
        </tr> 
    @endrole
    @role('bde')
        <tr>
              <select class="form-control mt-2" id="user_selector">
              <option value="{{Auth::user()->id}}">{{Auth::user()->name}}</option>
                @foreach($userdatas as  $userdata)
                  @if($userdata->name == "Nouser" || $userdata->name == Auth::user()->name)
                  @else
                    <option value="{{$userdata->id}}">{{$userdata->name}}</option>
                  @endif
                @endforeach
              </select>
        </tr> 
      @else
         <input type="hidden" name="uservalue" value="{{Auth::user()->id}}" id="user_selector">
    @endrole
 
       
  

    </table>
<!-- <div class="e1Div">
    <input type="checkbox" checked="checked" name="event" id="e1" value="event" />
    <label for="e1">Event</label>
</div> -->
<!-- <div class="e2Div">
    <input type="checkbox" checked="checked" name="task" id="e2" value="task" />
    <label for="e2">Task</label>
</div>
 --><!-- <div class="e3Div">
    <input type="checkbox" checked="checked" name="e3" id="e3" value="holiday" />
    <label for="e3">Holiday</label>
</div> -->
 <!--    </div> -->
    </td>
    <td width="100%">
<!--    <div class="col-md-12"> -->
        <div id="calendar" class="ml-1 mt-1">
   <!--  </div> -->
        </div>
    </td>
    
    </tr>
    </table>

</div>
<div class="container mycontent">
    
    
    <!--     <div class="col-md-10 col-md-offset-4">
            <div class="panel panel-default"> -->
           <!--      <div class="panel-heading">Calendar</div> -->

                <!-- <div   class="panel-body">
               
                     <div class="response"></div>
                     <div id="calendar"></div>
                </div> -->

                <div class="modal fade right" id="eventDialog" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="modelHeading"></h4>
                                  <label id="closeeventbox" class="btn btn-sm btn-fill btn-danger">X</label>
                            </div>

                            <div class="modal-body">
                     
                         <form action="{{route('gcalendar.store')}}" method="post" class="formclass" onsubmit="return checkeventForm(this);">
                             @csrf
                        <div class="row">
                            <div class="col-md-3 pr-1">
                              <label>Title:</label>
                            
                            <input id='title' name='title' class="form-control mt-0 field eventtext" type="text" value=""></input>
                             </div>
                           
                             <div class="col-md-3 px-1">
                                 <label>Start Date:</label>
                                     <input id='start_date' name='start_date' class="form-control mt-0 field "
                                      type="text" value="" autocomplete="off"   onfocusout="Checkstattdate()"required=""></input>
                                       
                             </div>
                             <div class="col-md-3 px-1">
                                 <label>End Date:</label>
                                     <input data-date-format="DD-MM-YYYY HH:mm:ss" id="end_date" name='end_date' class="form-control mt-0 field eventtext"
                                      type="text" value="" autocomplete="off" onfocusout="myFunctionenddatematch()"   required="" ></input>
                                      
                             </div>
                             <div class="col-md-3 pl-1">
                                 <label>Time Zone:</label>
                                    <!--  <input id='time_zone' name='time_zone' class="form-control mt-0 eventtext"
                                      type="text" value=""></input> -->
                                  <select class="form-control mt-0" id="timezoneid" name="time_zone">
                                      <option>(GMT+05:30) India Standard Time - Kolkata</option>
                                      <option>(GMT-10:00) Hawaii-Aleutian Standard Time </option>
                                      <option>(GMT-09:00) Alaska Time - Anchorage</option>
                                      <option>(GMT-08:00) Pacific Time - Los Angeles</option>
                                      <option>(GMT-07:00) Mountain Standard Time - Creston</option>
                                      <option>(GMT-06:00) Central Standard Time - Guatemala</option>
                                      <option>(GMT-05:00) Eastern Time - New York</option>
                                      <option>(GMT+08:00) Australian Western Standard Time - Perth</option>
                                      <option>(GMT+10:00) Australian Eastern Standard Time - Brisbane</option>
                                      <option>(GMT+08:45) Australian Central Western Standard Time</option>
                                      <option>(GMT-05:00) Eastern Time - Toronto</option>
                                      <option>(GMT-08:00) Pacific Time - Vancouver</option>
                                      <option>(GMT-07:00) Mountain Time - Edmonton</option>
                                      <option>(GMT-06:00) Central Time - Winnipeg</option>
                                      <option>(GMT-04:00) Atlantic Time - Halifax</option>
                                      <option>(GMT+00:00) Greenwich Mean Time - Monrovia</option>
                                      <option>(GMT+00:00) Western European Time - Faroe</option>
                                      <option>(GMT+01:00) Central European Time - Malta</option>

                                  </select>
                             </div>
                        </div>  
                    <div class="row">
                            <div class="col-md-4 pr-1 ">
                            <div  id="guesttextbox">
                            <label>Guest Email</label>
                            <div class ="">
                                <label id="showgtextbox" class="btn btn-primary">Add Guest Email</label>
                                <label class="btn btn-primary" id="findguestemail"><i class="fa fa-search fa-1x" aria-hidden="true"></i></label>
                            </div>
                            <div id="changegclass" class="input-group my-group addgtextbox">
                                <input type="email"  class="form-control mt-0 guestinput eventtext" id="guest_email" autocomplete="off">
                       
                                <a id="selectclient" class="bg-secondary rounded-right" ><i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 
                            </div>
                              <input type="hidden" id="guest_email_info" name="" value="">
                                <input type="hidden" id="guest_type" name="" value="">
                             </div>
                

                       <!--   <lable id="addguest" class="btn btn-sm mt-1 btn-warning" > + </lable> -->
                            </div>

                            <div class="col-md-4 px-1" >
                             <div id="usertextbox">   
                            <label>User Email</label>
                             <div class ="">
                                <label id="showutextbox" class="btn btn-primary">Add User Email</label>
                             </div>
                            <div id="changeuclass" class="input-group my-group addutextbox">
                                <input type="email"  class="form-control mt-0 userinput eventtext" id='user_email' autocomplete="off">
                                <a id="selectuser" class="bg-secondary rounded-right " > <i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 

                            </div>
                            </div>
                              <!-- <lable id="adduser" class="btn btn-sm mt-1 btn-warning" > + </lable> -->
                            </div>
                    
                            <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control form-control2 my-0 eventtext" name="description"></textarea>
                            </div>
                           </div>
                    </div>
                           <div class="row float-right">
                           
                                <div class="col-md-2 ">
                                  <input type="submit" name="myButton" id="primaryButton" class="btn btn-fill btn-primary" value="Submit">
                                    <!-- <button class="btn btn-fill btn-primary" id="submiteventbutton">Submit</button> -->
                             
                                  <!--   <a href="{{route('event.store')}}" class="btn btn-fill btn-primary" id="eventsubmit">Submit</a> -->
                                </div>

                           </div>
                               
                             </form>
                                
                            </div>

                        </div>

                    </div>

                  </div>
<!-- update event -->
                <div class="modal fade right" id="eventDialogupdate" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                           <!--  <div class="modal-header"> -->
                            <div class="row mr-1">
                              <div class="col-md-9 mt-0">
                                        
                              </div>
                              <div class="col-md-3 mt-2">
                                  
                                  <label id="closeupdateeventbox" class="btn btn-sm btn-fill btn-danger rightdiv">X</label>
                                  
                              </div>
                            </div>

                            <div class="modal-body">
                           <form action="{{route('gcalendar.update1')}}" method="post" class="updateform" onsubmit="return checkupdateeventForm(this);">
                              
                             @csrf
                        <div class="row">
                            <div class="col-md-3 pr-1">
                              <label>Title:</label>
                              <input type="hidden" id="id1" name="id" value="">
                            <input id='title1' name='title' class="form-control mt-0 field" type="text" value=""></input>
                             </div>
                            <input type="hidden" value="" name="google_id" id="googleid">
                             <div class="col-md-3 px-1">
                                 <label>Start Date:</label>
                                     <input id='start_date1' name='start_date' class="form-control mt-0 field"
                                      type="text" value="" autocomplete="off" onfocusout="Checkupdatestattdate()" required=""></input>
                             </div>
                             <div class="col-md-3 px-1">
                                 <label>End Date:</label>
                                     <input id='end_date1' name='end_date' class="form-control mt-0 field"
                                      type="text" value="" autocomplete="off" onfocusout="myFunctionenddatematchupdate()" required="" ></input>
                             </div>
                             <div class="col-md-3 pl-1">
                                 <label>Time Zone:</label>
                                    <!--  <input id='timezone1' name='time_zone' class="form-control mt-0"
                                      type="text" value=""></input> -->
                                      <select class="form-control mt-0 " name="time_zone">
                                      <option>(GMT+05:30) India Standard Time - Kolkata</option>
                                      <option>(GMT-10:00) Hawaii-Aleutian Standard Time </option>
                                      <option>(GMT-09:00) Alaska Time - Anchorage</option>
                                      <option>(GMT-08:00) Pacific Time - Los Angeles</option>
                                      <option>(GMT-07:00) Mountain Standard Time - Creston</option>
                                      <option>(GMT-06:00) Central Standard Time - Guatemala</option>
                                      <option>(GMT-05:00) Eastern Time - New York</option>
                                      <option>(GMT+08:00) Australian Western Standard Time - Perth</option>
                                      <option>(GMT+10:00) Australian Eastern Standard Time - Brisbane</option>
                                      <option>(GMT+08:45) Australian Central Western Standard Time</option>
                                      <option>(GMT-05:00) Eastern Time - Toronto</option>
                                      <option>(GMT-08:00) Pacific Time - Vancouver</option>
                                      <option>(GMT-07:00) Mountain Time - Edmonton</option>
                                      <option>(GMT-06:00) Central Time - Winnipeg</option>
                                      <option>(GMT-04:00) Atlantic Time - Halifax</option>
                                      <option>(GMT+00:00) Greenwich Mean Time - Monrovia</option>
                                      <option>(GMT+00:00) Western European Time - Faroe</option>
                                      <option>(GMT+01:00) Central European Time - Malta</option>

                                  </select>
                             </div>
                        </div>  
                    <div class="row">
                            <div class="col-md-4 pr-1 ">
                            <div  id="guesttextboxupdate">
                            <label>Guest Email</label>
                             <div class ="">
                                <label id="showugtextbox" class="btn btn-primary">Add Guest Email</label>

                            </div>
                            <div id="changeugclass" class="input-group my-group addgtextbox">  
                                <input type="text"  class="form-control updateguestemail mt-0" id="guest_nameupdate" autocomplete="off"> 
                                <a id="selectclientupdate" class="bg-secondary rounded-right" ><i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 
                                <input type="hidden" id="guest_email_info1" name="" value="">
                                <input type="hidden" id="guest_type1" name="" value="">

                                
                            </div>
                             </div>
                

                        <!--  <lable id="addguestupdate" class="btn btn-sm mt-1 btn-warning" > + </lable> -->
                            </div>

                            <div class="col-md-4 px-1" >
                             <div id="usertextboxupdate">   
                            <label>User Email</label>
                            <div class ="">
                                <label id="showuutextbox" class="btn btn-primary">Add User Email</label>
                             </div>
                            <div id="changeuuclass" class="input-group my-group addutextbox"  >
                                <input type="text" class="form-control updateuseremail mt-0 das" id='user_nameupdate' autocomplete="off">
                                <a id="selectuser" class="bg-secondary rounded-right " > <i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 
                            </div>
                      
                            </div>
                             <!--  <lable id="adduserupdate" class="btn btn-sm mt-1 btn-warning" > + </lable> -->
                            </div>
                    
                            <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control form-control2 my-0" name="description" id="description1"></textarea>
                            </div>
                           </div>
                    </div>
                           <div class="row">
                             <div class="col-md-12  followupvisible" id="onlylocal"><b class="rightdiv" style="color:red;" >This event is local.</b></div>
                             <div class="col-md-12" id="onlygoogle">
                                 <input type="submit" name="myButton" id="primaryButton" class="btn btn-fill  btn-primary rightdiv" value="Update">
                                <!--  <button class="btn btn-fill  btn-primary rightdiv" id="updateeventid" >Update</button> -->
                                <a id="delteevent" class="btn btn btn-danger btn-fill rightdiv mr-2" style="color: white" value="" onclick="Deleteevent(this)">Delete</a> 
                           
                                  <!--   <a href="{{route('event.store')}}" class="btn btn-fill btn-primary" id="eventsubmit">Submit</a> -->
                                </div>

                           </div>
                               
                             </form>
                                
                            </div>

                        </div>

                    </div>

                  </div>
<!-- end update event -->
                  
       <!--      </div>
        </div> -->
    </div>
</div>
@include('calendars.clientpage')
@include('calendars.companypage')
@include('calendars.companytable')
@include('calendars.companyclientemail')
@endsection
@section('script')



<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script>


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />
 -->

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.1/backbone-min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-us.js" integrity="sha256-GLtGssLoLnMtXFDxuUAnn+DU02rievBO5E7B5/P50ik=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 -->
<!-- <script src="{{ asset('js/fullcalendar.js') }}"></script> -->

<!-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
 -->


<script src='{{ asset("fullcalendar/lib/moment.min.js") }}'></script>
<!-- <script src='{{ asset("fullcalendar/lib/jquery.min.js") }}'></script> 
<script src='{{ asset("fullcalendar/lib/jquery-ui.custom.min.js") }}'></script> -->
<script src='{{ asset("fullcalendar/fullcalendar.min.js") }}'></script>
<script src='{{ asset("fullcalendar/jquery.qtip.min.js") }}'></script>




<script type="text/javascript">


//render view according to user selector
$('#user_selector').on('change',function(){

    $('#calendar').fullCalendar('rerenderEvents');
});
  $(document).ready(function(){
    $('.fc-more').on('select',function(){

    alert("hi");
});
    $("#e1, #e2").change(function() {  
        $('#calendar').fullCalendar('rerenderEvents');
   });

     //disable submit button to prevent insert double event
         // $('#submiteventbutton').on("click", function(){ 
         //      var strat=document.getElementById("start_date").value;
         //      var end=document.getElementById("end_date").value;
         //    if(strat != "" && end != "")  
         //    {
         //      document.getElementById("submiteventbutton").style.visibility = "hidden";
         //       swal({
         //        title: "Please Wait!",
         //        type: "success",
         //        showConfirmButton: false,
         //        timer: 9000
         //       });
         //       setTimeout(function(){document.getElementById("submiteventbutton").style.visibility = "visible";},9000);
         //    }
         // });
      //disable submit update to prevent insert double event
         // $('#updateeventid').on("click", function(){ 
         //    {
         //      document.getElementById("updateeventid").style.visibility = "hidden";
         //       swal({
         //        title: "Please Wait!",
         //        type: "success",
         //        showConfirmButton: false,
         //        timer: 9000
         //       });
         //       setTimeout(function(){document.getElementById("updateeventid").style.visibility = "visible";},9000);
         //    }
         // });
//focus on guest email after focus out from timezone
$("#timezoneid").focusout(function(){
    $('#changegclass').removeClass('addgtextbox'); 
    $('#showgtextbox').addClass('addgtextbox');
    $('#findguestemail').addClass('addgtextbox');

       document.getElementById("guest_email").focus();
});
//guest dynamic append
$("#guest_email").focusout(function(){
    var mail=document.getElementById("guest_email").value;
    var id=document.getElementById("guest_email_info").value;
    var type=document.getElementById("guest_type").value;
    if(id =="")
    {
        id=null;
        type=null;
    }
    if(mail == ""){
         //document.getElementById("user_email").focus();
          $('#changegclass').addClass('addgtextbox'); 
          $('#showgtextbox').removeClass('addgtextbox');
          $('#changeuclass').removeClass('addutextbox'); 
          $('#showutextbox').addClass('addutextbox'); 
          $('#findguestemail').removeClass('addgtextbox');
          $("#user_email").focus();

    }
    else
    {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
       if(mail.match(mailformat)){
       $("#guesttextbox").append('<div class="input-group my-group dy"><a href="#" class="bg-secondary rounded-left  mt-1"><i class="fa fa-info-circle mt-2"onclick="emailuserinfo('+id+','+type+')"style="font-size:15px;color:white"></i></a><input type="text" name="guestname[]" class="form-control form-control3 mt-1" value="'+mail+'"><a href="#" class="remove_guestfield bg-secondary rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div><input type="hidden" name="c_id[]" value="'+id+'"><input type="hidden" name="c_type[]" value="'+type+'">'); 
        document.getElementById("guest_email").value="";
        document.getElementById("guest_email_info").value="";
        document.getElementById("guest_email").focus();
      }
      else{

            toastr.error('Email address not valid.');
            document.getElementById("guest_email").value="";
            $("#guest_email").focus();

      } 
    }

});

//user dynamic append
$("#user_email").focusout(function(){
    var mail=document.getElementById("user_email").value;
    if(mail == ""){
         //document.getElementById("user_email").focus();
         $('#changeuclass').addClass('addutextbox'); 
          $('#showutextbox').removeClass('addutextbox'); 
         
    }
    else
    {
      var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if(mail.match(mailformat)){
      $("#usertextbox").append('<div class="input-group my-group dy"><input type="text" name="username[]" class="form-control form-control3 userinput mt-1" autocomplete="off" value="'+mail+'"><a href="#" class="remove_userfield bg-secondary rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div>');
        document.getElementById("user_email").value="";
         $("#user_email").focus();
       } 
       else{
            toastr.error('Email address not valid.');
            document.getElementById("user_email").value="";
            $("#user_email").focus();

       }
    }
});
//remove user 
     $('#usertextbox').on("click",".remove_userfield", function(){ 
                $(this).parent('div').remove();
        });
     
//remove guest 
     $('#guesttextbox').on("click",".remove_guestfield", function(){ 
                $(this).parent('div').remove();
        });
//guest update daynami append
$("#guest_nameupdate").focusout(function(){
    var mail=document.getElementById("guest_nameupdate").value;
    var id=document.getElementById("guest_email_info1").value;
    var type=document.getElementById("guest_type1").value;

    if(id =="")
    {
        id=null;
        type=null;
    }
    if(mail == ""){
         document.getElementById("user_nameupdate").focus();
         $('#changeugclass').addClass('addgtextbox'); 
         $('#showugtextbox').removeClass('addgtextbox');
    }
    else
    {
        $("#guesttextboxupdate").append('<div class="input-group my-group dy"><a href="#" class="bg-secondary rounded-left  mt-1"><i class="fa fa-info-circle mt-2" style="font-size:15px;color:white" onclick="emailuserinfo('+id+','+type+')"></i></a><input type="text" name="newguestemail[]" class="form-control form-control3 mt-1" value="'+mail+'"><a href="#" class="remove_updateguestfield bg-secondary rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div><input type="hidden" name="c_id[]" value="'+id+'"><input type="hidden" name="c_type[]" value="'+type+'">');  
        document.getElementById("guest_nameupdate").value="";
        document.getElementById("guest_email_info").value="";
        document.getElementById("guest_nameupdate").focus();
    }
});
//update user dynamic append
$("#user_nameupdate").focusout(function(){
    var mail=document.getElementById("user_nameupdate").value;
    if(mail == ""){
         //document.getElementById("user_email").focus();
         $('#changeuuclass').addClass('addutextbox'); 
         $('#showuutextbox').removeClass('addutextbox');
    }
    else
    {

      $("#usertextboxupdate").append('<div class="input-group my-group dy"><input type="text" name="newuseremail[]" class="form-control form-control3 mt-1" value="'+mail+'"><a href="#" class="remove_updateuserfield bg-secondary rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div>');
        document.getElementById("user_nameupdate").value="";
        document.getElementById("user_nameupdate").focus();
    }
});
// remove user in update modal
        $('#usertextboxupdate').on("click",".remove_updateuserfield", function(){ 
                $(this).parent('div').remove();
        });

//remove update guest 
       $('#guesttextboxupdate').on("click",".remove_updateguestfield", function(){ 
          
                 $(this).parent('div').remove();
        });
//open modal focus on title textbox         
$('#eventDialog').on('shown.bs.modal', function () {
    $('#title').focus();
});     
//     $('#calendar').fullCalendar({
//   dayClick: function(date, jsEvent, view) {
    

//     alert('Clicked on: ' + date.format());
//     var current_date  =  date.format();

//    // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

//    // alert('Current view: ' + view.name);
//    $("#event_date").val(current_date);
//    $("#eventDialog").dialog();

//    // $("#edit-modal-container-4597").modal('show');

//     // change the day's background color just for fun
//     $(this).css('background-color', 'red');

    

//   }
// });

        // $(document).on('click', ".fc-event-container", function(){
 
       
        //     $("#edit-modal-container-4597").modal('show');

        // });  URL::to('clients_1/statename')
        var calendar = $('#calendar').fullCalendar({
       
             height: get_calendar_height,
             eventLimit: 2,
             eventLimitText:"More",
          header: {   left: 'prev,next today myCustomButton',
                    center: 'title',
                   right: 'agendaDay,agendaWeek,month,list timeline',
            // center: 'dayGridMonth,timeGridWeek'
             },
           // buttons for switching between views
        
          views: {
              dayGridMonth: { // name of view
              titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit'},
  
                      // other view-specific options here
              } ,
               list: {

                  displayEventTime: true
                   

                },    
              }, 
        editable: true,
    
        events: [

        @foreach($data as $evnt)

           {
            id  :  '{{ $evnt['id'] }}',
            title : '{{ preg_replace('/[\x00-\x1F\x80-\xFF]/'," ",$evnt['title']) }}',
            start : '{{ $evnt['start'] }}',
            end: '{{ $evnt['end'] }}',
            description:'{{ preg_replace('/[\x00-\x1F\x80-\xFF]/'," ",$evnt['description']) }}',
            timezone:'{{$evnt['timezone']}}',
            flag:'{{$evnt['flag']}}',
            google_id:'{{$evnt['google_id']}}',
            type:'{{$evnt['type']}}',
            create_user_id:'{{$evnt['create_user_id']}}',
            taskfollowup:'{{$evnt['taskfollowup']}}'
            // url: '{{ URL::to("events/event_clicks") }}'
            
        },

        @endforeach
    
        ],
        displayEventTime: false,
        eventRender: function (event, element, view) {
            //console.log(event)
            element.popover({
              title: event.title,
             // content: event.description,
              trigger: 'hover',
              placement: 'top',
              container: 'body'
            });
            if (event.allDay === 'true') {
                event.allDay = false;
            } else {
                event.allDay = false;
            }
    
             //element.attr('href', 'javascript:void(0);');
        if($("#e1").is(":checked") == true &&  $("#e2").is(":checked") == false ){
             return  event.type  =='event'&& event.create_user_id == $('#user_selector').val();
           }
        if($("#e2").is(":checked") == true && $("#e1").is(":checked") == false ){
             return event.type =='task'&& event.create_user_id == $('#user_selector').val();
           }
        if($("#e2").is(":checked") == true && $("#e1").is(":checked") == true ){
             return  event.create_user_id == $('#user_selector').val();
           }
        if($("#e2").is(":checked") == false && $("#e1").is(":checked") == false ){
             return  event.type =='task' && event.type  =='event';
           }
      
          
     

        },
        eventAfterRender: function (event, element, view) {
        var dataHoje = new Date();
        if (event.start < dataHoje && event.end > dataHoje) {
            //event.color = "#FFB347"; //Em andamento
            element.css('background-color', '#FFB347');
        } else if (event.start < dataHoje && event.end < dataHoje) {
            //event.color = "#77DD77"; //Concluído OK
            element.css('background-color', '#77DD77');
        } else if (event.start > dataHoje && event.end > dataHoje) {
            //event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
        }
        if(event.flag == 1){
           element.css('text-decoration', 'line-through');
           element.css('text-decoration-color', 'red');
           // element.css('background-color', '#FF5E33');
        }
        if(event.type == 'task'  && event.end > dataHoje ){
           element.css('background-color', '#F25D48');
           element.css('color', 'white');
        }
        else if(event.type == 'task' && event.taskfollowup == ""){
             element.css('background-color', '#B678B7');
           element.css('color', 'white');
        }
        // 370339
        else if(event.type == 'task'){
           element.css('background-color', '#CA9D34');
           element.css('color', 'white');
        }
    },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {

            //clear modal data when open
            $(".eventtext").val("");
            //remove dynamic added text box
      
             $('.dy').remove();
           // var title = prompt('Event Title:');  this logic not require as only title event consider
         //  debugger;
           $("#title").val("");
            //var start =  $.fullCalendar.formatDate(start, "DD-MM-Y HH:mm:ss");
            var start1 = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            // var start = $.fullCalendar.formatDate(start, "d-m-YY HH:mm:ss");
            var start =  $.fullCalendar.formatDate(start, "DD-MM-Y HH:mm:ss");
            $("#start_date").val(start);

             // alert(start1); 
            $(".dialogbtn").text("Create");
            var current = $('#calendar').fullCalendar('getDate');
            var currentdate=current.format("Y-MM-DD HH:mm:ss");
            if( new Date(start1) > new Date(currentdate) )
            {

                $("#eventDialog").modal("show");

                var title = $("#title").val();
                            
            // if (title) {
            //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            //     $.ajax({
            //         url: 'add-event.php',
            //         data: 'title=' + title + '&start=' + start + '&end=' + end,
            //         type: "POST",
            //         success: function (data) {
            //             displayMessage("Added Successfully");
            //         }
            //     });
            //     calendar.fullCalendar('renderEvent',
            //             {
            //                 title: title,
            //                 start: start,
            //                 end: end,
            //                 allDay: allDay
            //             },
            //     true
            //             );
            // }
            calendar.fullCalendar('unselect');
           }
           else{
            
           }
        },
        editable: false,
        eventDrop: function (event, delta) {
            alert('delete');
                    console.log(event);
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) { 
                   //    debugger;
                      console.log(event);
                      //alert('click');

            var id    = event.id ;                      
            var title =  event.title ;
            var description=event.description;
            var timezone=event.timezone;
            var googleid=event.google_id;
            var type=event.type;
            var flag=event.flag;
            var create_user_id=event.create_user_id
            //alert( id + title);
            //var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var start =  $.fullCalendar.formatDate(event.start, "DD-MM-Y HH:mm:ss");
           // var end=$.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "DD-MM-Y HH:mm:ss");
          
            $("#id1").val(id);
            $("#title1").val(title);
            $("#start_date1").val(start);
            $("#end_date1").val(end);
            $("#description1").val(description);
            $("#timezone1").val(timezone);
            $("#delteevent").val(id);
            $("#googleid").val(googleid);
            $(".dialogbtn").text("Modify");

            $('.dy').remove();//remove dynamic text box
            if(type == "task"){
              // alert("hi");
        
              const el = document.createElement('div');
                var url = '{{ route("task.gototaskcontact", ":id") }}';
                timezone +=","+id;
                url = url.replace(':id', timezone);
                var start =  $.fullCalendar.formatDate(event.start, "DD-MM-Y HH:mm:ss");
                var dataHoje = new Date();
                   dataHoje.setHours( dataHoje.getHours() - 20);
                if(event.start > dataHoje){
                  
                    el.innerHTML = "<a href='"+url+"' class='btn  btn-success'>Action</a>";
                }
                else{
               
                   el.innerHTML="";
                }

               swal({
                title:"Task",
                text: title +'\n \n DateTime :'+start+'\n \n Description : '+ description,
                content: el,
            })

              // $("#eventDialog").modal("show");
            }
            else{

                $.ajax({
                    type: "post",
                    url: "{{route('events.userdetail')}}",
                   data: {
                             "_token": "{{ csrf_token() }}",
                             "id":id,     
                       },
                    success: function (response) {

                        $('.ff').remove();
                        var gmail=response.guestemail;
                        var gstatus=response.gueststatus;
                        var umail=response.useremail;
                        var ustatus=response.userstatus;
                        var guestid=response.guestid;
                         var userid=response.userid;
                         var userflag=response.userflag;
                         var guestflag=response.guestflag;
                         var c_id=response.guestc_id;
                         var c_type=response.guestc_type;

                     for (i = 0; i < gmail.length; i++) {
                          
                          if(guestflag[i] == 1){
                            $("#guesttextboxupdate").append('<div><input style="text-decoration: line-through;border:0;" class="form-control3 mt-1 ff" value="'+gmail[i]+'"></div>');
                          }
                          else{
                            if(gstatus[i] == 'accepted'){
                                $statussymbol='<i class="fa fa-check mt-2" aria-hidden="true" style="color:orange"></i>';
                            }
                            else if(gstatus[i] == 'tentative'){
                                 $statussymbol='<i class="fa fa-question-circle mt-2" aria-hidden="true" style="color:orange"></i>';
                            }
                            else if(gstatus[i] == 'declined'){
                                    $statussymbol='<i class="fa fa-times mt-2" aria-hidden="true" style="color:red"></i>';
                            }
                            else{
                                $statussymbol='<i class="fa fa-exclamation-triangle mt-2" aria-hidden="true" style="color:orange"></i>';
                            }
                            if(create_user_id != {{auth()->user()->id}} || googleid == ""){
                                 $("#guesttextboxupdate").append('<div class="input-group my-group ff"><a href="#" class="bg-secondary rounded-left  mt-1"  onclick="emailuserinfo('+c_id[i]+','+c_type[i]+')"><i class="fa fa-info-circle mt-2" style="font-size:15px;color:white"></i></a><a  href="#" class="bg-secondary   mt-1"> '+$statussymbol+'</a><input type="text" name="guestemail[]" class="form-control form-control3 mt-1 " value="'+gmail[i]+'"><input type="hidden" name="guestresponsestatus[]" value="'+gstatus[i]+'"></div>');
                            }
                            else{
                                 $("#guesttextboxupdate").append('<div class="input-group my-group ff"><a href="#" class="bg-secondary rounded-left  mt-1"  onclick="emailuserinfo('+c_id[i]+','+c_type[i]+')"><i class="fa fa-info-circle mt-2" style="font-size:15px;color:white"></i></a><a  href="#" class="bg-secondary   mt-1"> '+$statussymbol+'</a><input type="text" name="guestemail[]" class="form-control form-control3 mt-1 " value="'+gmail[i]+'"><input type="hidden" name="guestresponsestatus[]" value="'+gstatus[i]+'"><a href="#" class="bg-secondary rounded-right  mt-1" onclick="deleteguestemail('+guestid[i]+',this)"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div>');
                              }
                          } 
                       
                      }
                    for (i = 0; i < umail.length; i++) {

                        if(userflag[i] == 1){
                            $("#usertextboxupdate").append('<div><input style="text-decoration: line-through; border:0;" class="form-control3 mt-1 ff noboder" value="'+umail[i]+'"></div>');
                          }
                        else{
                          if(ustatus[i] == 'accepted'){
                                $statussymbol='<i class="fa fa-check mt-2" aria-hidden="true"style="color:orange"></i>';
                            }
                            else if(ustatus[i] == 'tentative'){
                                 $statussymbol='<i class="fa fa-question-circle mt-2" aria-hidden="true"style="color:orange"></i>';
                            }
                            else if(ustatus[i] == 'declined'){
                                    $statussymbol='<i class="fa fa-times mt-2" aria-hidden="true"style="color:red"></i>';
                            }
                            else{
                                $statussymbol='<i class="fa fa-exclamation-triangle mt-2" aria-hidden="true"style="color:orange"></i>';
                            }
                            if(create_user_id != {{auth()->user()->id}} || googleid == ""){
                                $("#usertextboxupdate").append('<div class="input-group my-group ff"><a  href="#" class="bg-secondary rounded-left mt-1">'+$statussymbol+'</a><input type="text" name="useremail[]" class="form-control form-control3 mt-1" value="'+umail[i]+'"><input type="hidden" name="userresponsestatus[]" value="'+ustatus[i]+'"></div>');
                            }
                            else{
                               $("#usertextboxupdate").append('<div class="input-group my-group ff"><a  href="#" class="bg-secondary rounded-left mt-1">'+$statussymbol+'</a><input type="text" name="useremail[]" class="form-control form-control3 mt-1" value="'+umail[i]+'"><input type="hidden" name="userresponsestatus[]" value="'+ustatus[i]+'"><a href=javascript:void(0);  class=" bg-secondary rounded-right  mt-1" onclick="deleteuseremail('+userid[i]+',this)"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div>');
                            }   
                        } 
                   
                    }

     
                     

                    }
                    
                });
                if(flag == 1 || create_user_id != {{auth()->user()->id}}){
                      $('#onlylocal').addClass('followupvisible');
                      $('#onlygoogle').addClass('followupvisible');
                    
                      
                  }
                  else if(googleid != ""){
                     $('#onlylocal').addClass('followupvisible');
                     $('#onlygoogle').removeClass('followupvisible');
                      $("#usertextboxupdate").attr('disabled','disabled');
                      
                  }
                  else{
                     $('#onlylocal').removeClass('followupvisible');
                     $('#onlygoogle').addClass('followupvisible');
                     $("a.notdelete").attr("disabled", false);
                  }

                 $("#eventDialogupdate").modal("show");
            }
            
        }

    });

       
    });
//close event update model
  $(document).on('click','#closeupdateeventbox',function(){

  $( "#eventDialogupdate" ).modal("hide");


});
//close create event model
  $(document).on('click','#closeeventbox',function(){


  $( "#eventDialog" ).modal("hide");


});

 $( document ).ready(function(){
//datetimepicker
  jQuery('#start_date').datetimepicker({ format: 'd-m-Y H:i', minDate: 'today',});
  jQuery('#end_date').datetimepicker({ format: 'd-m-Y H:i',minDate: 'today'});
  jQuery('#start_date1').datetimepicker({ format: 'd-m-Y H:i',minDate: 'today'});
  jQuery('#end_date1').datetimepicker({ format: 'd-m-Y H:i',minDate: 'today'});
  jQuery('#clientdatetimepicker').datetimepicker({ format: 'd-m-Y H:i',minDate: 'today'});
  jQuery('#companydatetimepicker').datetimepicker({ format: 'd-m-Y H:i',minDate: 'today'});
//take user email   
            $('.userinput').on("keyup", function() {

            var uemail = $(".userinput").val() ;
          
            $(this).autocomplete({
                
               source: function(request, response) {
              $.post("{{ URL::to('/useremails') }}", {_token: "{{ csrf_token() }}", term: request.term, useremail: uemail},
                 response, "json");
             
            },

                minLength: 1 ,
            select: function(event, ui) {
                              
                  $('#user_email').val(ui.item.user_email1);
                            
                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.user_email1  +  "</a>" )
            .appendTo( ul );

        };
    $( ".userinput" ).autocomplete( "option", "appendTo", ".formclass" );

        
    });

//take guest email
    $('.guestinput').on("keyup", function() {
        var gmail = $("#guest_email").val() ;
           
        $(this).autocomplete({
                
        source: function(request, response) {
            $.post("{{ URL::to('/guestemails') }}", {_token: "{{ csrf_token() }}", term: request.term, guestemail: gmail},
                 response, "json");
             
            },

            minLength: 1 ,
              
            
            select: function(event, ui) {           
                  
                  $('#guest_email').val(ui.item.guest_email1);
                  $('#guest_email_info').val(ui.item.id1);
                  $('#guest_type').val(ui.item.type1);
                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.guest_email1  +  "</a>" )
            .appendTo( ul );
        };
       $( ".guestinput" ).autocomplete( "option", "appendTo", ".formclass" );
    });

//take update guest email

    $('.updateguestemail').on("keyup", function() {
        var ugmail = $("#guest_nameupdate").val() ;
           
        $(this).autocomplete({
                
                
        source: function(request, response) {
            $.post("{{ URL::to('/guestemails') }}", {_token: "{{ csrf_token() }}", term: request.term, guestemail: ugmail},
                 response, "json");
             
            },

            minLength: 1 ,
              
            
            select: function(event, ui) {
                     
                  $('#guest_nameupdate').val(ui.item.guest_email1);
                  $('#guest_email_info1').val(ui.item.id1);
                  $('#guest_type1').val(ui.item.type1)
                         
                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.guest_email1  +  "</a>" )
            .appendTo( ul );
        };
       $( ".updateguestemail" ).autocomplete( "option", "appendTo", ".updateform" );
    });
//take update user email

    $('.updateuseremail').on("keyup", function() {
        var uumail = $("#user_nameupdate").val() ;
           
        $(this).autocomplete({
                
        source: function(request, response) {
            $.post("{{ URL::to('/useremails') }}", {_token: "{{ csrf_token() }}", term: request.term, useremail:uumail},
                 response, "json");
             
            },

            minLength: 1 ,
              
            
            select: function(event, ui) {
                       
                  $('#user_nameupdate').val(ui.item.user_email1);
            
                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.user_email1  +  "</a>" )
            .appendTo( ul );
        };
       $( ".updateuseremail" ).autocomplete( "option", "appendTo", ".updateform" );
    });
//guest text box visible
  $( "#showgtextbox" ).on("click",function(){

       $('#changegclass').removeClass('addgtextbox'); 
       $('#showgtextbox').addClass('addgtextbox');
       $('#findguestemail').addClass('addgtextbox');
       
       document.getElementById("guest_email").focus(); 
  });
//update guest text box visible
  $( "#showugtextbox" ).on("click",function(){

       $('#changeugclass').removeClass('addgtextbox'); 
       $('#showugtextbox').addClass('addgtextbox'); 
       document.getElementById("guest_nameupdate").focus(); 
       
  });
//user text box visible
  $( "#showutextbox" ).on("click",function(){
       $('#changeuclass').removeClass('addutextbox'); 
        $('#showutextbox').addClass('addutextbox');
        document.getElementById("user_email").focus();

  });
//update user text box visisble
 $( "#showuutextbox" ).on("click",function(){
       $('#changeuuclass').removeClass('addutextbox'); 
       $('#showuutextbox').addClass('addutextbox');
    document.getElementById("user_nameupdate").focus();  
  });
//close company info modal
 $('#companyclose').on('click',function(){
     $( "#companyinfo" ).modal("hide");
 });
//close client info modal
 $('#clientclose').on('click',function(){
     $( "#clientinfo" ).modal("hide");
 });

 
//small date time picker
 $('#datepicker').datepicker({
        inline: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#calendar').fullCalendar('gotoDate', d);
        }
 }); 
});
function Checkupdatestattdate(){
     var number1=document.getElementById("start_date1").value; 
     var res = number1.split("-");
     number3=res[1]+"-"+res[0]+"-"+res[2];
     number3=moment(number3).format("Y-MM-DD HH:mm:ss");
     var current = $('#calendar').fullCalendar('getDate');
     var number2=current.format("Y-MM-DD HH:mm:ss");
     var ch = res[2].split(" ");
    if(ch[0].length != 4){
        toastr.warning("Select proper date !");
        document.getElementById("start_date1").value=""; 
    }
    else{
     if( new Date(number2) >= new Date(number3)){
              
                document.getElementById("start_date1").value="";
                number2=moment(number2).format('DD-MM-YYYY kk:mm '); 
                toastr.warning("Select date and time from "+number2+"!");
     }
    }
   
}
function Checkstattdate(){
     var number1=document.getElementById("start_date").value;
     var res = number1.split("-");
     number3=res[1]+"-"+res[0]+"-"+res[2];
     var ch = res[2].split(" ");
    if(ch[0].length != 4){
        toastr.warning("Select proper date !");
        document.getElementById("start_date").value=""; 
    }
    else{
     number3=moment(number3).format("Y-MM-DD HH:mm:ss");
     
     var current = $('#calendar').fullCalendar('getDate');
      // document.getElementById("end_date").value=number1;
     var number2=current.format("Y-MM-DD HH:mm:ss");
        // alert(number3);
     if( new Date(number2) >= new Date(number3)){
          
                 document.getElementById("start_date").value=""; 
                 number2=moment(number2).format('DD-MM-YYYY kk:mm ');
                 toastr.warning("Select date and time after   "+number2+"!");
     }
     else{
        document.getElementById("end_date").value=number1;
     }
    }
}
function myFunctionenddatematch(){
    var number1=document.getElementById("start_date").value; 
     var res = number1.split("-");
     number1=res[1]+"-"+res[0]+"-"+res[2];
     number1=moment(number1).format("Y-MM-DD HH:mm:ss");
    
     var number2=document.getElementById("end_date").value; 
     var res1 = number2.split("-");
     number2=res1[1]+"-"+res1[0]+"-"+res1[2];
     number2=moment(number2).format("Y-MM-DD HH:mm:ss");
       var ch = res1[2].split(" ");
    if(ch[0].length != 4){
        toastr.warning("Select proper date !");
        document.getElementById("end_date").value=""; 
    }
    else{

           if( new Date(number1) >= new Date(number2)){
              
                 document.getElementById("end_date").value=""; 
                   toastr.warning("Incorrect Date Time!");
           }
    }       
 }
 function myFunctionenddatematchupdate(){
    var number1=document.getElementById("start_date1").value; 
    var res = number1.split("-");
    number1=res[1]+"-"+res[0]+"-"+res[2];
    number1=moment(number1).format("Y-MM-DD HH:mm:ss");
    var number2=document.getElementById("end_date1").value; 
    var res1 = number2.split("-");
    number2=res1[1]+"-"+res1[0]+"-"+res1[2];
    number2=moment(number2).format("Y-MM-DD HH:mm:ss");
     var ch = res1[2].split(" ");
     if(ch[0].length != 4){
        toastr.warning("Select proper date !");
        document.getElementById("end_date1").value=""; 
    }
    else{
           if( new Date(number1) >= new Date(number2)){
              
                 document.getElementById("end_date1").value=""; 
                   toastr.warning("Incorrect Date Time!");
           }
    }       
 }

//delete email from master and pivote
function Deleteevent(objButton){
  var ids=objButton.value;

  swal({
       text: "Do you want to delete",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
       document.getElementById("delteevent").style.visibility = "hidden";
        swal({
              title: "Please Wait!",
              type: "success",
              showConfirmButton: false,
              timer: 11000
            });
            setTimeout(function(){document.getElementById("delteevent").style.visibility = "visible";},11000);
    
    $.ajax({

      url:"{{route('gcalendar.delete')}}",
      type:'post',
      data:{
                "_token": "{{ csrf_token() }}",
                "id":ids,     
            },
      success:function(data){
           location.reload();
      }
    });
  }
  else{
    $("#eventDialogupdate").modal("hide");
     toastr.warning('You canceled delete operation');  
  }
});
}
function deleteguestemail(obj,pp){

    swal({
                  text: "Do you want to delete guest email?",
                  // text: "Once deleted, you will not be able to recover this imaginary file!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {  
                $(pp).parent('div').remove();
              
                $.ajax({
                  url:"{{route('event.localattendeemaildelete')}}",
                  type:'post',
                  data:{_token: "{{ csrf_token() }}",id:obj},
                  success:function(data){

                    toastr.error('Guest email is deleted.');   
                  }
                });
              }
              else{
                 toastr.warning('You canceled delete operation');  
              }
            }); 
}
function deleteuseremail(obj,pp){

       swal({
                  text: "Do you want to delete user email?",
                  // text: "Once deleted, you will not be able to recover this imaginary file!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {  
                 $(pp).parent('div').remove();
              
                $.ajax({
                  url:"{{route('event.localattendeemaildelete')}}",
                  type:'post',
                  data:{_token: "{{ csrf_token() }}",id:obj},
                  success:function(data){
                     // $(pp).parent('div').css({"text-decoration": "line-through"});
                    toastr.error('User email is deleted.');   
                  }
                });
              }
              else{
                 toastr.warning('You canceled delete operation');  
              }
            }); 
}
function emailuserinfo(obj,obj1){
    if(obj == null){
          swal({
                  text: "Information not found!",
                  // text: "Once deleted, you will not be able to recover this imaginary file!",
                  icon: "warning",
                
                
                })
      
    }
    else{
    $.ajax({
                url:"{{route('event.emailinfo')}}",
                type:'post',
                data:{_token: "{{ csrf_token() }}",id:obj,type:obj1},
              success:function(data){
               
                if(obj1 == 2) 
                {
                     $('.cle').remove();
                    document.getElementById("clientdispositionid").value=data[0].id;
                    document.getElementById("client_name").textContent=data[0].client_name;
                    document.getElementById("designation").textContent=data[0].client_designation;
                     document.getElementById("linkedin").textContent=data[0].linkedin_url;

                     data[1].forEach(function(element) {
                        console.log(element);
                        $("#clientemail").append('<div class="input-group my-group cle"><span>'+element.email+'</span></div>'); 
                       
                     });
                     data[2].forEach(function(element) {
                        $("#clientphone").append('<div class="input-group my-group cle"><span>'+element.phone+'</span></div>'); 
                     });
                   
                    $("#clientinfo").modal("show");
                   
                }
                else{
                     $('.cle').remove();
                    document.getElementById("companydispositionid").value=data[0].id;
                    document.getElementById("company_name").textContent=data[0].company_name;
                    document.getElementById("website_address").textContent=data[0].website_address;
                    document.getElementById("vendor_type").textContent=data[0].vendor_type;
                    document.getElementById("type_business").textContent=data[0].type_business;
                     data[1].forEach(function(element) {
                        
                        $("#companyemail").append('<div class="input-group my-group cle"><span>'+element.email+'</span></div>'); 
                       
                     });
                     data[2].forEach(function(element) {
                        $("#companyphone").append('<div class="input-group my-group cle"><span>'+element.phone+'</span></div>'); 
                     });
            
                    $("#companyinfo").modal("show");

                }
              }
        });
    } 
}
function get_calendar_height() {
      return $(window).height() - 70;
}


//-------disposition portion-----------------------------
 //pop up companydisposition modal
 $(document).on('click','#companydispositionbtn',function(){
 $('input:text').val('');
 document.getElementById("companydescription").value='';
 $(".form-check-input").prop("checked", false);
 $(' #followupid ').addClass('followupvisible');
    $( "#companydispositionmodal" ).modal("show");
    $( '#modelHeading1' ).html("Disposition");
});
 //close companydisposition modal
$(document).on('click','.closecompanydisposition',function(){

    $( "#companydispositionmodal" ).modal("hide");
   
});
$(document).on('click','#submitcompanydisposition',function(){
 
     var description=document.getElementById("companydescription").value;
         var ele = document.getElementsByName('optradio'); 
          
            var radiovalue='';
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                 radiovalue=ele[i].value;
              
            } 
    var id=document.getElementById("companydispositionid").value;
    var follow_up=document.getElementById("companydatetimepicker").value;
   // if(newdiapositiondata == ""){
   //   toastr.error('Please write new disposition!');
     
   // }
   // else{
 
   if(description =='' && follow_up =='' && radiovalue==''){
    toastr.error('Please fill updata!'); 
   }
   else{
    $.ajax({
                  type: "post",
                  url: "{{route('disposition.companydispositionstore')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "description":description, 
                               "status":radiovalue,  
                               "company_id":id, 
                               "follow_up":follow_up, 
                        },
                   
                   success: function(data){    
                             
                        $( "#companydispositionmodal" ).modal("hide");
                          toastr.success('New Disposition entered successfully!');  
                                         
                   },
                     
          });
    }
 });
 //pop up clientdisposition modal
 $(document).on('click','#clientdispositionbtn',function(){
    $('input:text').val('');
     document.getElementById("clientdescription").value='';
     $(".form-check-input").prop("checked", false);
     $(' #followupid ').addClass('followupvisible');  

    $( "#clientdispositiondialogbox" ).modal("show");
    $( '#modelHeading1' ).html("Disposition");
});
 //close companydisposition modal
$(document).on('click','.closeclientdisposition',function(){

    $( "#clientdispositiondialogbox" ).modal("hide");
   
});
//Show company table
$(document).on('click','#findguestemail',function(){

    $( "#companyinfomodal" ).modal("show");
   
});
//submit client dispostition
$(document).on('click','a#submitclientpermission.mt-2',function(){
    
    var description=document.getElementById("clientdescription").value;
              
    var ele = document.getElementsByName('optradio'); 
              var radiovalue='';
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                   radiovalue=ele[i].value;
              
            } 
    var id= document.getElementById("clientdispositionid").value;
    var follow_up=document.getElementById("clientdatetimepicker").value;
     
    if(description =='' && follow_up =='' && radiovalue==''){
    toastr.error('Please fill updata!'); 
   }
   else{
       $.ajax({
                  type: "post",
                  url: "{{route('clientdisposition.store')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "description":description, 
                               "status":radiovalue,  
                               "client_id":id, 
                               "follow_up":follow_up, 
                        },
                   
                   success: function(data){    
                             
                        $( "#clientdispositiondialogbox" ).modal("hide");
                   
                          toastr.success('New Disposition entered successfully!');  
                                         
                   },
                     
                  });
       $( "#clientdispositiondialogbox" ).modal("hide");
    }
  });
//show followup textbox in disposition click on followup radio buttoon 
 $('input:radio[name=optradio]').click(function(){
        var compare=$(this).val();
        if(compare == 'Follow Up' || compare == 'Call Back'){
            $(' #followupid ').removeClass('followupvisible');
            $('#datetimepicker').focus();
        }
        else{
          $(' #followupid ').addClass('followupvisible');
          $('#datetimepicker').val('');
          
        }
 });
 function checkeventForm(form) // Submit button clicked
  {
    //
    // check form input values
    //
   
    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
  }
  function checkupdateeventForm(form) // Submit button clicked
  {
    //
    // check form input values
    //
   
    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
  }
//show company table in modal 
  $(function () {
     var table = $('#companyrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true, 
        // stateSave: true,
        
     
        lengthMenu: [[5,-1], [10,10]],
       "language": {
                    "lengthMenu": '<b style="color:black;">Display <select class="form-control-sm">'+
                      '<option value="5">5</option>'+
                      '<option value="10">10</option>'+
                    '</select> records</b>'
                    },

         paging:  true,//give pagination in bottom
         
        ajax: "{{ route('company.anydata') }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
             
           
          ],
          columns: [
            {data: 'id', name: 'id',class:"fooid dt-center",width:'1%' },
            {data: 'company_name', name:'company_masters.company_name',class:'selectedcompany dt-center'},
            {data: 'state', name:'company_addresses.state'},
              {data: 'Country', name:'company_addresses.Country'}
           ], 
           order: [[ 0, 'desc' ]],

      });

  }); 
//Show company table
$(document).on('click','.selectedcompany',function(){
      var key  = $(this).closest('tr').find('td.fooid').text();
      var companyname  = $(this).closest('tr').find('td.selectedcompany').text();
$('#showclientemaildata').empty();
$('#showclientemaildata1').empty();
$('#showcompanymaildata').empty();
$('#showcompanyemaildata1').empty();
// jQuery('#showclientemaildata div').html('');
// jQuery('#showclientemaildata1 div').html('');
// jQuery('#showecompanymaildata div').html('');
// jQuery('#showecompanymaildata1 div').html('');
     
      $.ajax({
                type: "post",
                url: "{{route('company.showemail')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "companyid":key,
                            
                       },
                 
                 success: function(data){    
                    //data[0][i]['id']
                       // console.log(data[0]);

                     $('#companynameemail').text(companyname);
                      for (i = 0; i < data[0].length; i++) { 
                        var dd="";
                        var emailstr=data[0][i]['client_email_add'];
                        var emailst=emailstr.split(",");
                        for (j = 0; j < emailst.length; j++){
                          var onlyemail=emailst[j].replace(/,/g ,'');
                           console.log(onlyemail);
                           dd+= "<input type='checkbox' name='checkbox1[]' value='"+onlyemail+"'> "+onlyemail+"<br>";
                        }
                        var dd=dd.replace(/NaN/g ,'');
                        var k=i+1;
                        if(k%2 != 0){
                           $("#showclientemaildata").append("<div><b>"+k+"</b> .<b>"+data[0][i]['client_name']+"</b><br>"+dd+"</div>");
                        }
                        else{
                           $("#showclientemaildata1").append("<div><b>"+k+"</b> .<b>"+data[0][i]['client_name']+"</b><br>"+dd+"</div>");
                        }
                        
                      
                      }
                      for (i = 0; i < data[1].length; i++) {
                          k=i+1;
                          if(k%2 != 0){
                            $("#showcompanymaildata").append("<div><input type='checkbox' name='checkbox1[]' value='"+data[1][i]+"'> "+data[1][i]+"</div>");
                          }
                          else{
                             $("#showcompanyemaildata1").append("<div><input type='checkbox' name='checkbox1[]' value='"+data[1][i]+"'> "+data[1][i]+"</div>");
                          }
                       }


                      $( "#companyclientemail" ).modal("show");
                             
                            
                           
                 },
                   
                });
   
});
//append email in event model
$(document).on('click','.submitemail',function(){
      var checkboxes = document.getElementsByName('checkbox1[]');
       var aIds = [];
      for (var i=0, n=checkboxes.length;i<n;i++) 
           {
             if (checkboxes[i].checked) 
             {
                 aIds.push(checkboxes[i].value);
                 // vals += ","+checkboxes[i].value;
                
              }  
      }
    
      
       for (i = 0; i < aIds.length; i++) {
         $("#guesttextbox").append('<div class="input-group my-group dy"><input type="text" name="guestname[]" class="form-control form-control3 mt-1" value="'+aIds[i]+'"><a href="#" class="remove_guestfield bg-secondary rounded-right  mt-1"><i class="fa fa-times mt-2" style="font-size:15px;color:white"></i></a></div>'); 

      // $("#showcompanymaildata").append("<div><input type='checkbox' name='checkbox1[]' value='"+data[1][i]+"'> "+data[1][i]+"</div>");
                          
       }
         $( "#companyclientemail" ).modal("hide");
         $( "#companyinfomodal" ).modal("hide");
});
//close show email button
$(document).on('click','#closecompanyemail',function(){
   $( "#companyclientemail" ).modal("hide");
});
//close company data modal
$(document).on('click','#closecompanytable',function(){
   $( "#companyinfomodal" ).modal("hide");
});
//create direct event
$(document).on('click','#createdirectevent',function(){ 
      //clear modal data when open
            $(".eventtext").val("");
      //remove dynamic added text box
            $('.dy').remove();
      $("#title").val("");
      //remove dynamic added text box
          $("#start_date").val("");
      
      $("#eventDialog").modal("show");
});

</script>
@endsection