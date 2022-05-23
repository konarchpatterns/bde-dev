<div class="modal fade right " id="companyinfo" aria-hidden="true" >
    <div class="modal-dialog modal-lg">

      <div class="modal-content" style="background-color: #F8F9F9">
                           <!--  <div class="modal-header"> -->
        <div class="row mr-1">
            <div class="col-md-12 text-center">
               <label class="ts mt-2" style="color:#34495E"><b>Company Data</b></label> 
                <label id="companyinfoclose" class="btn btn-sm btn-fill btn-danger rightdiv mt-2">X</label> 
            </div>
            <div class="col-md-12"> 
              <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#Comapny_Detail" class="nav-link active" data-toggle="tab">Company Detail</a>
                </li>
                <li class="nav-item">
                    <a href="#Client_list" class="nav-link" data-toggle="tab">Employee List</a>
                </li>
                <li class="nav-item">
                    <a href="#Disposition_History" class="nav-link" data-toggle="tab">Disposition History</a>
                </li>
            </ul>
            </div>
        </div>

        <div class="modal-body" style="background-color: #5D6D7E ">
              <div class="tab-content">
        <div class="tab-pane fade show active" id="Comapny_Detail">
           
                  <h5><strong style="color: #D2B48C">Company Name : </strong><label id="companyname_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Website  : </strong><label id="companywebsite_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Country  : </strong><label id="companycountry_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">State  : </strong><label id="companystate_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">City  : </strong><label id="companycity_d" style="text-transform: capitalize;"></label></h5>
                  <h5><strong style="color: #D2B48C">Time Zone  : </strong><label id="companytimezone_d" style="text-transform: capitalize;"></label></h5>
        </div>
        <div class="tab-pane fade" id="Client_list">
            <div class="table-wrapper-scroll-y1 my-custom-scrollbar1">
                    <table id="clientlistitable" class="table table-dark table-bordered">
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
        <div class="tab-pane fade" id="Disposition_History">
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="width:100%">
                    <table id="dispositionlistitable" class="table table-dark table-bordered" >
                        <thead >
                            <tr>
                                <th>Sr No.</th>
                                <th>Status</th>
                                <th>Follow Up Date</th>
                                <th>Description</th>
                                <th>Time</th>
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
      </div>
    </div>
  </div>
