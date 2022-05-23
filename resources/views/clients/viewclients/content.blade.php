<div class="">
    <div class="row">
        <div class="col-md-1">
          <h5><b>Contacts</b></h5> 
          <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">
        </div>
         <div class="col-md-9">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
         </div>

        <div class="col-md-2">
          @permission('create.client') 
            <a class="btn btn-primary btn-outline rightdiv" href="{{route('client.create',['id'=>'noid'])}}">Create Contact</a>
          @endpermission  
        </div>
    </div>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="clientrecords" class="table table-bordered table-striped mb-0" style="width:100%">
        <thead class="fhead">
             <tr class="firstrow">
          
              
                <th>No</th>
              @permission('view.client.name')
                <th>Name</th>
              @endpermission
              @permission('view.client.company.name')
                <th>Company</th>
              @endpermission
              @permission('view.client.phone')
                <th>Phone</th>
              @endpermission
              @permission('view.client.email')
                <th>Email</th>
              @endpermission
              @permission('view.client.name')
                <th>Disposition</th>
              @endpermission
          
            </tr>
            <tr class="secondrow">
             
          
                <th>No</th>
                @permission('view.client.name')
                  <th>Name</th>
                @endpermission
                @permission('view.client.company.name')
                  <th>Company</th>
                @endpermission
                @permission('view.client.phone')
                  <th>Phone</th>
                @endpermission
                @permission('view.client.email')
                  <th>Email</th>
                @endpermission
                @permission('view.client.name')
                 <th>Disposition</th>
                @endpermission
          
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>

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
                  <input type="hidden" name="disposition" value="" id="clientid"> 
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
@include('clients.clientmodal.clientinfoindisposition.content')