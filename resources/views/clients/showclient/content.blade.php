<div class="">
    <div class="row">

        <div class="col-md-10 ">
            <h5><a href="{{route('client.index')}}" class="mt-0"><b>Contacts</b></a> <i class="fa fa-angle-double-right"></i>{{$clientdata->client_first_name}} {{$clientdata->client_last_name}}</h5>   
            <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">       
        </div>
        <div class="col-md-2 float-right">
         
          @if(substr($backto,0,8) == "calendar")
            <a href="{{route('localeventindex1')}}" class="btn btn-info btn-outline rightdiv">Back</a>
          @elseif($backto == 'company')
            @if($companydata->converted == 'converted')
                <a href="{{route('company.show',['id'=>$companydata->id,'backto'=>'normal'])}}" class="btn btn-info btn-outline rightdiv">Back</a>
            @else
                 <a href="{{route('lead.show',['id'=>$companydata->lead_id,'backto'=>'normal'])}}" class="btn btn-info btn-outline rightdiv">Back</a>
            @endif
          @else
              <a href="{{route('client.index')}}"class="btn btn-info btn-outline rightdiv">Back</a>
          @endif
            <input type="hidden" name="backto" value="{{$backto}}">
          @permission('edit.client') 
            <a href="{{route('client.edit',['id'=>$clientdata->id,'backto'=>$backto])}}" class="btn btn-success btn-outline rightdiv mr-2">Edit</a>
          @endpermission  
        </div>
    </div>

    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body ">
                   <div class="row">
                  <div class="col-md-5">  
                  <div class="card s"> 
                    <b style="color: black; text-align: center; background-color: " class="ts">Client Detail</b>
                    <div class="card-body ">
                      @permission('view.client.name') 
                        <h5><strong style="color: black">Client Name : </strong>{{$clientdata->salutation_name}}  {{$clientdata->client_first_name}}  {{$clientdata->client_last_name}}</h5>
                      @endpermission 
                      @permission('view.client.designation') 
                        <h5><strong style="color: black">Designation : </strong> {{$clientdata->client_designation}}</h5>         
                      @endpermission   
                      @permission('view.client.description')         
                        <h5><strong style="color: black">Linkedin : </strong> {{$clientdata->linkedin_url}}</h5> 
                         <h5><strong style="color: black">Description : </strong> {{$clientdata->lead_description}}</h5>     
                      @endpermission
                      @permission('view.client.company.name')
                        <h5><strong style="color: black">Company Name : </strong> {{$companydata->company_name}}</h5>  
                        <input type="hidden" name="clientid" value="{{$clientdata->id}}" id="clientid">
                      @endpermission      
                    </div> <!-- inner card1 body -->
                  </div><!--  inner card1  -->
                 </div> <!-- inner card column  -->
               
                  <div class="col-md-4">  
                  <div class="card s"> 
                       <b style="color: black; text-align: center; background-color: " class="ts">Client Email</b>
                       <div class="card-body text-center">
                        @permission('view.client.email')  
                          @forelse($emailarray as $emails)
                           @permission('show.client.email')
                            <span value="{{$emails->client_email}}"  class="px-1" style="display: inline-block; color: white">{{$emails->client_email}}<i class="fa fa-envelope" aria-hidden="true" style="font-size:15px;color:white"></i>({{$emails->email_type}})</span><br>  
                           @else
                            <span value="{{$emails->client_email}}"  class="px-1" style="display: inline-block"><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;color:white"></i></span> <p style="display: inline-block;color: white" class="mt-0">({{$emails->email_type}})</p><br>
                           @endpermission      
                          @empty

                            <h5 class="ts mt-1" style="text-align: center;"><b>No Email</b></h5>
                            @endforelse
                        @else
                         <span style="color: white"> XXXXX </span>
                        @endpermission
                        </div> <!-- second inner card1 body -->
                    </div><!-- second inner card1  -->
                    </div> <!-- second inner card column  -->
                 
                  
                    <div class="col-md-3">  
                    <div class="card s"> 
                       <b style="color: black; text-align: center; background-color: " class="ts">Client Phone</b>
                       <div class="card-body text-center">   
                        @permission('view.client.phone')
                          @forelse($phonearray as $phones)
                            @permission('show.client.phone')
                              <span value="{{$phones->client_phone}}" onclick="redirectToPhoneURL('{{$phones->client_phone}}','{{$phones->phone_type}}')" class="px-1" style="display: inline-block; color:white">{{$phones->client_phone}}<i class="fa fa-phone-square" aria-hidden="true" style="font-size:15px;color:#51C248"></i> ({{$phones->phone_type}})</span><br> 
                            @else
                              <span value="{{$phones->client_phone}}" onclick="redirectToPhoneURL('{{$phones->client_phone}}','{{$phones->phone_type}}')" class="px-1" style="display: inline-block"><i class="fa fa-phone-square" aria-hidden="true" style="font-size:20px;color:#51C248"></i></span><p style="display: inline-block;color: white">({{$phones->phone_type}})</p><br>
                            @endpermission  
                          @empty
                              <h5 class="ts mt-1" style="text-align: center;"><b>No Phone</b></h5>     
                            @endforelse
                         @else
                            <span style="color: white"> XXXXX </span>
                         @endpermission
                        </div> <!-- third inner card1 body -->

                    </div><!-- third inner card1  -->
                @permission('view.client.phone')
                  <!--   <div class="form-group" align="center">
                        @if(substr($backto,0,8) == "calendar")
                                 <a href="javascript:void(0);" class="btn3d btn btn-default btn-lg" style="color:red" id="clienttaskdispositionid">Task Disposition</a>
                                 <input type="hidden" name="calendar" value="calendar" id="checkcalendar"> -->
                             
                        @else
                                   <!--  <label>Disposition</label> -->
                                  <!--  <a href="javascript:void(0);" class="btn3d btn btn-default btn-lg" style="color:red" id="clientdispositionid">Add Disposition</a> -->
                        @endif

                                   <!--  <textarea name="comment" class="form-control mt-0" rows="3"></textarea> -->
                    <!-- </div> --> 
                @endpermission
                    </div> <!-- third inner card column  -->

                  </div><!--  main card row    -->       
                </div> <!--  main crad body -->
            </div><!-- main card -->
        </div> <!-- main col row -->
    </div> <!-- main row -->
</div> <!-- first div -->




<div class="modal fade right" id="clientdispositiondialogbox" aria-hidden="true">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">
               <h5 style="color: black"> <b>All Disposition</b></h5>
               <!--  <h4 class="modal-title" id="modelHeading"></h4> -->
               <!--    <label  class="btn btn-sm btn-fill  closedisposition">X</label> -->
               <label class="btn btn-sm btn-fill btn-info" id="showclientdetail">Show Detail</label>
            </div>

            <div class="modal-body">
              
                 <!-- <input type="hidden" value="" name="leadid" id="leadid">
                 <input type="hidden" value="" id="currentPageIndexid"> -->
                 
               <div class="row">

              <table>
                <tr>
                  <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Doesn't Qualify" name="optradio"> Doesn't Qualify
                    </label>
                   </div>
                  </td>
                  <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Sale" name="optradio"> Sale
                    </label>
                  </div>
                 </td>
                 <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="No Answer" name="optradio"> No Answer
                    </label>
                  </div>
                 </td>
               </tr>
              <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Answering Machine" name="optradio"> Answering Machine
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Hang Up" name="optradio"> Hang Up
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Disconnected Number" name="optradio"> Disconnected Number
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Not Interested" name="optradio">  Not Interested
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Wrong Number" name="optradio"> Wrong Number
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Number Not In Service" name="optradio"> Number Not In Service
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Interested" name="optradio">  Interested
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Follow Up" name="optradio">  Follow Up
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Busy Number" name="optradio"> Busy Number
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Call Back" name="optradio"> Call Back
                       </label>
                     </div>
                  </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Cancel" name="optradio"> Cancel
                       </label>
                     </div>
                  </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Authority Not Available" name="optradio"> Authority Not Available
                       </label>
                     </div>
                  </td>
                </tr>
                <tr>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Do Not Call" name="optradio"> Do Not Call
                       </label>
                     </div>
                    </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="In House" name="optradio"> In House
                       </label>
                     </div>
                  </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Already Client" name="optradio"> Already Client 
                       </label>
                     </div>
                  </td>
                </tr>
              </table>
                  
                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off">
                        </div>
                 </div> 
                  <input type="hidden" name="disposition" value="{{$clientdata->clientdisposition}}" id="clientdispositions"> 
                  <input type="hidden" name="dispositionphone" value="" id="callingnumber">
                  <input type="hidden" name="dispositionback" value="" id="dispositionbackid"> 
                      <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="clientdescription" tabindex ="2"  placeholder="Enter Description...."  class="form-control form-control2" required></textarea>
                    </div>
                  </div>
                     
               </div>
               <div class="row float-right">
                    <div class="col-md-12 ">
                                <div class="form-group ">
                                     <a class="btncreate  mt-2" id="submitclientpermission"href="javascript:void(0);">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Dispositions</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="dispositionlog" class="table table-bordered table-striped mb-0" style="width:100%">
                      <thead class="fhead"> 
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Followup Date</th>
                            <th>Description</th>
                            <th>Time</th>  
                        </tr>
                      </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>   
@permission('view.logs') 
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Activity Log</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="activitylog" class="table table-bordered table-striped mb-0" style="width:100%">
                      <thead class="fhead">
                        
                        <tr >
                            <th>No</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Record Type</th>
                            <th>What Modify</th> 
                            <th>Time</th>  
                        </tr>
                      </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>   
@endpermission
<!-- task disposition modal -->
<div class="modal fade right" id="clienttaskdispositiondialogbox" aria-hidden="true">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">
               <h5 style="color: black"> <b>Task Disposition</b></h5>
               <!--  <h4 class="modal-title" id="modelHeading"></h4> -->
                <!--   <label  class="btn btn-sm btn-fill  closetaskdisposition">X</label> -->
            </div>

            <div class="modal-body">
              
                 <!-- <input type="hidden" value="" name="leadid" id="leadid">
                 <input type="hidden" value="" id="currentPageIndexid"> -->
                 
               <div class="row">

              <table>
                <tr>
                  <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Doesn't Qualify" name="optradio"> Doesn't Qualify
                    </label>
                   </div>
                  </td>
                  <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Sale" name="optradio"> Sale
                    </label>
                  </div>
                 </td>
                 <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="No Answer" name="optradio"> No Answer
                    </label>
                  </div>
                 </td>
               </tr>
              <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Answering Machine" name="optradio"> Answering Machine
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Hang Up" name="optradio"> Hang Up
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Disconnected Number" name="optradio"> Disconnected Number
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Not Interested" name="optradio">  Not Interested
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Wrong Number" name="optradio"> Wrong Number
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Number Not In Service" name="optradio"> Number Not In Service
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                <td>
                 <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Interested" name="optradio">  Interested
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Follow Up" name="optradio">  Follow Up
                    </label>
                  </div>
                </td>
                <td>
                   <div class="form-check-inline">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="Busy Number" name="optradio"> Busy Number
                    </label>
                  </div>
                </td>
                </tr>
                <tr>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Call Back" name="optradio"> Call Back
                       </label>
                     </div>
                  </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Cancel" name="optradio"> Cancel
                       </label>
                     </div>
                  </td>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Authority Not Available" name="optradio"> Authority Not Available
                       </label>
                     </div>
                  </td>
                </tr>
                <tr>
                  <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="Do Not Call" name="optradio"> Do Not Call
                       </label>
                     </div>
                    </td>
                    <td>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                       <input type="radio" class="form-check-input" value="In House" name="optradio"> In House
                       </label>
                     </div>
                  </td>
                </tr>
              </table>
                <input type="hidden" name="taskcallingnumber" value="" id="taskcallingnumber">
                <input type="hidden" name="taskcallingnumbertype" value="" id="taskcallingnumbertype">

                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="taskdatetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off">
                        </div>
                 </div> 
                  <input type="hidden" name="disposition" value="{{$clientdata->clientdisposition}}" id="clientdispositions"> 
                  <input type="hidden" name="taskid" id="taskid" value="{{substr($backto,8)}}">
                      <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="clienttaskdescription" class="form-control form-control2" tabindex ="2"  placeholder="Enter Description...."></textarea>
                    </div>
                  </div>
                     
               </div>
               <div class="row float-right">
                    <div class="col-md-12 ">
                                <div class="form-group ">
                                     <a class="btncreate  mt-2" id="submitclienttaskdisposition"href="javascript:void(0);">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
@include('clients.clientmodal.clientinfoindisposition.content')



















<!-- show Assign user box for client -->
<!-- <div class="col-md-4">
    <div class="card ">
        <div class="card-body ">
            <div class="row">
                <div class="col-md-11 pr-1">
                    <div class="form-group">
                        <label>Assigned User</label>
                                  
                        <input type="text" class="form-control mt-1" placeholder="" value="{{$user_name}}" id="user_name" readonly="">
                                
                    </div>
                </div>
            </div>                
        </div>
    </div>
</div> -->