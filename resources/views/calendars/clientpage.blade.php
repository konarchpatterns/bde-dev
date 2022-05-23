<div class="modal fade right" id="clientinfo" aria-hidden="true">
    <div class="modal-dialog modal-lg">

      <div class="modal-content  bg-dark">
                           <!--  <div class="modal-header"> -->
        <div class="row mr-1">
            <div class="col-md-7">
                <h4 align="right"><strong style="color: #D2B48C">Client Data</strong></h4> 
            </div>
            <div class="col-md-5 mt-2"> 

                <label id="clientclose" class="btn btn-sm btn-fill btn-danger rightdiv">X</label>   
            </div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-5 card ml-3">
                  <input type="hidden" name="" value="" id="clientdispositionid">
                   <h5 class="mt-1" align="center"><strong style="color: #D2B48C">Client Detail</strong></h5>
                  <h5><strong style="color: #D2B48C">Client Name : <span id="client_name"></span></strong></h5>
                  <h5><strong style="color: #D2B48C">Designation  : <span id="designation"></span> </strong></h5>
                  <h5><strong style="color: #D2B48C">Linkedin  : <span  id="linkedin"></span></strong></h5>

                </div>
                <div id="clientemail"class="col-md-4 card ml-3" style="color: #D2B48C">
                   <h5 class="mt-1" align="center"><strong style="color: #D2B48C">Email</strong></h5>
                </div> 
                <div id="clientphone"class="col-md-2 card ml-3" style="color: #D2B48C">
                   <h5 class="mt-1" align="center"><strong style="color: #D2B48C">Phone</strong></h5>
                </div>  

            </div>
            <div class="form-group" align="center">
                                   <!--  <label>Disposition</label> -->
                                   <a href="#" class="btn3d btn btn-default btn-lg" style="color:red" id="clientdispositionbtn">Add Disposition</a>
                                   <!--  <textarea name="comment" class="form-control mt-0" rows="3"></textarea> -->
                    </div> 
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="clientdispositiondialogbox" aria-hidden="true">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <div class="modal-header">
               <h5 style="color: black"> <b>Disposition</b></h5>
               <!--  <h4 class="modal-title" id="modelHeading"></h4> -->
                  <label  class="btn btn-sm btn-fill btn-danger  closeclientdisposition">X</label>
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
                </tr>
              </table>
                  
                 <div id="followupid" class="col-md-5 pl-1 followupvisible">
                        <div class="form-group">
                         <label><b>Followup Date</b> </label>
                         <input id="clientdatetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off">
                        </div>
                 </div> 
                  

                     <!-- <textarea  id="clientolddisposition" tabindex="1" readonly="readonly" style="width:99%; height:160px;"></textarea>-->

                  <input type="hidden" name="disposition" value="" id="clientdispositions"> 
                      <div class="col-md-12 pl-1">
                        <div class="form-group">
                       <label><b>Description</b> </label>
                      <textarea autofocus id="clientdescription" tabindex ="2"  placeholder="Enter Description...."   style="width:99%; height:100px;" required></textarea>
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