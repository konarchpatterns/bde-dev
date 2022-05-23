<div class="row">
        <div class="col-md-3">
          <b>Click New Clients Unassigned</b>
          <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">
        </div>
        <div class="col-md-1">
          <a href="javascript:void(0);" class="btn btn-sm btn-outline btn-danger mr-2 ml-5"  id="delsession" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-3" align="center">

          <b><span id="selecteddateshowid"></span></b>
           <select class="" id="newcompanyselectionid" onselect="changeFunc()"><option value="Last 3 Months" class="newcompanyselectionclass">Last 3 Months</option><option class="newcompanyselectionclass" value="Current Month">Current Month</option><option class="newcompanyselectionclass" value="Last 6 Months">Last 6 Months</option><option class="newcompanyselectionclass" value="Select Month">Select Month</option></select>
        </div>
        <div class="col-md-5">
         
        <!-- </div>
        <div class="col-md-5"> -->
           @permission('edit.company.assign.user')
              <a href="javascript:void(0)" id="assignuser" class="btn btn-info btn-sm btn-outline rightdiv mr-2">Assign User</a>
              <a class="btn btn-success btn-sm btn-outline rightdiv mr-2" href="{{route('clickclients.assignclicknewcompany')}}" data-toggle="tooltip" data-placement="bottom" title="Assigned Accounts">AA</a>
              <a class="btn btn-success btn-sm btn-outline rightdiv mr-2" href="{{route('clickclients.clicknewcompany')}}"  data-toggle="tooltip" data-placement="bottom" title="Show All Accounts">SAA</a>
            @endpermission
            
           <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"   data-toggle="tooltip" data-placement="bottom" title="Dialed Accounts"  value="DA">DA</a>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont"   data-toggle="tooltip" data-placement="bottom" title="New Accounts"  value="NA">NA</a>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-outline active rightdiv mr-2 filternewdialaccont"   data-toggle="tooltip" data-placement="bottom" title="All Accounts" id="allid" value="ALL">ALL</a>
            
            
        </div>
</div>  

  
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">


  <table id="comp-table" class="table table-bordered  mb-0" style="width:100%">
    <thead class="fhead">
        <tr class="firstrow">
            <th><input type="checkbox"  id="checkboxid1"></th>
            <th>Company Id</th>            
            <th>Company Name</th>
            <th>Client Name</th>
            <th>Phone</th>
            <th>State</th>
            <th>Country</th>
            <th>Timezone Type</th>
          @permission('edit.company.assign.user')
            <th>User</th> 
            <th>Assign BY</th> 
          @endpermission
          <th>Disposition</th>  
        </tr>
        <tr class="secondrow">
            <th></th>
            <th>Company Id</th>            
            <th>Company Name</th>
            <th>Client Name</th>
            <th>Phone</th>
            <th>State</th>
            <th>Country</th>
            <th>Timezone Type</th> 
          @permission('edit.company.assign.user')
            <th>User</th>
            <th>Assign BY</th>
          @endpermission
            <th>Disposition</th>   
        </tr>
    </thead>
    <tbody></tbody>
</table>

  
 


 </div> 
<!-- company disposition modal -->
<div class="modal fade right" id="companydispositionmodal" aria-hidden="true">

    <div class="modal-dialog" >

        <div class="modal-content bg-light">

            <div class="modal-header">
                <h6>All Disposition</h6>
                <label class="btn btn-sm btn-fill btn-info" id="showorderdetail"><b>Order Details</b></label>
                 <label class="btn btn-sm btn-fill btn-info" id="showdispositiondetail"><b>Last Disposition</b></label>
               
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
                    <input type="radio" class="form-check-input" value="Business Closed" name="optradio"> Business Closed
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
                       <input type="radio" class="form-check-input" value="Business Sold" name="optradio"> Business Sold 
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
                  <input type="hidden" name="disposition" id="companycallingnumber" value="">   
                 <input type="hidden" name="disposition" id="companydisposition" value="">
                  <input type="hidden" name="companydispositionback" value="" id="companydispositionbackid">
                       <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="companydescription" tabindex ="2"  placeholder="Enter new description...."  class="form-control form-control51" required></textarea>
                    </div>
                    </div>
                     
               </div>
               <div class="row float-right">
                    <div class="col-md-12 ">
                                <div class="form-group ">
                                     <a href="javascript:void(0)" class="btn btn-primary btn-outline  mt-2" id="submitdisposition"href="#">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>
<!-- order detail modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><b>Order Detail</b></h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
         <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body" id="orderdetail">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- lastdisposition detail -->
<div class="modal fade" id="lastdispositionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lastdispositiontitle"><b>Last Disposition Detail</b></h5>
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body" id="lastdispositiondetail">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<!-- select date popup -->
<div class="modal" tabindex="-1" role="dialog" id="selectdatepopup">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Month and Year</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12" align="center">
         
            <input type="text" name="search" class="" id="newcompanymonth"  autocomplete="off">
        
        
            <a href="#" class="btn btn-primary btn-fil mt-1" id="searchnewcompanyid">Search</a>
        </div>
       
      </div>
      
    </div>
  </div>
</div>
