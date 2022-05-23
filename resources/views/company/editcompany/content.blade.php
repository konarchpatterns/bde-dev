<form action="{{route('company.update')}}" method="post">
 @csrf
<input type="hidden" name="id" value="{{$companydata->id}}">
        <div class="">
        <div class="row">
            <div class="col-md-9">
                <h5><a href="{{route('company.index')}}"><b>Account</b></a> <i class="fa fa-angle-double-right"></i>{{$companydata->company_name}}</h5>       
            </div>
            <div class="col-md-3">
                <a href="{{route('company.show',['id'=>$companydata->id,'backto'=>$backto])}}" class="btn btn-info btn-outline rightdiv">Back</a>
                <input type="hidden" name="backto" value="{{$backto}}">
                <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
            </div>
        </div>

        <div class="row  mt-2">
            <div class="col-md-12">
                <div class="card ">    
                <div class="card-body ">
                     <b>Company Detail</b>
                    <div class="row ">
                         <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <label>Company Name</label>
                            @permission('view.company.name')    
                            @permission('edit.company.name')
                                <input type="text" class="form-control mt-0 companyname" name="company_name" value="{{$companydata->company_name}}" required="">
                            @else
                                 <input type="text" class="form-control mt-0" name="company_name" value=" {{$companydata->company_name}}" required="" readonly="">
                            @endpermission   
                            @else
                               <input type="" name="" value="XXXXX" class="form-control mt-0" readonly="">
                            @endpermission   
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Website</label>
                            @permission('view.company.website')    
                            @permission('edit.company.website')
                                <input type="text" class="form-control mt-0" name="website_address" value="{{$companydata->website_address}}">
                            @else
                                 <input type="text" class="form-control mt-0" name="website_address" value="{{$companydata->website_address}}" readonly="">
                            @endpermission   
                            @else
                                 <input type="" name="" value="XXXXX" class="form-control mt-0" readonly=""> 
                            @endpermission 
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Fax No</label>
                            @permission('view.company.fax')
                            @permission('edit.company.fax')
                                <input type="text" class="form-control mt-0" name="fax_no" value="{{$companyaddress->fax_no}}">
                            @else
                                 <input type="text" class="form-control mt-0" name="fax_no" value="{{$companyaddress->fax_no}}" readonly="">
                            @endpermission
                            @else
                                 <input type="" name="" value="XXXXX" class="form-control mt-0" readonly=""> 
                            @endpermission
                            </div>
                        </div>
                  
                        <div class="col-md-3 px-1">
                        <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                            @permission('view.company.email')
                            @forelse($companyemails as $emails)
                             @permission('edit.company.email')
                                    @if ($loop->first)

                                    <div class="input-group input-group-unstyled">
                                    <input type="hidden" name="rootvalue" value="{{$emails->company_email}}">
                                    <input  type="email" class="form-control mt-0  coemail" name="companyemail[]" value="{{$emails->company_email}}">
                                       <input type="hidden" name="useeid" value="{{$emails->id}}">
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0">
                                 
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select> 
                                  
                                    </div>
                                     <input type="hidden" name="useeid" value="{{$emails->id}}">
                                    @else
                                    <div class="input-group input-group-unstyled">
                                     <input type="hidden" name="rootvalue" value="{{$emails->company_email}}">
                                    <input type="email" class="form-control mt-0 coemail" name="companyemail[]" value="{{$emails->company_email}}">
                                    <input type="hidden" name="useeid" value="{{$emails->id}}">
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0 btn1">
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                       
                                    </select> 
                                    <input type="hidden" name="useeid" value="{{$emails->id}}">
                                @permission('delete.company.email')   
                                    <a href="javascript:void(0);" class="remove_emailfield btn1 mt-0" name="companyemail[]" onclick="Deletcompanyeemail('{{route('company.emaildelete',[$emails->id])}}',this,'{{$emails->company_email}}')">X</a>
                                @endpermission 
                                    <!-- <label class="remove_emailfield btn1"> X </label> -->  
                                    </div> 
                                    @endif
                                 @else
                                    <div class="input-group input-group-unstyled">
                                   
                                    <input  type="email" class="form-control mt-0" name="companyemail[]" value="{{$emails->company_email}}" readonly="">
                                      
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0 btn1">
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                    </select> 
                                  
                                    </div>
                                 @endpermission
                                @empty
                                     <div class="input-group input-group-unstyled">
                                    <input  type="email" class="form-control mt-0  coemail" name="companyemail[]" value=""><select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0 btn1">
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select> 
                                    </div>
                            @endforelse 
                            @else
                                <input type="" name="" class="form-control mt-0" value="XXXXX" readonly="">
                            @endpermission

                        </div>
                        @permission('edit.company.email')
                         <a href="javascript:void(0);" id="addcompanymail" class="btn btn-sm btn-warning btn-outline"> + </a>
                        @endpermission

                        </div>

                        <div class="col-md-3 pl-1">
                        <div id="phonetextbox" class="form-group">
                            <label>Phone</label>
                            @permission('view.company.phone')
                            @forelse($companyphones as $phones)
                              @permission('edit.company.phone')
                                    @if ($loop->first)
                                    <div class="input-group input-group-unstyled">
                                    <input type="hidden" name="rootvalue" value="{{$phones->company_phone}}">
                                    <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="{{$phones->company_phone}}" pattern="[1-9]{1}[0-9]{9}">
                                     <input type="hidden" name="useeid" value="{{$phones->id}}">
                                    <select id="company_phone_type[]" name="company_phone_type[]" class=" mt-0 btn1" value="">
                                        
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        
                                    </select>
                                    </div> 
                                   
                                    @else
                                    <div class="input-group input-group-unstyled">
                                    <input type="hidden" name="rootvalue" value="{{$phones->company_phone}}">
                                    <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="{{$phones->company_phone}}">
                                    <input type="hidden" name="useeid" value="{{$phones->id}}">
                                    <select id="company_phone_type[]" name="company_phone_type[]" class="mt-0 btn1" value="" pattern="[1-9]{1}[0-9]{9}">
                                         <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                 @permission('delete.company.phone')    
                                    <a href="javascript:void(0);" class="remove_phonefield btn1 mt-0" onclick="Deletecompanyphoneno('{{route('company.phonedelete',[$phones->id])}}',this,'{{$phones->company_phone}}')">X</a>
                                 @endpermission
                    <!-- <label class="remove_emailfield btn1"> X </label> -->  
                                    </div> 
                                    @endif  
                                 @else
                                    <div class="input-group input-group-unstyled">
                                    
                                    <input type="text" class="form-control mt-0" name="companyclient_phone[]" value="{{$phones->company_phone}}" pattern="[1-9]{1}[0-9]{9}" readonly="">
                                     
                                    <select id="company_phone_type[]" name="company_phone_type[]" class=" mt-0 btn1" value="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                    </select>
                                    </div>
                                 @endpermission  
                                @empty
                                    <div class="input-group input-group-unstyled">
                                    <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value=""pattern="[1-9]{1}[0-9]{9}"><select id="company_phone_type[]" name="company_phone_type[]" class=" mt-0 btn1" value="">
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                    </div> 
                            @endforelse
                            @else
                               <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            @endpermission
                        </div>  
                        @permission('edit.company.phone')
                         <a href="javascript:void(0);" id="addcompanyphone" class="btn btn-sm btn-warning btn-outline"> + </a>
                        @endpermission 
                        </div>         
                    </div>
                    
                    <hr>
                @permission('view.company.address')    
                       <b>Address</b>   

                @permission('edit.company.address')           
                    <div class="row">
                        <div class="col-md-1 pr-1">
                            <div class="form-group">
                                <label>Ho/No</label>
                                <input type="text" class="form-control mt-0"  name="house_no" value="{{$companyaddress->house_no}}">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" class="form-control mt-0" name="street_name" value="{{$companyaddress->street_name}}">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Address Line2</label>
                                <input type="text" class="form-control mt-0" name="address_line_2" value="{{$companyaddress->address_line_2}}">
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <label>Country</label>
                            <select class="form-control mt-0 scountry" name="Country"> 
                                 <option vlaue="{{$companyaddress->Country}}">{{$companyaddress->Country}}</option> 
                                 <option vlaue="US">US</option>
                                 <option vlaue="UK">UK</option> 
                                 <option vlaue="CANADA">CANADA</option>
                                 <option vlaue="AUSTRALIA">AUSTRALIA</option> 
                                 <option vlaue="NEW ZEALAND">NEW ZEALAND</option>
                                 <option vlaue="Other">Other</option>                  
                            </select>
                        </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>State</label>
                           <select class="form-control mt-0 sstate" id="State" name="State">
                            <option value="{{$companyaddress->state}}">{{$companyaddress->state}}</option>
                           </select>
                           <input name="other_state" class="editstate" style="display:none;" placeholder="Text " value="">
                        </div>
                        </div> 
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                              <label>City/County</label>
                              <select class="form-control mt-0 scounty" id="County" name="County">
                                <option value="{{$companyaddress->County}}">{{$companyaddress->County}}</option>
                              </select>
                              <input name="other_county" class="editcounty" style="display:none;" placeholder="Text " value="">
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control mt-0"  name="zip_code" value="{{$companyaddress->zip_code}}">
                            </div>
                        </div>
                        <div class="col-md-2 pl-1">
                            <div class="form-group">
                                <label>Time Zone</label>
                                <select class="form-control mt-0" id="time_zone" name="time_zone">  
                                 <option vlaue="{{$companyaddress->time_zone}}">{{$companyaddress->time_zone}}</option>                  
                            </select>
                             <input name="other_timezone" class="edittimezone col-md-12" style="display:none;" placeholder="Text " value="">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-1 pr-1">
                            <div class="form-group">
                                <label>Ho/No</label>
                                <input type="text" class="form-control mt-0"  name="house_no" value="{{$companyaddress->house_no}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Street Name</label>
                                <input type="text" class="form-control mt-0" name="street_name" value="{{$companyaddress->street_name}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Address Line2</label>
                                <input type="text" class="form-control mt-0" name="address_line_2" value="{{$companyaddress->address_line_2}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <label>Country</label>
                             <input type="text" name="Country" class="form-control mt-0" value="{{$companyaddress->Country}}" readonly="">
                        </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>State</label>
                          <input type="text" name="State" class="form-control mt-0" value="{{$companyaddress->state}}" readonly="">
                           
                        </div>
                        </div> 
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                              <label>City/County</label>
                              <input type="text" name="County" class="form-control mt-0" value="{{$companyaddress->County}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input type="text" class="form-control mt-0"  name="zip_code" value="{{$companyaddress->zip_code}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2 pl-1">
                            <div class="form-group">
                                <label>Time Zone</label>
                                <input type="text" name="time_zone" class="form-control mt-0" value="{{$companyaddress->time_zone}}" readonly="">
                            </div>
                        </div>
                    </div>
                @endpermission
                @else
                          <div class="row">
                        <div class="col-md-1 pr-1">
                            <div class="form-group">
                                <label>Ho/No</label>
                                <input type="" name="" value="XX" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Street Name</label>
                               <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Address Line2</label>
                                <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            </div>
                        </div>
                    @permission('view.company.country') 
                        <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <label>Country</label>
                             <input type="text" name="Country" class="form-control mt-0" value="{{$companyaddress->Country}}" readonly="">
                        </div>
                        </div> 
                    @else
                        <div class="col-md-3 pl-1">
                        <div class="form-group">
                            <label>Country</label>
                            <input type="" name="" value="XXXXX" class="form-control" readonly="">
                        </div>
                        </div> 
                    @endpermission
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <label>State</label>
                          <input type="" name="" class="form-control mt-0" value="XXXXX" readonly="">   
                        </div>
                        </div> 
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                              <label>City/County</label>
                              <input type="" name="" class="form-control mt-0" value="XXXXX" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Zip Code</label>
                                 <input type="" name="" class="form-control mt-0" value="XXXXX" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2 pl-1">
                            <div class="form-group">
                                <label>Time Zone</label>
                                 <input type="" name="" class="form-control mt-0" value="XXXXX" readonly="">
                            </div>
                        </div>
                    </div>
                @endpermission 
                    <hr>
                       <b> Details</b>
                        <div class="row">
                            <div class="col-md-2 pr-1">
                                <div class="form-group">
                                <label>Vendor Type</label>
                                @permission('view.company.vendor.type') 
                                @permission('edit.company.vendor.type') 
                                <select class="form-control mt-0" name="vendor_type">
                                                <option vlaue="$companydata->vendor_type">{{$companydata->vendor_type}}</option>
                                                <option vlaue="Fixed">Fixed</option>
                                                <option vlaue="Retail">Retail</option>
                                </select>
                                @else
                                 <input type="text" name="vendor_type" class="form-control mt-0" value="{{$companydata->vendor_type}}" readonly="">
                                @endpermission
                                @else
                                   <input type="" name="" value="XXXXX" class="form-control" readonly="">
                                @endpermission
                                 </div>
                            </div>
                            
                            <div class="col-md-4 px-1">
                            <div class="form-group">
                        
                                <label>Business Type</label>
                             @permission('view.company.bussiness.type')  
                             @permission('edit.company.bussiness.type') 
                                <input type="text" class="form-control mt-0"   name="type_business" value="{{$companydata->type_business}}">
                             @else
                                 <input type="text" class="form-control mt-0"  name="type_business" value="{{$companydata->type_business}}" readonly="">
                             @endpermission
                             @else
                               <input type="" name="" class="form-control mt-0" value="XXXXX" readonly=""> 
                             @endpermission
                            </div>
                        </div>
                        
                   
                        <div class="col-md-6 pl-1">
                            <div class="form-group">
                                <label>Description</label>
                             @permission('view.company.description')
                             @permission('edit.company.description') 
                                <textarea name="lead_description"  class= "form-control form-control2 description">{{$companydata->lead_description}}</textarea>
                             @else
                                 <textarea name="lead_description"  class= "form-control form-control2" readonly="">{{$companydata->lead_description}}</textarea>
                             @endpermission
                             @else
                                <input type="" name="" class="form-control" readonly="" value="XXXXX">
                             @endpermission
                            </div>
                    </div>
                </div>
                       
                  
              
         </div>
         </div>
                               

    </div>
</div>
</form> 
    
    <div class="modal fade right" id="AssignuserModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                 <label id="closeuser" class="btncancle">Cancel</label>
            </div>

            <div class="modal-body">
               
                </br>
                    <table id="userrecord" class="table table-striped table-bordered "  style="width:100%">
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