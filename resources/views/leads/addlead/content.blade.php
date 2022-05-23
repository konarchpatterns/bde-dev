 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
<form action="{{route('lead.store')}}" method="post" onsubmit="return checkForm(this);"> 
    @csrf
 <div class="">
    <div class="row">

        <div class="col-md-8">
            <h5><a href="{{route('lead.index')}}"><b>Lead</b><a> <i class="fa fa-angle-double-right"></i>Create</h5>       
        </div>
        <div class="col-md-4">
        <a href="{{route('lead.index')}}" class=" btn btn-info btn-outline rightdiv">Back</a>
        <input type="submit" name="myButton" id="primaryButton" class="btn btn-success btn-outline rightdiv mr-2" value="Save">
       <!--  <button id="primaryButton" class="btnsave rightdiv mr-2">Save</button>  -->
        </div>
    </div>

    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card">
                
            <div class="card-body ">
            <b>Company Detail</b>
                <div class="row ">
                     <div class="col-md-2 pr-1 ">
                        <div class="form-group ">
                            <label>Company Name</label>
                           
                            <input type="text" class="form-control mt-0 compinput" id='company_name' name="company_name" value=""  autocomplete="off">
                           <!--  <div id="companyList"></div> -->
                        </div>
                        
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" class="form-control mt-0" name="website_address" value="">
                        </div>
                    </div>
                
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Fax No</label>
                            <input type="text" class="form-control mt-0" name="fax_no" value="">
                        </div>
                    </div>
                
                    <div class="col-md-3 px-1">
                        <div id="emailtextboxcompany" class="form-group-sm">
                            <label>Company Email</label>
                                   <!--  <input type="email" class="form-control mt-0 coemail"  name="companyemail[]" value=""> -->
                                <div class="input-group my-group">
                                    <input type="email" class="form-control mt-0 coemail" id="companyemails" name="companyemail[]" value="">
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="">
                                        <option value="Work">Work</option>
                                        <option value="Home">Other</option>
                                    </select> 
                                    
                            </div>
                          
                          
                            </div> 
                            <!-- <div class="error" id="emailErr"></div>  -->
                            <a href="javascript:void(0)" id="addcompanyemail" class="btn btn-sm btn-warning btn-outline mt-1"> + </a>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div id="phonetextboxcompany" class="form-group-sm">
                            <label>Company Phone</label>
                              
                                <!--     <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="" >   -->
                                <div class="input-group my-group">
                                    <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="" id="companyclient_phones">
                                    <select id="company_phone_type[]" name="company_phone_type[]" class="" value="">
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                   
                                </div>   
                        </div>
                      <!--   <div class="error" id="mobileErr"></div> -->
                        <a href="javascript:void(0)" id="addcompanyphone" class="btn btn-sm btn-warning mt-1 btn-outline"> + </a>
                    </div>
                    <div class="col-md-3 pr-1">
                         <label>Department</label>
                         <br>
                        <select  name="leaddepatment[]" class="form-control mt-0" id="departmentid" multiple>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Data">Data</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Custom">Custom</option>
                        </select>
                        <input type="hidden" name="customdetail" id="customdetailins">
                         <input type="hidden" name="custompopvalue" id="custompopvalueid" value="">
                    </div>
                    <div class="col-md-2 px-1">
                         <label>Lead Provide By</label>
                        <select  name="leadprovidedby" class="form-control mt-0">
                                    @foreach($users as $user)
                                     <option value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                        </select>
                    </div>
                     <div class="col-md-2 px-1">
                         <label>Assign To</label>
                        <select  name="assignto" class="form-control mt-0">
                                    @foreach($users as $user)
                                     <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                        </select>
                    </div>
                    <div class="col-md-5 pl-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="lead_description" class="form-control form-control2 mt-0 description"></textarea>
                            </div>
                    </div>
                </div>
                <hr>
                <b>Client Detail</b>
                <div class="row" id="clientdetail">
                     <div class="col-md-2 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select  name="salutation_name[0]" class="form-control mt-0">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Dr.">Dr.</option>
                                </select>
                            </div>
                     </div>
                      <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text"  class="form-control mt-0 first"  id="client_first_name" name="client_first_name[0]" placeholder="First Name" value="">
                            </div>
                      </div>
                     <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text"  class="form-control mt-0 last"  name="client_last_name[0]" placeholder="Last Name" value="" >
                            </div>
                     </div>
                     <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text"  class="form-control mt-0 designation"  name="client_designation[0]" placeholder="" value="" >
                            </div>
                     </div>
                     <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>linkedin URL</label>
                                <input type="text"  class="form-control mt-0"  name="linkedin_url[0]" placeholder="" value="" >
                            </div>
                     </div>

                 
                    <div class="col-md-6 pr-1">
                        <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                          
                                <div class="input-group my-group mb-1">
                                    <input type="email" class="form-control mt-0 emailid emptyemail0" id="emails" name="email[0][]" value="">
                                    <select id="email_type[]" name="email_type[0][]"   value="" class="">
                                        <option value="Work">Work</option>
                                        <option value="Home">Home</option>
                                    </select> 
                                    
                                </div>
                            </div> 
                            <!-- <div class="error" id="emailErr"></div>  -->
                            <a href="javascript:void(0)" class="btn2 addemail"> Add Mail </a>
                            <input type="hidden" value="0">
                    </div>
                    <div class="col-md-6 pl-1">
                       
                        <div id="phonetextbox" class="form-group">
                            <label>Phone No</label>
                
                                <div class="input-group my-group mb-1">
                                    <input type="text" class="form-control mt-0 phno emptyphone0" id="client_phones" name="client_phone[0][]" value="">
                                    <select id="phone_type[]" name="phone_type[0][]" class="" value="" pattern="[1-9]{1}[0-9]{9}">
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                   
                                </div>
                        </div>
                      <!--   <div class="error" id="mobileErr"></div> -->
                        <a href="javascript:void(0)"  class="btn2 addphone"> Add Phone </a>
                        <input type="hidden" value="0">
                    </div>
                </div>
                <hr>
                <label id="addclient" class="btncreate mt-0 text-white"> Add Client </label>
                <hr>
                   <b>Address</b>                                                            
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label>House No</label>
                            <input type="text" class="form-control mt-0"  name="house_no" value="">
                        </div>
                    </div>
                    <div class="col-md-5 px-1">
                        <div class="form-group">
                            <label>Street Name</label>
                            <input type="text" class="form-control mt-0" name="street_name" value="">
                        </div>
                    </div>
                    <div class="col-md-5 pl-1">
                        <div class="form-group">
                            <label>Address Line2</label>
                            <input type="text" class="form-control mt-0" name="address_line_2" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control mt-0 scountry" name="Country">  
                                 <option value="">Select country</option>
                                 <option value="US">US</option>
                                 <option value="UK">UK</option> 
                                 <option value="CANADA">CANADA</option>
                                 <option value="AUSTRALIA">AUSTRALIA</option> 
                                 <option value="NEW ZEALAND">NEW ZEALAND</option>
                                 <option value="Other">Other</option>                  
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>State</label>
                           <select class="form-control mt-0 sstate" id="State" name="State">
                           </select>
                           <input name="other_state" class="editstate" style="display:none;" placeholder="Text " value="">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                          <label>City/County</label>
                           <select class="form-control mt-0 scounty" id="County" name="County">
                           </select>
                           <input name="other_county" class="editcounty" style="display:none;" placeholder="Text " value="">
                        </div>
                    </div>
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control mt-0" name="zip_code" value="">
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <div class="form-group">
                            <label>Time Zone</label>
                             <select class="form-control mt-0" id="time_zone" name="time_zone">         
                                <option value="Other">Other</option>             
                            </select>
                             <input name="other_timezone" class="edittimezone col-md-12" style="display:none;" placeholder="Text " value="">
                        </div>

                    </div>
                </div>
            
                <hr>
                   <b> Details</b>
                    <div class="row">
                     <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label>Lead Status</label>
                            <select class="form-control mt-0" name="status">
                                <option value="New">New</option>
                                <option value="Assigned">Assigned</option>
                                <option value="In Process">In Process</option>
                                <option value="Converted">Converted</option>
                                <option value="Recycled">Recycled</option>
                                <option value="Dead">Dead</option>
                            </select>
                        </div>
                     </div>

                     <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Lead Source</label>
                            <select class="form-control mt-0" name="lead_source" value="">
                            <option value="">Select Source</option>
                            <option value="Call">Call</option>
                            <option value="Email">Email</option>
                            <option value="Existing Customer">Existing Customer</option>
                            <option value="Partner">Partner</option>
                            <option value="Public Relations">Public Relations</option>
                            <option value="Web Site">Web Site</option>
                            <option value="Campaign">Campaign</option>
                            <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                            <label>Company Type</label>
                            <select class="form-control mt-0" name="vendor_type">
                                 <option value="">Select Type</option>
                                 <option value="Fixed">Fixed</option>
                                 <option value="Retail">Retail</option>                    
                            </select>

                             </div>
                        </div>
                        
                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Business Type</label>
                            <input type="text" class="form-control mt-0"  name="type_business" value="">
                        </div>
                    </div>

                    <div class="col-md-2 px-1">
                        <div class="form-group">
                            <label>Opportunity Amount </label>
                            <input type="text" class="form-control mt-0" name="opportunity_amount" value="">
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <div class="form-group">
                         <label>Followup Date </label>
                         <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" autocomplete="off">
                        </div>
                    </div>   
                                               
                   
                    </div>
                    <div class="row">
                         
                    
                  
                    </div>
              
            </div>
     </div>
     </div>
                  
</div>
</form>                           
                        
<div class="modal fade" id="AssignuserModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>

            </div>

            <div class="modal-body">
                <button class="btncancle">Cancel</button>
                 
                 <div class="input-group input-group-unstyled col-md-8">
                    <input type="text" class="form-control pr-1" name="" value="">
                    <label id="assignuser" class=""><i class="fa fa-search"></i></label>
                    <label id="assignuser" class=""><i class="fa fa-refresh"></i></label>
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
<!-- custom popup modal -->
 <div class="modal" id="custompopupmodalid">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Custom Information</h5>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <label>Custom Detail</label>
         <input type="text" name="customdiscription" value="" id="customdiscriptionid" class="form-control">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="customsubmitid">Submit</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>