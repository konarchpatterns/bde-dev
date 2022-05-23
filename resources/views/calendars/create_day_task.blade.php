@extends('layouts.dashboard')

@section('style')
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>


<style type="text/css">

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

input[type=text]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);
}


</style>

@endsection

@section('content')

<h4 >  {{ $data['scope'] }} >> Create   </h4>


{!! Form::open(['id' =>'meeting', 'method'=>'post', 'action' => 'MeetingController@store']) !!}
<div class="edit-container"><div class="edit" id="meeting">

    <div class="row">
        <div class="left  col-md-7">

            <div class="card">    
                <article class="card-group-item">
                    <div class="middle">
                        <div class="panel panel-default">

                            <div class="card-body"> 
                                <div class="panel-body panel-body-form">


                                    <div class="row">


                                        <div class="cell col-sm-12 form-group" >
                                            <label class="control-label" ><span class="label-text">Name</span><span  *</span></label>

                                            <div class="field" ><input type="text" class=" form-control"  value="{{ $data['title'] }}" >
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">


                                        <div class="col-sm-12 form-group" data-name="status">
                                            <label class="control-label" data-name="status"><span class="label-text">Status</span></label>
                                            <div c><select data-name="status" class="form-control"> 
                                                <option value="Planned" selected="">Planned</option><option value="Held">Held</option><option value="Not Held">Not Held</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">





                                    <div class=" col-sm-12 form-group" >
                                        <label class="control-label" ><span class="label-text">Date Start</span><span class="required-sign"> *</span></label>
                                        <div class="field" >
                                            <div class="input-group">
                                                <input class="form-control"
                                                 name="date_start" type="date"  value={{ $data['start_date'] }}" >
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-default btn-icon date-picker-btn" tabindex="-1"><i class="far fa-calendar"></i></button>
                                                </span>
                                                <input class="form-control date_start_time" type="time"  required="required">
                                                <span class="input-group-btn time-part-btn">
                                                    <button type="button" class="btn btn-default btn-icon time-picker-btn" tabindex="-1"><i class="far fa-clock"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">





                                    <div class="cell col-sm-12 form-group" data-name="duration">
                                        <label class="control-label" data-name="duration"><span class="label-text">Duration</span></label>
                                        <div class="field" data-name="duration"><select data-name="duration" class="form-control ">
                                            <option value="900">15m</option><option value="1800" selected="">30m</option><option value="3600">1h</option><option value="7200">2h</option><option value="10800">3h</option><option value="86400">1d</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">





                                <div class="cell col-sm-12 form-group" data-name="dateEnd">
                                    <label class="control-label" data-name="dateEnd"><span class="label-text">Date End</span><span class="required-sign"> *</span></label>
                                    <div class="field" data-name="dateEnd">
                                        <div class="input-group">
                                            <input class=" form-control" type="text" data-name="dateEnd" value="07/14/2019" autocomplete="espo-dateEnd">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-icon date-picker-btn" tabindex="-1"><i class="far fa-calendar"></i></button>
                                            </span>
                                            <input class="form-control time-part ui-timepicker-input" type="time" data-name="dateEnd-time"  autocomplete="off">
                                            <span class="input-group-btn time-part-btn">
                                                <button type="button" class="btn btn-default btn-icon time-picker-btn" tabindex="-1"><i class="far fa-clock"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="cell col-sm-12 form-group" data-name="parent">
                                    <label class="control-label" data-name="parent"><span class="label-text">Parent</span></label>
                                    <div class="field" data-name="parent"><div class="input-group input-group-link-parent">
                                        <span class="input-group-btn">
                                            <select class="form-control" data-name="parentType">
                                                <option value="Account" selected="">Account</option><option value="Lead">Lead</option><option value="Contact">Contact</option><option value="Opportunity">Opportunity</option><option value="Case">Case</option>
                                            </select>
                                        </span>
                                        <input class=" form-control " type="text" data-name="parentName" value=""  placeholder="Select">
                                        <span class="input-group-btn">
                                            <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><i class="fas fa-angle-up"></i></button>
                                            <button data-action="clearLink" class="btn btn-default btn-icon" type="button" tabindex="-1"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                    <input type="hidden" data-name="parentId" value="">
                                </div>
                            </div>


                        </div>

                        <div class="row">





                            <div class="cell col-sm-12 form-group" data-name="reminders">
                                <label class="control-label" data-name="reminders"><span class="label-text">Reminders</span></label>
                                <div class="field" data-name="reminders"><div class="reminders-container"></div>

                                <button data-action="addReminder" class="btn btn-default" type="button" tabindex="-1"><span class="fas fa-plus"></span></button>
                            </div>
                        </div>


                    </div>

                    <div class="row">





                        <div class="cell col-sm-12 form-group" data-name="description">
                            <label class="control-label" data-name="description"><span class="label-text">Description</span></label>
                            <div class="field" data-name="description">
                                <textarea class=" form-control auto-height" data-name="description" rows="2" autocomplete="espo-description"></textarea>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</article>
</div>
<div class="extra"></div>
<div class="bottom"></div>
</div>


<div class="side col-md-5 card">
   <!-- <div class="card">  -->  
      <article class="card-group-item">
        <div class="panel panel-default panel-default" data-name="default">
          <div class="card-body">       
            <div class="panel-body panel-body-form" data-name="default">

                <div class="row">
                    <div class="cell form-group col-sm-6 col-md-12" data-name="assignedUser">
                        <label class="control-label" data-name="assignedUser"><span class="label-text">Assigned User</span><span class="required-sign"> *</span></label>
                        <div class="field" >
                            <div class="input-group">
                                <input class=" form-control" type="text"  value="Admin"  placeholder="Select">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><i class="fas fa-angle-up"></i></button>
                                    <button data-action="clearLink" class="btn btn-default btn-icon" type="button" tabindex="-1"><i class="fas fa-times"></i></button>
                                </span>
                            </div>
                            <input type="hidden" data-name="assignedUserId" value="1">

                        </div>
                    </div>
                    <div class="cell form-group col-sm-6 col-md-12" data-name="teams">
                        <label class="control-label" data-name="teams"><span class="label-text">Teams</span></label>
                        <div class="field" data-name="teams">
                            <div class="link-container list-group"></div>

                            <div class="input-group add-team">
                                <input class=" form-control" type="text" value="" autocomplete="espo-teams" placeholder="Select">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><span class="fas fa-angle-up"></span></button>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel panel-default panel-attendees sticked" data-name="attendees">
            <div class="panel-heading">
                <div class="pull-right btn-group panel-actions-container">
                </div>
                <h4 class="panel-title">
                    Attendees
                </h4>
            </div>
            <div class="panel-body panel-body-form" data-name="attendees">
                <div class="row">
                    <div class="cell form-group col-sm-6 col-md-12" data-name="users">
                        <label class="control-label" data-name="users"><span class="label-text">Users</span></label>
                        <div class="field" data-name="users">
                            <div class="link-container list-group"></div>

                            <div class="input-group add-team">
                                <input class=" form-control" type="text" value="" 
                                 placeholder="Select">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><span class="fas fa-angle-up"></span></button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="cell form-group col-sm-6 col-md-12" data-name="contacts">
                        <label class="control-label" data-name="contacts"><span class="label-text">Contacts</span></label>
                        <div class="field" data-name="contacts">
                            <div class="link-container list-group"></div>

                            <div class="input-group add-team">
                                <input class=" form-control" type="text" value="" autocomplete="espo-contacts" placeholder="Select">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><span class="fas fa-angle-up"></span></button>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="cell form-group col-sm-6 col-md-12" data-name="leads">
                        <label class="control-label" data-name="leads"><span class="label-text">Leads</span></label>
                        <div class="field" data-name="leads">
                            <div class="link-container list-group"></div>

                            <div class="input-group add-team">
                                <input class=" form-control" type="text" value="" autocomplete="espo-leads" placeholder="Select">
                                <span class="input-group-btn">
                                    <button  class="btn btn-default btn-icon" type="button" tabindex="-1" title="Select"><span class="fas fa-angle-up"></span></button>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>        </div>  
    </article>     
</div>  
<!-- SIDE  CARD ENDS -->
</div>
</div>
</div>
<div style="float:right;">   <button type="submit"        class="btn btn-primary" value="Submit"  data-name="save">Save</button>  <button type="button" class="      btn btn-default" data-name="cancel">Cancel</button> </div>
    {!! Form::close() !!}

@endsection

@section('script')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->


<script type="text/javascript">
    
 $( document ).ready(function() {
         //alert('ready');

         $("#date_start").datepicker();
    // $("body").on('click', ".date-picker-btn" , function(e) {
    //          //  alert('hello');
    //           // debugger;
    //        //$("#date_start").datepicker();
    //        //$("#date_start").datepicker('show');
    //        $("#date_start").datepicker({
    //             showOn: "button",
    //              buttonText: "Select date"
    //         });


    // });

 });

 

</script>

@endsection