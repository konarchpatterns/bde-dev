<form action="{{route('lead.convertinto')}}" method="post">
@csrf 
<input type="hidden" name="id" value="{{$leaddatas->id}}">
<table> 
<tr> 
<td> 
<div class="form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="account" value="account" id="myaccount">
    <span class="form-check-sign"></span>
    </label>
</div></td><td>Account</td>
</tr>
<tr>
    <td>
    </td>
    <td>
    <div class="row" id="accountdiv" style="display:none">

        <div class="col-md-8">
            <div class="card ">
                <div class="card-header ">
                    <b>Overview</b>
                </div>
            <div class="card-body ">
                <div class="row ">
                     <div class="col-md-3 pr-1">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control mt-0" name="company_name" value="{{$leaddatas->company_name}}" readonly="" >
                        </div>
                    </div>
                    <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" class="form-control mt-0" name="website_address" value="{{$leaddatas->website_address}}" readonly="">
                        </div>
                    </div>
                
                     <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>Company Phone No</label>
                            <input type="text" class="form-control mt-0" name="company_phone_number" value="{{$company_number->company_phone_number}}" pattern="[1-9]{1}[0-9]{9}" readonly="">
                           
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <div class="form-group">
                            <label>Fax No</label>
                            <input type="text" class="form-control mt-0" name="fax_no" value="{{$company_address_data->fax_no}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                            @foreach($emailarray as $emails)
                                <div class="input-group input-group-unstyled">
                                    <input type="email" class="form-control mt-0 emailid" id="email[]" name="email[]" value="{{$emails->email}}" readonly="">
                                    
                                    <select name="email_type[]"  id="email_type[]" value="{{$emails->email_type}}" class="btn1">
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                        
                                    </select> 
                                   
                                </div>
                            @endforeach

                        </div>
                     
                    </div>
                    <div class="col-md-6 pl-1">
                        <div id="phonetextbox" class="form-group">
                            <label>Client Phone</label>
                            @foreach($phonearray as $phones)
                                <div class="input-group input-group-unstyled">
                                    <input type="text" class="form-control mt-0 phno" id="client_phone[]" name="client_phone[]" value="{{$phones->mobile_number}}" readonly="" >
                                    <select id="phone_type[]" name="phone_type[]" class="btn1" value="{{$phones->phone_type}}" pattern="[1-9]{1}[0-9]{9}" required="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        
                                    </select>
                                   
                                </div>
                            @endforeach
                            
                        </div>
                      
                    </div>
                </div>
                <hr>
                   <b>Address</b>                                                            
                <div class="row">
                    <div class="col-md-2 pr-1">
                        <div class="form-group">
                            <label>House No</label>
                            <input type="text" class="form-control mt-0"  name="house_no" value="{{$company_address_data->house_no}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-5 px-1">
                        <div class="form-group">
                            <label>Street Name</label>
                            <input type="text" class="form-control mt-0" name="street_name" value="{{$company_address_data->street_name}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-5 pl-1">
                        <div class="form-group">
                            <label>Address Line2</label>
                            <input type="text" class="form-control mt-0" name="address_line_2" value="{{$company_address_data->address_line_2}}" readonly="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-1">
                        <div class="form-group">
                          <label>County</label>
                          <input type="text" class="form-control mt-0"  name="County" value="{{$company_address_data->County}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" class="form-control mt-0" name="zip_code" value="{{$company_address_data->zip_code}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-3 px-1">
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control mt-0" name="Country" value="{{$company_address_data->Country}}" readonly="">
                        </div>
                    </div>
                    <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <label>Time Zone</label>
                            <input type="text" class="form-control mt-0"  name="time_zone" value="{{$company_address_data->time_zone}}" readonly="">
                        </div>
                    </div>
                </div>
            
                <hr>
                   <b> Details</b>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                            <label>Vendor Type</label>
                            <select class="form-control mt-0" name="vendor_type" value="" readonly="">
                                <option selected="selected" vlaue="$leaddatas->vendor_type">{{$leaddatas->vendor_type}}</option>
                                          
                            </select>

                             </div>
                        </div>
                        
                        <div class="col-md-4 px-1">
                        <div class="form-group">
                            <label>Business Type</label>
                            <input type="text" class="form-control mt-0"  name="type_business" value="{{$company_address_data->type_business}}" readonly="">
                        </div>
                    </div>
                        
                                               
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Industry </label>
                                
                        <select class="form-control mt-0" name="industry" readonly="">
                        <option value="{{$leaddatas->industry}}">{{$leaddatas->industry}}</option>
                        
                        </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="lead_description" class="form-control mt-0" readonly="">{{$leaddatas->lead_description}}</textarea>
                            </div>
                    </div>
                    <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea name="comment" class="form-control mt-0" rows="3" readonly=""></textarea>
                            </div>
                        </div>
                    </div>
              
            </div>
     </div>
     </div>
            <div class="col-md-4">
                            <div class="card ">
                                    <div class="card-header ">
                                        <h5 class="card-title"><b>Assign User</b></h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-12 pr-1">
                                                    <div class="form-group">
                                                        <label>Assigned User</label>
                                                     <div class="input-group input-group-unstyled">
                                                       <input type="text" class="form-control mt-1" placeholder="" value="{{$user_name}}" id="user_name" readonly="">
                                                       <input type="hidden" name="user_id" value="{{$user_id}}" id="user_id" readonly="">
                                                        <label id="assignuser" class="btn1"><i class="fa fa-angle-up"></i></label>
                                                        <label id="cancelassignuser" class="btn1"><i class="fa fa-times"></i></label>
                                                     </div>
                                                    </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
            </div>        
</div>
</td>
</tr>
<tr> 
<td>
<div class="form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="contact" value="contact" id="mycontact">
    <span class="form-check-sign"></span>
    </label>
</div></td><td>Contact</td>
</tr>
<tr>
    <td>
    </td>
    <td>
    <div class="row  mt-2">
    <div class="row" id="contactdiv" style="display:none">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header ">
                    <h5 class="card-title"><b>Overview</b></h5>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-2 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select name="salutation_name" class="form-control mt-0"  readonly="">
                                    <option value="{{$leaddatas->salutation_name}}">{{$leaddatas->salutation_name}}</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text" id="client_first_name" class="form-control mt-1"  name="client_first_name" placeholder="First Name" value="{{$leaddatas->client_first_name}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text" id="client_last_name" class="form-control mt-1"  name="client_last_name" placeholder="Last Name" value="{{$leaddatas->client_last_name}}" readonly="" >
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <label>Designation</label>
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="client_designation" value="{{$leaddatas->client_designation}}" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row ">   
                        <div class="col-md-6 pr-1">
                        <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                            @foreach($emailarray as $emails)
                                <div class="input-group input-group-unstyled">
                                    <input type="email" class="form-control mt-0 emailid" id="email[]" name="email[]" value="{{$emails->email}}" readonly="">
                                    
                                    <select name="email_type[]"  id="email_type[]" value="{{$emails->email_type}}" class="btn1">
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                      
                                    </select> 
                                   
                                </div>
                            @endforeach
                           
                        </div>
                         
                    </div>
                        <div class="col-md-6 pl-1">
                        <div id="phonetextbox" class="form-group">
                            <label>Client Phone</label>
                            @foreach($phonearray as $phones)
                                <div class="input-group input-group-unstyled">
                                    <input type="text" class="form-control mt-0 phno" id="client_phone[]" name="client_phone[]" value="{{$phones->mobile_number}}" readonly="" >
                                    <select id="phone_type[]" name="phone_type[]" class="btn1" value="{{$phones->phone_type}}" pattern="[1-9]{1}[0-9]{9}" readonly="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>    
                                    </select>
                                   
                                </div>
                            @endforeach
                       
                        </div>
                       
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control mt-0" name="company_name" value="{{$leaddatas->company_name}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Business Type</label>
                                <input type="text" class="form-control mt-0"  name="type_business" value="{{$company_address_data->type_business}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label>Fax No</label>
                                <input type="text" class="form-control mt-0" name="fax_no" value="{{$company_address_data->fax_no}}" readonly="">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <label>House No</label>
                                <input type="text" class="form-control mt-0"  name="house_no" value="{{$company_address_data->house_no}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-5 px-1">
                            <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" class="form-control mt-0" name="street_name" value="{{$company_address_data->street_name}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-5 pl-1">
                            <div class="form-group">
                                <label>Address Line2</label>
                                <input type="text" class="form-control mt-0" name="address_line_2" value="{{$company_address_data->address_line_2}}" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label>County</label>
                                    <input type="text" class="form-control mt-0"  name="County" value="{{$company_address_data->County}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control mt-0" name="zip_code" value="{{$company_address_data->zip_code}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control mt-0" name="Country" value="{{$company_address_data->Country}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <label>Time Zone</label>
                                <input type="text" class="form-control mt-0"  name="time_zone" value="{{$company_address_data->time_zone}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                            <textarea class="form-control mt-0" name="lead_description" rows="4" readonly="">{{$leaddatas->lead_description}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
                            <div class="card ">
                                    <div class="card-header ">
                                        <h5 class="card-title"><b>Assign User</b></h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-12 pr-1">
                                                    <div class="form-group">
                                                        <label>Assigned User</label>
                                                     <div class="input-group input-group-unstyled">
                                                       <input type="text" class="form-control mt-1" placeholder="" value="{{$user_name}}" id="user_name" readonly="">
                                                       <input type="hidden" name="user_id" value="{{$user_id}}" id="user_id" readonly="">
                                                        <label id="assignuser" class="btn1"><i class="fa fa-angle-up"></i></label>
                                                        <label id="cancelassignuser" class="btn1"><i class="fa fa-times"></i></label>
                                                     </div>
                                                    </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
            </div>  
     
    </div>
</div>
    </td>
</tr>    
<tr> 
<td>
<div class="form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="opportunity" value="Opportunity">
    <span class="form-check-sign"></span>
    </label>
</div></td><td>Opportunity</td>
</tr>
</table>
<br>
<button class="">Convert</button>
<a href="#" class="">Cancel</a>
</form>





