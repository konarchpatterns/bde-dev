<div class="">
    <div class="row">
        <div class="col-md-2">
          <h5><b>User's Summary</b></h5> 

        </div>
         <div class="col-md-1">
             <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
    </div>
    </div>
   
    
 <br>
<h5><b>BDE Users Summary</b></h5>
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="bdeusersummaryrecord" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>User Id</th>

                <th>Currently Assigned Company</th> 
                <th>Unassigned Company</th> 
                <th>Total Company</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
<h5><b>Sales Users Summary - Active Users</b></h5>
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="usersummaryrecord_a" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>User Id</th>
                <th>Calls Made<br>Today</th>
                <th>Currently Assigned Company</th> 
                <th>Unassigned Company</th> 
                <th>Total Company</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
<h5><b>Sales Users Summary - InActive Users</b></h5>
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="usersummaryrecord_i" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>User Id</th>
                 <th>Calls Made<br>Today</th>
                <th>Currently Assigned Company</th> 
                <th>Unassigned Company</th> 
                <th>Total Company</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
<h5><b>Data Entry Summary</b></h5>
<!-- data entry role summary datatable -->
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="dataentryusersummaryrecord" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Name</th>
                <th>User Id</th>
                <th>Created Company</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>


<!-- currntly allocated table data -->
<div class="modal fade right" id="currentlyallocatedcompanyModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #ABABAB">

            

            <div class="modal-body ">
              <div class="row">
                     <div class="col-md-10">
                          <b><label id="cureentlyassignuserlabelmoal1"></label></b>
                     </div>
                     <div class="col-md-2">
                         <label id="closecurrentcompanymodal" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                     </div>
              </div>
              <div class="row">
                 <input type="hidden" name="" id="currntlyassigncompanyuserid" value="" > 
                <div class="col-sm-4"> 
                 <input type="text" id="myInputday"  placeholder="Search by date" title="Type in a name" class="form-control">  
                </div>
                <div class="col-sm-4 px-0"> 
                 <input type="text" id="myInputmonth" class="form-control"  placeholder="Search by month" title="Type in a name">  
                </div>
                <div class="col-sm-4"> 
                 <input type="text" id="myInputyear"   placeholder="Search by year" title="Type in a name" class="form-control">
                 </div> 

              </div> 

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="usercurrentlysummaryrecordcompany" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Assigned Company</th>
                            
                            </tr>
                        </thead>
                        <tbody align="center" id="geeks">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>

<!-- unassign company list  table-->
<div class="modal fade right" id="unallocatedcompanylistModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #ABABAB">

            <div class="modal-body ">
              <div class="row">
                     <div class="col-md-10">
                          <b><label id="unallocatedcompanylistModel1"></label></b>
                     </div>
                     <div class="col-md-2">
                         <label id="closeunallocatedcompanylistModel" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                     </div>
              </div>
              <div class="row">
                 <input type="hidden" name="" id="unallocatedcompanyuserid" value="" > 
                <div class="col-sm-4"> 
                 <input type="text" id="myInputday"  placeholder="Search by date" title="Type in a name" class="form-control">  
                </div>
                <div class="col-sm-4 px-0"> 
                 <input type="text" id="myInputmonth" class="form-control"  placeholder="Search by month" title="Type in a name">  
                </div>
                <div class="col-sm-4"> 
                 <input type="text" id="myInputyear"   placeholder="Search by year" title="Type in a name" class="form-control">
                 </div> 

              </div> 

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="unallocatedcompanytable" class="table table-dark table-bordered">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Assign Date</th>
                                <th>Unassign Date</th>
                                <th>Total Company</th>
                            
                            </tr>
                        </thead>
                        <tbody align="center" id="geeks">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>
<!-- total allocated table data -->
<div class="modal fade right" id="totalallocatedcompanyModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #ABABAB">

            

            <div class="modal-body ">
              <div class="row">
                  <div class="col-md-10">
                        <b><label id="totalassignuserlabelmoal1"></label></b>
                  </div>
                <div class="col-md-2">
                  <label id="closetotalcompanymodal" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                </div>
              </div>
              <div class="row">
                 <input type="hidden" name="" id="totalassigncompanyuserid" value="" > 
                <div class="col-sm-4"> 
                 <input type="text" id="mytotalInputday"  placeholder="Search by date" title="Type in a name" class="form-control">  
                </div>
                <div class="col-sm-4 px-0"> 
                 <input type="text" id="mytotalInputmonth" class="form-control"  placeholder="Search by month" title="Type in a name">  
                </div>
                <div class="col-sm-4"> 
                 <input type="text" id="mytotalInputyear"   placeholder="Search by year" title="Type in a name" class="form-control">
                 </div> 

              </div> 

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="usertotlalsummaryrecordcompany" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Assign Date</th>
                                <th>Unassign Date</th>
                                <th>Total Company</th>
                            
                            </tr>
                        </thead>
                        <tbody align="center" id="geeks">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>

<!-- currently allocated company name table data -->
<div class="modal fade right" id="currentlyallocatedcompanynameModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #797D7F">
            <div class="modal-body ">
              <div class="row">
                     <div class="col-md-10">
                            <b><label id="cureentlyassignuserlabel"></label></b>
                            <input type="hidden" name="userid" id="currentlyassignuserid" value="">
                     </div>
                <div class="col-md-2">
                  <label id="closecurrentlycompanynamemodal" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                </div>
              </div>
              <div class="row">
                 <div class="col-sm-4"> 
                  <input type="text" id="myInputcompanyname"  placeholder="Search Company" title="Type in a name" class="form-control">  
                 </div>
              </div> 

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="currentlyallocatedcompanyname" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Company id</th>
                                <th>Company Name</th>
                                <th>Doesn't Qualify</th>
                                <th>Sale</th>
                                <th>No Answer</th>
                                <th>Answering Machine</th>
                                <th>Hang Up</th>
                                <th>Not Interested</th>
                                <th>Number Not In Service</th>
                                <th>Interested</th>
                                <th>Follow Up</th>
                                <th>Busy Number</th>
                                <th>Call Back</th>
                                <th>Cancel</th>  
                                <th>In House</th>
                                <th>Closed Window</th>  
                            </tr>
                        </thead>
                        <tbody align="center" id="geekscompanyname">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>
<!-- total allocated company name table data -->
<div class="modal fade right" id="totalallocatedcompanynameModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #797D7F">

            

            <div class="modal-body">
              <div class="row">
                     <div class="col-md-10">
                           <b><label id="totalassignuserlabel"></label></b>
                     </div>
                <div class="col-md-2">
                  <label id="closetotalcompanynamemodal" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                  <input type="hidden" name="" value="" id="currentlyassignuserid" >
                </div>
              </div>
              <div class="row">
                 <div class="col-sm-4"> 
                  <input type="text" id="totalmyInputcompanyname"  placeholder="Search Company" title="Type in a name" class="form-control">  
                 </div>
              </div> 

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="totalallocatedcompanyname" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Company id</th>
                                <th>Company Name</th>
                                <th>Doesn't Qualify</th>
                                <th>Sale</th>
                                <th>No Answer</th>
                                <th>Answering Machine</th>
                                <th>Hang Up</th>
                                <th>Not Interested</th>
                                <th>Number Not In Service</th>
                                <th>Interested</th>
                                <th>Follow Up</th>
                                <th>Busy Number</th>
                                <th>Call Back</th>
                                <th>Cancel</th> 
                                <th>In House</th> 
                                <th>Closed Window</th>  
                            </tr>
                        </thead>
                        <tbody align="center" id="totalgeekscompanyname">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>
</div>

<!-- current allocated  disposition detail table data -->
<div class="modal fade right" id="currentallocatedcompanydispositionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content " style="background-color: #ABABAB">

            

            <div class="modal-body ">
              <div class="row">
                  <div class="col-md-10">
                        <b><label id="">Disposition Information</label></b>
                  </div>
                <div class="col-md-2">
                  <label id="closecurrentcompanydispositionmodal" class="btn btn-sm btn-fill btn-danger rightdiv ">X</label>
                </div>
              </div>
              

              <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                <b style="color: black;">Company</b>
                    <table id="usercurrentcompanydisposition" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                            
                            </tr>
                        </thead>
                        <tbody align="center">
                        </tbody>
                    </table>
                    
              <b style="color: black;">Client</b>
                    <table id="usercurrentclientdisposition" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                            
                            </tr>
                        </thead>
                        <tbody align="center">
                        </tbody>
                    </table>
                    
              </div>
                
            </div>

        </div>

    </div>

</div>