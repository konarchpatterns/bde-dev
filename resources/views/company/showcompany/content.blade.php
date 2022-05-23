 <div class="">
      <input type="hidden" id="diapositiondata" name="disposition" value="{{$companydata->disposition}}">
      <input type="hidden" id="companyid" name="id" value="{{$companydata->id}}">
        <div class="row">

            <div class="col-md-10">
                <h5><a href="{{route('company.index')}}"><b>Account</b></a> <i class="fa fa-angle-double-right"></i>{{$companydata->company_name}}</h5><input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">       
            </div>
            <div class="col-md-2">
          @if(substr($backto,0,8) == "calendar")
            <a href="{{route('localeventindex1')}}" class=" btn btn-info btn-outline rightdiv">Back</a>
          @else
              <a href="{{route('company.index')}}" class="btn btn-info btn-outline rightdiv">Back</a>
          @endif
        @permission('edit.company')
          <a href="{{route('company.edit',['id'=>$companydata->id,'backto'=>$backto])}}" class="btn btn-success btn-outline rightdiv mr-2">Edit</a>
        @endpermission  
            </div>
        </div>

        <div class="row  mt-2">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                     <div class="card s">
                          <b style="color: black; text-align: center; background-color: " class="ts">Company Detail</b>
                       <div class="card-body ">
               
                         @permission('view.company.name')
                             <h5 ><strong style="color:black">Company Name : </strong>{{$companydata->company_name}}</h5>
                         @endpermission
                        
                         @permission('view.company.website')
                            <h5><b style="color: black">Website : </b>{{$companydata->website_address}}</h5>
                         @endpermission 
                         @permission('view.company.fax')
                             <h5><b style="color: black">Fax No : </b>{{$companyaddress->fax_no}}</h5>
                         @endpermission 
                   </div>
                 </div>
                  @permission('view.company.address')
                    <div class="card s">
                       <b style="color: black;text-align: center;"class="ts">Address</b>                  
                          <div class="card-body">
                       
                              <h5><strong style="color: black">Ho/No :</strong> {{$companyaddress->house_no}}</h5>

                        
                              <h5><strong style="color: black">Street Name :</strong>  {{$companyaddress->street_name}}</h5>
                           
                              <h5><strong style="color: black">Address Line2 :</strong>  {{$companyaddress->address_line_2}}</h5>
                         
                         
                            <h5><strong style="color: black">Country :</strong>  {{$companyaddress->Country}}</h5>
                            
                         
                            <h5><strong style="color: black">State :</strong>  {{$companyaddress->state}}</h5>
                            
                            <h5><strong style="color: black">City/County :</strong>  {{$companyaddress->County}}</h5>
                          
                            <h5><strong style="color: black">Zip Code :</strong>  {{$companyaddress->zip_code}}</h5>
                          
                            <h5><strong style="color: black">Time Zone :</strong>  {{$companyaddress->time_zone}}</h5>
                            
                         
                      </div> 
                  </div>
                  @endpermission 
                 <!-- cut -->
                 
               </div>
                
                  <!--   <hr style="background-color: white"> -->
              
                  <div class="col-md-6">
                  <!-- phone -->
                 
                    <div class="card">
                       <b style="color: black;text-align: center;"class="ts">Other Detail</b>                  
                          <div class="card-body">
                            @permission('view.company.vendor.type')
                                <h5><strong style="color:black">Vendor Type :</strong>  {{$companydata->vendor_type}}</h5>
                            @endpermission
                            @permission('view.company.bussiness.type')
                                <h5><strong style="color:black">Business Type :</strong>  {{$companydata->type_business}}</h5>
                            @endpermission  
                            @permission('view.company.description')    
                                  <h5><strong style="color:black">Description :</strong> {{$companydata->lead_description}}</h5>
                            @endpermission        
                          </div> 
                    </div>
                    
                    <div class="row">
                   
                     <div class="col-md-7 pr-1">
                          <div class="card sr mb-4" > 
                             <h6 class="ts mt-1" style="color:black; text-align: center;"><b>Email</b></h6>
                             <div class="card-body text-center mt-1">
                              @permission('view.company.email')
                                @forelse($companyemails as $emails)
                                @permission('show.company.email') 
                                  <span value="{{$emails->company_email}}" class="px-1">{{$emails->company_email}} <i class="fa fa-envelope" aria-hidden="true" style="font-size:15px;"></i> ({{$emails->email_type}})</span><br>   
                                @else
                                  <span value=""  class="px-1"><i class="fa fa-envelope" aria-hidden="true" style="font-size:20px;"></i> &nbsp;({{$emails->email_type}})</span> &nbsp; 
                                @endpermission        
                                @empty

                                  <h5 class="ts mt-1" style="text-align: center;"><b>No Email</b></h5>  
                            
                              
                                @endforelse
                              @else
                                 XXXXX
                              @endpermission        
                           </div>
                        </div>
                        </div>
                      
                      
                        <div class="col-md-5 pl-1">
                           <div class="card sr mb-4">
                             <h6 class=" ts mt-1" style="color:black; text-align: center;"><b>Phone</b></h6>
                             <div class="card-body text-center mt-1">
                              @permission('view.company.phone')  
                                @forelse($companyphones as $phones)
                                  @permission('show.company.phone')   
                                    <span value="{{$phones->company_phone}}" onclick="redirectToCompanyPhoneURL('{{$phones->company_phone}}','{{$phones->phone_type}}')" class="px-1">{{$phones->company_phone}}<i class="fa fa-phone-square" aria-hidden="true" style="font-size:15px;color:#51C248"></i> ({{$phones->phone_type}})</span><br> 
                                  @else
                                    <span value="" onclick="redirectToCompanyPhoneURL('{{$phones->company_phone}}','{{$phones->phone_type}}')" class="px-1"><i class="fa fa-phone-square" aria-hidden="true" style="font-size:20px;color:#51C248"></i> ({{$phones->phone_type}})</span><br> 
                                  @endpermission

                                @empty

                                    <h5 class="ts mt-1" style="color:white; text-align: center;"><b>No Phone</b></h5>
                                  @endforelse
                              @else
                                 XXXXX
                              @endpermission   
                            </div>
                        </div>  
                        </div>
                       
                     </div>   
                       @permission('view.company.phone')  
                         <div class="form-group" align="center">
                           @if(substr($backto,0,8) == "calendar")
                             <!--  <a href="javascript:void(0);" class="btn3d btn btn-default btn-lg" style="color:red" id="taskdispositionid">Task Disposition</a> -->
                           @else
                           <!--   <a href="javascript:void(0);" class="btn3d btn btn-default btn-lg" style="color:red" id="dispositionid">Add Disposition</a> -->
                           @endif
                     
                          </div>   
                       @endpermission           
  
                         
                  </div>
                     
                             
                      
                 </div>
                </div><!-- card body -->
         </div><!-- card -->
         </div><!-- col-md-12 -->
                      
      </div> <!-- first row -->
 </div> <!-- main div -->

 @permission('view.client') 
     <div class="row">
               <div class="col-md-10" style="text-align: center;">                  
              <b style="color: black;text-align: center;"class="ts">Company Contacts</b>  </div>
              @permission('create.client')
                <div class="col-md-2"> 
                
                    <a href="{{route('client.create',['id'=>$companydata->id])}}"class="btn btn-primary btn-outline rightdiv">Add Client</a>
               
                 </div>  
              @endpermission      
                 <div class="col-md-12 mt-1"> 
                      <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                      <table id="clientrecords" class="table table-bordered table-striped mb-0" style="width:100%">
                                       <thead>
                                         <tr>
                                             <th>Id</th>
                                          @permission('view.client.name')
                                             <th>Name</th>
                                          @endpermission
                                          @permission('view.client.designation')
                                             <th>Designation</th>
                                          @endpermission  
                                          @permission('view.client.phone')   
                                             <th>Phone</th>
                                          @endpermission
                                          @permission('view.client.email')
                                             <th>Email</th>
                                          @endpermission
                                          @permission('view.client')
                                             <th>Show</th>
                                          @endpermission   
                                          @permission('delete.client')
                                             <th>Delete</th>
                                          @endpermission 
                                         </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                     </table>
                      </div>   
                </div>
    </div>  
 @endpermission   
<!--  company disposition log  --> 
 <div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Company Dispositions</b></div>
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
<!--  client disposition log  --> 
 <div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Client Dispositions</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="clientdispositionlog" class="table table-bordered table-striped mb-0" style="width:100%">
                      <thead class="fhead"> 
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Client Name</th>
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
   <!-- activity log table -->
@permission('view.logs') 
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Activity Log</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="activitylog" class="table table-bordered table-striped mb-0" style="width:100%">
                    <thead class="fhead">
                        <tr class="firstrow">
                          <th>No</th>
                          <th>User</th>
                          <th>Action</th>
                          <th>Name</th>
                          <th>Record Type</th>
                          <th>What Modify</th> 
                          <th>Time</th>
                        </tr>
                        <tr class="secondrow">
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
    <div class="modal fade" id="AssignuserModel" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="modelHeading"></h4>

                </div>

                <div class="modal-body">
                    <button class="btncancle">Cancel</button>
                     
                     <div class="input-group input-group-unstyled col-md-8">
                        <input type="text" class="form-control mt-0 pr-1" name="" value="">
                        <button id="assignuser" class=""><i class="fa fa-search"></i></button>
                        <button id="assignuser" class=""><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table id="userrecord" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                     </div>

                </div>

            </div>

        </div>

    </div>
   


                    


<div class="modal fade right" id="companydispositionmodal" aria-hidden="true">

    <div class="modal-dialog" >

        <div class="modal-content bg-light">

            <div class="modal-header">
                <h6>All Disposition</h6>
                <!-- <h4 class="modal-title" id="modelHeading1"></h4> -->
                <!--   <label  class="btn btn-sm btn-fill closedisposition" >X</label> -->
                <label class="btn btn-sm btn-fill btn-info" id="showcompanydetail">Show Detail</label>
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
                <tr>
                </tr>
              </table>
                  
                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off" autofocus>
                        </div>
                 </div> 
                  <input type="hidden" name="disposition" id="companycallingnumber" value="">   
                 <input type="hidden" name="disposition" id="companydisposition" value="{{$companydata->disposition}}">
                  <input type="hidden" name="companydispositionback" value="" id="companydispositionbackid">
                       <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="companydescription" tabindex ="2"  placeholder="Enter new description...."  class="form-control form-control2" required></textarea>
                    </div>
                    </div>
                     
               </div>
               <div class="row float-right">
                    <div class="col-md-12 ">
                                <div class="form-group ">
                                     <a class="btn btn-primary btn-outline  mt-2" id="submitdisposition"href="#">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
<!-- task disposition modal-->
<div class="modal fade" id="companytaskdispositionmodal" aria-hidden="true">

    <div class="modal-dialog" >

        <div class="modal-content bg-light">

            <div class="modal-header">
                <h6>Task Disposition</h6>
                <!-- <h4 class="modal-title" id="modelHeading1"></h4> -->
               <!--    <label  class="btn btn-sm btn-fill closetaskdisposition">X</label> -->
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
                         <input id="taskdatetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off" autofocus>
                        </div>
                 </div> 
                      <input type="hidden" name="taskcompanycallingnumber" id="taskcompanycallingnumber" value="">
                      <input type="hidden" name="taskcallingnumbertype" value="" id="taskcallingnumbertype">

                      <input type="hidden" name="disposition" id="companydisposition" value="{{$companydata->disposition}}">
                      <input type="hidden" name="taskid" id="taskid" value="{{substr($backto,8)}}">
                       <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="companytaskdescription" tabindex ="2"  placeholder="Enter new description...."  class="form-control form-control2" required></textarea>
                    </div>
                    </div>
                     
               </div>
               <div class="row float-right">
                    <div class="col-md-12 ">
                                <div class="form-group ">
                                     <a class="btn btn-primary btn-outline  mt-2" id="submittaskdisposition"href="javascript:void(0);">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
<!-- client disposition modal -->
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
                <tr>
                </tr>
              </table>
                
                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="clientdatetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off">
                        </div>
                 </div> 
                  <input type="hidden" name="disposition" value="" id="clientid"> 
                  <input type="hidden" name="dispositionphone" value="" id="callingnumber"> 
                  <input type="hidden" name="dispositionphone" value="" id="dispositionbackid"> 

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
                                     <a class="btn btn-primary btn-outline  mt-2" id="submitclientpermission"href="javascript:void(0);">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
@include('company.companymodal.companyinfoindisposition.content')
@include('clients.clientmodal.clientinfoindisposition.content')
<!-- 
 <div class="col-md-4">
                        <div class="card ">
                                  
                          <div class="card-body ">
                            <div class="row">
                              <div class="col-md-12 pr-1">
                                  <div class="form-group">
                                    <label>Assigned User</label>
                                      <div class="input-group input-group-unstyled">
                                      <input type="text" class="form-control mt-1" placeholder="" value="{{$user_name}}" id="user_name" readonly="">
                                      <input type="hidden" name="user_id" value="{{$user_id}}" id="user_id">  
                                      </div>
                                    </div>
                              </div>
                            </div>  
                          </div>
                        </div>    
                     </div>
 -->
<!-- <div class="modal fade" id="Historydispositionmodal" aria-hidden="true">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title" id="modelHeading3"></h4>

                </div>

                <div class="modal-body">
                    <button class="btncancle">Cancel</button>
                    <div class="card-body table-full-width table-responsive">
                        <table id="historydispositionrecord" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Action</th>
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

        </div>

    </div> -->