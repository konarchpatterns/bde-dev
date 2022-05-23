<form action="{{route('client.update')}}" method="post" >
    @csrf
    <input type="hidden" name="id" value="{{$clientdata->id}}">
<div class="">
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('company.dataentryshow',['id'=>$clientdata->company_id,'backto'=>$backto])}}"><b>Contacts</b><a> <i class="fa fa-angle-double-right"></i>{{$clientdata->client_first_name}} {{$clientdata->client_last_name}}</h5>  

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
                  
                        <div class="col-md-1 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select name="salutation_name" class="form-controlselect mt-0" >
                                    @if($clientdata->salutation_name != "")
                                    <option value="{{$clientdata->salutation_name}}" selected="">{{$clientdata->salutation_name}}</option>
                                    @else
                                       <option value="" selected=""></option>
                                    @endif
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
                  
                        <div class="col-md-2 px-1">
                            <label>Designation</label>
                   
                            <div class="form-group">
                                <input type="text" class="form-control mt-0 designation"  name="client_designation" value="{{$clientdata->client_designation}}" >
                            </div>
                
                        </div>
                        <div class="col-md-3 pl-1">
                             <label>Company Name</label>
                        
                            <div class="form-group input-group input-group-unstyled">
                               
                                <input type="text" class="form-control mt-0 compinput" name="company_name" value="{{$copmany_name}}" id="company_name" required="" autocomplete="off">
                                <input type="hidden" name="company_id" value="{{$copmany_name}}" id="company_id">
                            </div>
                       
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <label>Linkedin</label>
                       
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="linkedin_url" value="{{$clientdata->linkedin_url}}">
                            </div>
                       

                        </div>
                  
                        <div class="col-md-4 px-1">
                           <div id="emailtextbox" class="form-group">
                            <label>Email</label>
                      
                            @forelse($emailarray as $emails)
                            
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
                              
                            @empty
                                   
                                     <div class="input-group my-group mb-1">
                                     <input type="email" class="form-control mt-0 emailid" id="email[]" name="email[]" value="" >
                                      <select name="email_type[]"  id="email_type[]" value=""  >
                                        <option value="Work">Work</option>
                                        <option value="Home">Home</option>
                                    </select>
                                    </div> 
                            
                            @endforelse
                       
                         
                        </div>
                       
                        <a href="javascript:void(0);" id="addemail" class="btn btn-sm btn-warning">+ </a>
                         <div class="error" id="emailErr"></div> 
                        
                        </div>
                        <div class="col-md-4 pl-1">
                            <div id="phonetextbox" class="form-group">
                            <label>Phone</label>
                       
                            @forelse($phonearray as $phones)
                           
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
                      
                           
                        </div>
                        
                         <a href="javascript:void(0);" id="addphone" class="btn btn-sm btn-warning"> + </a>
                         <div class="error" id="mobileErr"></div>  
                     
                        </div>
                    </div>
                    <div class="row">
                               
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                       
                                <textarea name="lead_description" class="form-control form-control2 mt-0 description" rows="3">{{$clientdata->lead_description}}</textarea>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

</form>
 

