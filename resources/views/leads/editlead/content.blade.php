<form action="{{route('lead.update')}}" method="post">
    @csrf   
    <input type="hidden" name="id" value="{{$leaddata->id}}">
    <input type="hidden" name="backto" value="{{$backto}}">
     <div class="">
        <div class="row">

            <div class="col-md-9">
                <h5><a href="{{route('lead.index')}}"><b>Leads</b></a> <i class="fa fa-angle-double-right"></i>{{$companydata->company_name}}</h5>       
            </div>
            <div class="col-md-3">
             <a href="{{route('lead.show',['id'=>$leaddata->id,'backto'=>$backto])}}" class=" btn btn-info btn-outline rightdiv">Back</a>
             <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
 
            

            
            </div>
        </div>

        <div class="row  mt-2">
            <div class="col-md-12">
                <div class="card ">
                    
                    
                    
                <div class="card-body ">
                     <b style="color: white">Company Detail</b>
                    <div class="row ">
                         <div class="col-md-2 pr-1">
                            <div class="form-group">
                                <label>Company Name</label>
                            @permission('view.lead.name')
                            @permission('edit.lead.name')
                                <input type="text" class="form-control mt-0 companyname" name="company_name" value="{{$companydata->company_name}}">
                            @else
                                <input type="text" class="form-control mt-0" name="company_name" value="{{$companydata->company_name}}" required="" readonly="">
                            @endpermission  
                            @else
                               <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            @endpermission
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                              
                              <label>Website</label>
                            @permission('view.lead.website')
                            @permission('edit.lead.website')
                                <input type="text" class="form-control mt-0" name="website_address" value="{{$companydata->website_address}}">
                            @else
                                <input type="text" class="form-control mt-0" name="website_address" value="{{$companydata->website_address}}" readonly="">
                            @endpermission 
                            @else
                                <input type="" name="" value="XXXXX" class="form-control" readonly="" >
                            @endpermission 
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Fax No</label>
                            @permission('view.lead.fax')
                            @permission('edit.lead.fax')
                                <input type="text" class="form-control mt-0" name="fax_no" value="{{$companyaddress->fax_no}}">
                            @else
                                <input type="text" class="form-control mt-0" name="fax_no" value="{{$companyaddress->fax_no}}" readonly="">
                            @endpermission 
                            @else
                              <input type="" name="" value="XXXXX"  readonly="" class="form-control">
                            @endpermission
                            </div>
                        </div>
                  
                        <div class="col-md-3 px-1">
                        <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                            @permission('view.lead.email')  
                            @forelse($companyemails as $emails)
                             @permission('edit.lead.email')  
                                @if ($loop->first)
                                <div class="input-group my-group">
                                    <input type="hidden" name="rootvalue" value="{{$emails->company_email}}">
                                    <input type="email" class="form-control mt-0 coemail" name="companyemail[]" value="{{$emails->company_email}}">
                                     <input type="hidden" name="useeid" value="{{$emails->id}}">
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0">
                                         <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div> 
                                @else
                                    <div class="input-group input-group-unstyled">
                                    <input type="hidden" name="rootvalue" value="{{$emails->company_email}}">
                                    <input type="email" class="form-control mt-1  coemail" name="companyemail[]" value="{{$emails->company_email}}">
                                     <input type="hidden" name="useeid" value="{{$emails->id}}">
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-1 btn1">
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @permission('delete.lead.email')
                                    <a href="javascript:void(0);" class="remove_emailfield btn1 mt-1" onclick="Deletcompanyeemail('{{route('company.emaildelete',[$emails->id])}}',this,'{{$emails->company_email}}')">X</a>
                                    @endpermission
                                    <!-- <label class="remove_emailfield btn1"> X </label> -->  
                                    </div> 
                                    @endif
                             @else
                                <div class="input-group my-group">
                                  
                                    <input type="email" class="form-control mt-1" name="companyemail[]" value="{{$emails->company_email}}" readonly="">
                                   
                                    <select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-1">
                                         <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                    </select>
                                </div> 
                             @endpermission 
                            @empty
                                    <div class="input-group my-group">
                                    <input type="email" class="form-control mt-0 coemail" name="companyemail[]" value=""><select id="company_email_type[]" name="company_email_type[]"   value="" class="mt-0">
                                        <option value="Work">Work</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div> 
                            @endforelse 
                            @else
                                <input type="" name="" class="form-control" value="XXXXX" readonly="">
                            @endpermission  
                        </div>
                        @permission('edit.lead.email') 
                         <a href="javascript:void(0);" id="addcompanymail" class="btn btn-sm btn-warning"> + </a>
                        @endpermission    
                        </div>

                        <div class="col-md-3 pl-1">
                        <div id="phonetextbox" class="form-group">
                            <label>Phone</label>
                            @permission('view.lead.phone')
                            @forelse($companyphones as $phones)
                              @permission('edit.lead.phone')
                                @if ($loop->first)
                                <div class="input-group my-group">
                                    <input type="hidden" name="rootvalue" value="{{$phones->company_phone}}">
                                    <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="{{$phones->company_phone}}" pattern="[1-9]{1}[0-9]{9}">
                                    <input type="hidden" name="useeid" value="{{$phones->id}}">
                                     <select id="company_phone_type[]" name="company_phone_type[]" class="mt-0" value="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                 
                                </div>
                                @else
                                <div class="input-group input-group-unstyled">
                                     <input type="hidden" name="rootvalue" value="{{$phones->company_phone}}">
                                    <input type="text" class="form-control mt-1  cophone" name="companyclient_phone[]" value="{{$phones->company_phone}}" pattern="[1-9]{1}[0-9]{9}">
                                    <input type="hidden" name="useeid" value="{{$phones->id}}">
                                    <select id="company_phone_type[]" name="company_phone_type[]" class="mt-1 btn1" value="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                    @permission('delete.lead.phone')
                                    <a href="javascript:void(0);" class="remove_phonefield btn1 mt-1" onclick="Deletecompanyphoneno('{{route('company.phonedelete',[$phones->id])}}',this,'{{$phones->company_phone}}')">X</a>
                                    @endpermission
                                    <!-- <label class="remove_emailfield btn1"> X </label> -->  
                                </div> 
                                @endif 
                            @else
                                <div class="input-group my-group">
                                    
                                    <input type="text" class="form-control mt-1" name="companyclient_phone[]" value="{{$phones->company_phone}}" pattern="[1-9]{1}[0-9]{9}" readonly="">
                                    
                                     <select id="company_phone_type[]" name="company_phone_type[]" class="mt-1" value="">
                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                       
                                    </select>
                                 
                                </div>
                            @endpermission   
                            @empty
                                <div class="input-group my-group">
                                 <input type="text" class="form-control mt-0 cophone" name="companyclient_phone[]" value="" pattern="[1-9]{1}[0-9]{9}">

                                     <select id="company_phone_type[]" name="company_phone_type[]" class="mt-0" value="">
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                    </select>
                                </div>
                            @endforelse
                            @else
                              <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            @endpermission
                        </div> 
                        @permission('edit.lead.phone') 
                         <a href="javascript:void(0);" id="addcompanyphone" class="btn btn-sm btn-warning"> + </a>
                        @endpermission
                        </div>
                    <div class="col-md-3 pr-1">
                        <label>Department</label>
                         <br>
                        @php 
                          $graphicsvalue=0;
                          $datavalue=0;
                          $Operationsvalue=0;
                          $Customvalue=0;

                        @endphp

                        <select  name="leaddepatment[]" class="form-control mt-0" id="departmentid"  multiple>
                            
                          @foreach(explode(',',$leaddata->leaddepatment) as $departmentleadis)
                               @if($departmentleadis == 'Graphics')
                                {{$graphicsvalue++}}
                               @elseif($departmentleadis == 'Data')
                                {{$datavalue++}}
                               @elseif($departmentleadis == 'Operations')
                                {{$Operationsvalue++}}
                               @elseif($departmentleadis == 'Custom')
                                  {{$Customvalue++}}
                               @else
                               @endif
                          @endforeach
                              @if($graphicsvalue != 0)
                                <option value="Graphics" selected>Graphics</option>
                              @else
                                <option value="Graphics">Graphics</option>
                              @endif
                              @if($datavalue != 0)
                                 <option value="Data" selected>Data</option>
                              @else
                                <option value="Data">Data</option>
                              @endif
                              @if($Operationsvalue != 0)
                                 <option value="Operations" selected="">Operations</option>
                              @else
                                <option value="Operations">Operations</option>
                              @endif
                              @if($Customvalue != 0)
                                  <option value="Custom" selected="">Custom</option>
                                  <input type="hidden" name="custompopvalue" id="custompopvalueid" value="1">
                              @else
                                 <option value="Custom">Custom</option>
                                 <input type="hidden" name="custompopvalue" id="custompopvalueid" value="">
                              @endif     
                        
                        </select>
              
                       

                    </div>
                    @if($leaddata->customdetail != "")
                    <div class="col-md-3 pr-1">
                         <label>Custom Detail</label>
                          
                          <textarea name="customdetail"  class= "form-control form-control2" id="customdetailins">{{$leaddata->customdetail}}</textarea>
                    </div>
                    @else
                      <input type="hidden" name="customdetail" value="{{$leaddata->customdetail}}" id="customdetailins" class="form-control">
                    @endif
                        <div class="col-md-3 pr-1">
                         <label>Assign To</label>
                          <input type="text" name="assidn" value="{{$username->name}}" class="form-control" disabled="">
                        </div> 
                    <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <label>Description</label>
                            @permission('view.lead.description')
                            @permission('edit.lead.description')
                                <textarea name="lead_description"  class= "form-control form-control2 description">{{$leaddata->discription}}</textarea>
                            @else
                                <textarea name="lead_description"  class= "form-control form-control2" readonly="">{{$leaddata->discription}}</textarea>
                            @endpermission 
                            @else
                              <textarea name=""  class= "form-control form-control2" readonly="">XXXXX</textarea>
                            @endpermission
                            </div>
                    </div>        
                    </div>
                    
                    <hr>
                    @permission('view.lead.address')
                    @permission('edit.lead.address')
                       <b style="color: white">Address</b>                                                            
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
                           <input type="text" name="State" value="{{$companyaddress->state}}" class="form-control mt-0" readonly="">
                        </div>
                        </div> 
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                              <label>City/County</label>
                               <input type="text" name="County" value="{{$companyaddress->County}}"  class="form-control mt-0" readonly="">
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
                                 <input type="text" name="time_zone" value="{{$companyaddress->time_zone}}" class="form-control mt-0" readonly="">
                            </div>
                        </div>
                    </div>
                    @endpermission
                    @else
                        <div class="row">
                        <div class="col-md-1 pr-1">
                            <div class="form-group">
                                <label>Ho/No</label>
                                <input type="" class="form-control mt-0"  name="" value="XX" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Street Name</label>
                               <input type="" class="form-control mt-0"  name="" value="XXXXX" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Address Line2</label>
                                  <input type="" class="form-control mt-0"  name="" value="XXXXX" readonly="">
                            </div>
                        </div>
                    @permission('view.lead.country') 
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
                            <input type="" name="" class="form-control mt-0" value="XXXXX" readonly=""> 
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
                                  <input type="" class="form-control mt-0"  name="" value="XXXXX" readonly="">
                            </div>
                        </div>
                        <div class="col-md-2 pl-1">
                            <div class="form-group">
                                <label>Time Zone</label>
                                   <input type="" class="form-control mt-0"  name="" value="XXXXX" readonly="">
                            </div>
                        </div>
                    </div>
                    @endpermission
                    <hr>
                       <b style="color: white"> Details</b>
                        <div class="row">
                            <div class="col-md-2 pr-1">
                                <div class="form-group">
                                    <label>Lead Status</label>
                                @permission('view.lead.status')      
                                @permission('edit.lead.status')     
                                    <select class="form-control mt-0" name="status">
                                        <option vlaue="{{$leaddata->status}}">{{$leaddata->status}}</option>
                                        <option vlaue="">New</option>
                                        <option vlaue="">Assigned</option>
                                        <option vlaue="">In Process</option>
                                        <option vlaue="">Converted</option>
                                        <option vlaue="">Recycled</option>
                                        <option vlaue="">Dead</option>
                                    </select>
                                @else
                                    <input type="text" name="status" value="{{$leaddata->status}}" class="form-control mt-0" readonly="">    
                                @endpermission
                                @else
                                  <input type="" name="" value="XXXXX" class="form-control" readonly=""> 
                                @endpermission

                                </div>
                            </div>
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label>Lead Source</label>
                                @permission('view.lead.source') 
                                @permission('edit.lead.source')     
                                    <select class="form-control mt-0" name="source" value="">
                                    <option value="{{$leaddata->source}}">{{$leaddata->source}}</option>   
                                    <option value="Call">Call</option>
                                    <option value="Email">Email</option>
                                    <option value="Existing Customer">Existing Customer</option>
                                    <option value="Partner">Partner</option>
                                    <option value="Public Relations">Public Relations</option>
                                    <option value="Web Site">Web Site</option>
                                    <option value="Campaign">Campaign</option>
                                    <option value="Other">Other</option>
                                    </select>
                                @else
                                    <input type="text" name="source" value="{{$leaddata->source}}" class="form-control mt-0" readonly="">
                                @endpermission
                                @else
                                    <input type="" name="" value="XXXXX" class="form-control" readonly=""> 
                                @endpermission
                                </div>
                            </div>
                            <div class="col-md-2 px-1">
                              <div class="form-group">
                                <label>Vendor Type</label>
                            @permission('view.lead.vendor.type') 
                            @permission('edit.lead.vendor.type') 
                                <select class="form-control mt-0" name="vendor_type">
                                        <option vlaue="$companydata->vendor_type">{{$companydata->vendor_type}}</option>
                                        <option vlaue="Fixed">Fixed</option>
                                        <option vlaue="Retail">Retail</option>
                                </select>
                            @else
                                <input type="text" name="vendor_type"  value="{{$companydata->vendor_type}}" class="form-control mt-0" readonly="">    
                            @endpermission
                            @else
                                <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            @endpermission   
                                </div>
                            </div>
                            
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label>Business Type</label>
                                @permission('view.lead.business.type')
                                @permission('edit.lead.business.type')
                                    <input type="text" class="form-control mt-0"  name="type_business" value="{{$companydata->type_business}}">
                                @else
                                     <input type="text" class="form-control mt-0"  name="type_business" value="{{$companydata->type_business}}" readonly="">
                                @endpermission 
                                @else
                                    <input type="" name="" value="XXXXX" class="form-control" readonly="">
                                @endpermission
                                </div>
                            </div>  
                            <div class="col-md-2 px-1">
                                <div class="form-group">
                                    <label>Opportunity Amount </label>
                                @permission('view.lead.amount') 
                                @permission('edit.lead.amount') 
                                    <input type="text" class="form-control mt-0" name="opportunity_amount" value="{{$leaddata->opportunity_amount}}">
                                @else
                                     <input type="text" class="form-control mt-0" name="opportunity_amount" value="{{$leaddata->opportunity_amount}}" readonly="">
                                @endpermission 
                                @else
                                    <input type="" name="" class="form-control" value="XXXXX" readonly="">
                                @endpermission
                                </div>
                            </div>    
                            <div class="col-md-2 pl-1">
                                <div class="form-group">
                                 <label>Followup Date </label>
                            @permission('view.lead.followup.date')
                            @permission('edit.lead.followup.date') 
                                 <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" value="{{$leaddata->followup_date_time}}" autocomplete="off">
                            @else
                                 <input id="datetimepicker" class="form-control mt-0" type="text" name="followup_date_time" value="{{$leaddata->followup_date_time}}" autocomplete="off" readonly="">
                            @endpermission 
                            @else
                                 <input type="" name="" value="XXXXX" class="form-control" readonly="">
                            @endpermission
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
 
