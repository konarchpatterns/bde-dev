 <div class="modal fade right" id="clientinfoindisposition" aria-hidden="true" >
    <div class="modal-dialog modal-lg">

      <div class="modal-content" style="background-color: #F8F9F9">
                           <!--  <div class="modal-header"> -->
        <div class="row mr-1">
            <div class="col-md-12 text-center">
               <label class="ts mt-2" style="color:#34495E"><b>Client Data</b></label> 
                <label id="clientinfoclose" class="btn btn-sm btn-fill btn-danger rightdiv mt-2">X</label> 
            </div>
            <div class="col-md-12"> 
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#Client_Detail" class="nav-link active" data-toggle="tab">Client Detail</a>
                </li>
                 <li class="nav-item">
                    <a href="#Other_Client_list" class="nav-link" data-toggle="tab">Company Employee</a>
                </li>
                <li class="nav-item">
                    <a href="#Client_Disposition_History" class="nav-link" data-toggle="tab">Disposition History</a>
                </li>
            </ul>
            </div>
        </div>

        <div class="modal-body" style="background-color: #5D6D7E ">
              <div class="tab-content">
        <div class="tab-pane fade show active" id="Client_Detail">
           
                  <h5><strong style="color: #D2B48C">Client Name : </strong><label id="clientname_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Designation : </strong><label id="designation_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Company Name  : </strong><label id="clientcompanyname_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Country  : </strong><label id="clientcountry_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">State  : </strong><label id="clientstate_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">City  : </strong><label id="clientcity_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Time Zone  : </strong><label id="clienttimezone_d" style="text-transform: capitalize;"></label></h5>
        </div>
        <div class="tab-pane fade" id="Other_Client_list">
            <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="companyclientlistitable" class="table table-dark table-bordered">
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Client Name</th>
                                <th>Designation</th>
                            </tr>
                        </thead>
                        <tbody align="center" id="geeks">
                        </tbody>
                    </table>
                    
              </div>
        </div>
        <div class="tab-pane fade" id="Client_Disposition_History">
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="width:100%">
                    <table id="clientdispositionlistitable" class="table table-dark table-bordered" >
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Status</th>
                                <th>Follow Up Date</th>
                                <th>Description</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody align="center" >
                        </tbody>
                    </table>
                    
              </div>
        </div>
    </div>
            </div> 
        </div>
      </div>
    </div>
  </div>