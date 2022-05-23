<div class="">
    <div class="row">
        <div class="col-md-1">
          <h5><b>Leads</b></h5> 
        </div>
         <div class="col-md-8">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
         </div>
        <div class="col-md-3">
          @permission('create.lead')     
            <a class="btn btn-primary btn-outline rightdiv" href="{{route('lead.create')}}">
            Create Lead</a>
          @endpermission
          @permission('edit.lead.assign.user')
            <a href="#" id="assignuserlead" class="btn btn-info btn-outline btn-sm rightdiv mr-2">Assign User</a>
          @endpermission
        </div>
    </div>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="leadrecords" class="table table-bordered table-striped mb-0" style="width:100%">
        <thead class="fhead">
             <tr class="firstrow">
               @permission('view.lead.checkbox')
                <th><input type="checkbox"  id="checkboxid1"></th>
               @endpermission  
                <th>No</th>
               @permission('view.lead.name')
                <th>Company</th>
               @endpermission  
               @permission('view.lead.website')
                <th>Website</th>
               @endpermission
               @permission('view.lead.phone') 
                <th>Phone</th>
               @endpermission
               @permission('view.lead.email') 
                <th>Email</th>
               @endpermission
               @permission('view.lead.status') 
                <th>Status</th>
               @endpermission
               @permission('view.lead.assign.user')
                <th>Assign User</th>
               @endpermission
               @permission('view.lead.assign.by')
                <th>Assign By</th>
               @endpermission
               @permission('view.lead.address')
                <th>State</th> 
               @endpermission
               @permission('view.lead.country')
                <th>Country</th>
               @endpermission
            </tr>
            <tr class="secondrow">
              @permission('view.lead.checkbox')
                <th><input type="checkbox"  id="checkboxid"></th>
              @endpermission 
                  <th>No</th>
               @permission('view.lead.name')
                <th>Company</th>
               @endpermission  
               @permission('view.lead.website')
                <th>Website</th>
               @endpermission
               @permission('view.lead.phone') 
                <th>Phone</th>
               @endpermission
               @permission('view.lead.email') 
                <th>Email</th>
               @endpermission
                <th>Status</th>
               @permission('view.lead.assign.user')
                <th>Assign User</th>
               @endpermission
               @permission('view.lead.assign.by')
                <th>Assign By</th>
               @endpermission
               @permission('view.lead.address')
                <th>State</th> 
               @endpermission
               @permission('view.lead.country')
                <th>Country</th>
               @endpermission
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>
<div class="modal fade right" id="AssignuserModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                  <label id="closeuser" class="btncancle">Cancel</label>
            </div>

            <div class="modal-body">
              
                 <input type="hidden" value="" name="leadid" id="leadid">
                 <input type="hidden" value="" id="currentPageIndexid">
                 
                <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                    <table id="userrecord" class="table table-hover table-striped" style="width: 100%">
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
                       <input type="radio" class="form-check-input" value="In House" name="optradio"> In House
                       </label>
                     </div>
                  </td>
                </tr>
              </table>
                  
                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off" autofocus>
                        </div>
                 </div> 
                  
                      <input type="hidden" name="disposition" id="dispositioncompanyid" value="">
                      <input type="hidden" name="disposition" id="companycallingnumber" value="">
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
                                     <a class="btncreate  mt-2" id="submitdisposition"href="#">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
@include('calendars.companyindisposition')