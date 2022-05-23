<form action="{{route('client.update')}}" method="post" >
    @csrf
    <input type="hidden" name="id" value="{{$clientdata->id}}">
<div class="">
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('client.index')}}"><b>Contacts</b><a> <i class="fa fa-angle-double-right"></i>{{$clientdata->client_first_name}} {{$clientdata->client_last_name}}</h5>  

                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif       
        </div>
        <div class="col-md-3">
         <a href="{{route('client.show',['id'=>$clientdata->id,'backto'=>$backto])}}" class="btn btn-info btn-outline rightdiv">Back</a>
          <input type="hidden" name="backto" value="{{$backto}}">
         <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
            
        </div>
    </div>
 
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
                <!-- <div class="card-header ">
                    <h5 class="card-title"><b>Overview</b></h5>
                </div> -->
                <div class="card-body ">
                    <h5>Client Detail</h5>
                    <div class="row">  
                    @permission('view.client.name')     
                    @permission('edit.client.name') 
                        <div class="col-md-1 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select name="salutation_name" class="form-controlselect mt-0" >
                                    <option value="{{$clientdata->salutation_name}}" selected="">{{$clientdata->salutation_name}}</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Dr.">Dr.</option>    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text"  class="form-control mt-0 first"  name="client_first_name"  value="{{$clientdata->client_first_name}}">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text" id="client_last_name" class="form-control mt-0 last"  name="client_last_name" placeholder="Last Name" value="{{$clientdata->client_last_name}}"  >
                            </div>
                        </div>
                    @else
                        <div class="col-md-1 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select name="salutation_name" class="form-controlselect mt-0" >
                                    <option value="{{$clientdata->salutation_name}}" selected="">{{$clientdata->salutation_name}}</option>   
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text"  class="form-control mt-0 "  name="client_first_name"  value="{{$clientdata->client_first_name}}" readonly="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text" id="client_last_name" class="form-control mt-0"  name="client_last_name" placeholder="Last Name" value="{{$clientdata->client_last_name}}" readonly="" >
                            </div>
                        </div>
                    @endpermission 
                    @else
                            <div class="col-md-1 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <input type="" name="" value="XXX" readonly="" class="form-control mt-0">
                            </div>
                        </div>
                            <div class="col-md-3 px-1">  
                            <div class="form-group">
                                <label></label>
                                <input type="" name="" value="XXXXX" readonly="" class="form-control mt-0">
                            </div>
                        </div>
                            <div class="col-md-3 px-1">  
                            <div class="form-group">
                                <label></label>
                                <input type="" name="" value="XXXXX" readonly="" class="form-control mt-0" >
                            </div>
                        </div>

                    @endpermission
                        <div class="col-md-2 px-1">
                            <label>Designation</label>
                    @permission('view.client.designation')
                    @permission('edit.client.designation')
                            <div class="form-group">
                                <input type="text" class="form-control mt-0 designation"  name="client_designation" value="{{$clientdata->client_designation}}" >
                            </div>
                    @else
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="client_designation" value="{{$clientdata->client_designation}}" readonly="" >
                            </div>
                    @endpermission
                    @else
                          <input type="" name="" class="form-control" value="XXXXX" readonly="">
                    @endpermission
                        </div>
                        <div class="col-md-3 pl-1">
                             <label>Company Name</label>
                        @permission('view.client.company.name')     
                        @permission('edit.client.company.name')
                            <div class="form-group input-group input-group-unstyled">
                               
                                <input type="text" class="form-control mt-0 compinput" name="company_name" value="{{$copmany_name}}" id="company_name" required="" autocomplete="off">
                                <input type="hidden" name="company_id" value="{{$copmany_name}}" id="company_id">
                            </div>
                        @else
                             <div class="form-group input-group input-group-unstyled">
                               
                                <input type="text" class="form-control mt-0 compinput" name="company_name" value="{{$copmany_name}}" id="company_name" required="" autocomplete="off" readonly="">
                                <input type="hidden" name="company_id" value="{{$copmany_name}}" id="company_id">
                            </div>
                        @endpermission
                        @else
                            <input type="" name="" value="XXXXX" readonly="" class="form-control">
                            <input type="hidden" name="company_name" value="{{$company_name}}">
                        @endpermission
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <label>Linkedin</label>
                        @permission('view.client.linkedin')    
                        @permission('edit.client.linkedin')
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="linkedin_url" value="{{$clientdata->linkedin_url}}">
                            </div>
                        @else
                             <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="linkedin_url" value="{{$clientdata->linkedin_url}}" readonly="">
                            </div>
                        @endpermission
                        @else
                           <input type="" name="" value="XXXXX" readonly="" class="form-control">
                        @endpermission

                        </div>
                  
                        <div class="col-md-4 px-1">
                           <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                        @permission('view.client.email')
                            @forelse($emailarray as $emails)
                             @permission('edit.client.email')
                                <div class="input-group my-group mb-1">
                                    <input type="hidden" name="rootvalue[]" value="{{$emails->client_email}}">
                                    <input type="email" class="form-control mt-0 emailid" id="email[]" name="email[]" value="{{$emails->client_email}}" >
                                    <input type="hidden" name="eid[]" value="{{$emails->id}}">
                                    <select name="email_type[]"  id="email_type[]" value="{{$emails->email_type}}" class="" >
                                        <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>
                                    </select> 
                                @permission('delete.client.email') 
                                    @if ($loop->first)
                                    @else
                                    <a href="#" class="remove_emailfield btn1 mt-0 mb-0" onclick="Deleteclientemail('{{route('client.emaildelete',[$emails->id])}}',this,'{{$emails->client_email}}')">X</a>
                                    <!-- <label class="remove_emailfield btn1"> X </label> -->  
                                    @endif
                                @endpermission
                                </div>
                              @else
                                    <div class="input-group my-group mb-1">
                                   
                                        <input type="email" class="form-control mt-0" id="email[]" name="email[]" value="{{$emails->client_email}}" readonly="">
                                       
                                        <select name="email_type[]"  id="email_type[]" value="{{$emails->email_type}}" class="" >
                                            <option value="{{$emails->email_type}}">{{$emails->email_type}}</option>   
                                        </select> 
                                    </div>
                               @endpermission
                            @empty
                                   
                                     <div class="input-group my-group mb-1">
                                     <input type="email" class="form-control mt-0 emailid" id="email[]" name="email[]" value="" >
                                      <select name="email_type[]"  id="email_type[]" value=""  >
                                        <option value="Work">Work</option>
                                        <option value="Home">Home</option>
                                    </select>
                                    </div> 
                            
                            @endforelse
                        @else
                            <input type="" name="" class="form-control" value="XXXXX" readonly="">  
                        @endpermission
                         
                        </div>
                         @permission('edit.client.email')
                        <a href="javascript:void(0);" id="addemail" class="btn btn-sm btn-warning">+ </a>
                         <div class="error" id="emailErr"></div> 
                          @endpermission
                        </div>
                        <div class="col-md-4 pl-1">
                            <div id="phonetextbox" class="form-group">
                            <label>Phone</label>
                        @permission('view.client.phone')
                            @forelse($phonearray as $phones)
                             @permission('edit.client.phone')
                                <div class="input-group my-group mb-1">
                                    <input type="hidden" name="rootvalue" value="{{$phones->client_phone}}">
                                    <input type="text" class="form-control mt-0 phno" id="client_phone[]" name="client_phone[]" value="{{$phones->client_phone}}">
                                    <input type="hidden" name="pid[]" value="{{$phones->id}}">
                                    <select id="phone_type[]" name="phone_type[]" class="" value="{{$phones->phone_type}}" pattern="[1-9]{1}[0-9]{9}" >

                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                        
                                    </select> 
                                @permission('delete.client.phone') 
                                    @if ($loop->first)
                                    @else
                                     <a href="#" class="remove_phonefield btn1 mt-0 mb-0" onclick="Deleteclientphoneno('{{route('client.phonedelete',[$phones->id])}}',this,'{{$phones->client_phone}}')">X</a>
                                    <!-- <a class="btn1" href="{{route('lead.index')}}">X</a> -->
                                    @endif
                                @endpermission
                                </div>
                              @else
                                <div class="input-group my-group mb-1">
                                  
                                    <input type="text" class="form-control mt-0" id="client_phone[]" name="client_phone[]" value="{{$phones->client_phone}}" readonly="">
                                   
                                    <select id="phone_type[]" name="phone_type[]" class="" value="{{$phones->phone_type}}" pattern="[1-9]{1}[0-9]{9}" >

                                        <option value="{{$phones->phone_type}}">{{$phones->phone_type}}</option>
                                       
                                    </select> 
                                   
                                </div>
                              @endpermission
                            @empty
                                    <div class="input-group my-group mb-1">
                                    <input type="text" class="form-control mt-0 phno" id="client_phone[]" name="client_phone[]" value="">
                                    <select id="phone_type[]" name="phone_type[]" class="" value="" pattern="[1-9]{1}[0-9]{9}" >
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>
                                        <option value="Extension">Extension</option>
                                    </select> 
                                    </div>
                               
                            @endforelse
                        @else
                            <input type="" name="" value="XXXXX" class="form-control mb-1" readonly="">
                        @endpermission
                           
                        </div>
                         @permission('edit.client.phone')
                         <a href="javascript:void(0);" id="addphone" class="btn btn-sm btn-warning"> + </a>
                         <div class="error" id="mobileErr"></div>  
                         @endpermission
                        </div>
                    </div>
                    <div class="row">
                               
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                            @permission('view.client.description')
                            @permission('edit.client.description')
                                <textarea name="lead_description" class="form-control form-control2 mt-0 description" rows="3">{{$clientdata->lead_description}}</textarea>
                            @else
                                  <textarea name="lead_description" class="form-control form-control2 mt-0" rows="3" readonly="">{{$clientdata->lead_description}}</textarea>
                            @endpermission
                            @else
                              <textarea name="" class="form-control form-control2 mt-0" rows="3" readonly="">XXXXX</textarea>
                            @endpermission  
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

</form>
 

