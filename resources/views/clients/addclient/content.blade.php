<form action="{{route('client.store')}}" method="post" onsubmit="return checkForm(this);">
         @csrf
<div class="">
    <div class="row">
        <div class="col-md-8">
            <h5><a href="{{route('client.index')}}"><b>Contacts</b><a> <i class="fa fa-angle-double-right"></i>Create</h5> 
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                 <!--  @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button> 
                                <strong>{{ $message }}</strong>
                            </div>
                  @endif         
 -->
        </div>
        <div class="col-md-4">
            <a href="{{route('client.index')}}" class=" btn btn-info btn-outline rightdiv">Back</a>
            <input type="submit" name="myButton" class="btn btn-success btn-outline rightdiv mr-2" value="Save">
           <!--  <button class="btnsave rightdiv mr-2">save</button> -->
            
        </div>
    </div>
   
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
             
                <div class="card-body ">
                     <b style="color:white">Client Detail<b>
                    <div class="row">
                        <div class="col-md-1 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                                <select name="salutation_name" class="form-control mt-0">
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
                                <input type="text" id="client_first_name" class="form-control mt-0"  name="client_first_name" placeholder="First Name" value="{{ old('client_first_name') }}" required="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label></label>
                                <input type="text" id="client_last_name" class="form-control mt-0"  name="client_last_name" placeholder="Last Name" value="{{ old('client_last_name') }}" >
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <label>Client Designation</label>
                            <div class="form-group">
                                <input type="text" class="form-control mt-0 designation"   name="client_designation" value="{{ old('client_designation') }}">
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                             <label>Company Name</label>
                        @if(isset($companydata))
                            <div class="form-group input-group input-group-unstyled"> 
                                <input type="text" class="form-control mt-0" name="company_name"  id="company_name" required="" autocomplete="off" value="{{$companydata->company_name}}" readonly="">
                            </div>
                            <input type="hidden" name="company_id" value="$companydata->id">
                        @else
                            <div class="form-group input-group input-group-unstyled">
                               
                                <input type="text" class="form-control mt-0 compinput" name="company_name" value="" id="company_name" required="" autocomplete="off" value="{{ old('company_name') }}">      
                            </div>
                        @endif  
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <label>Linkedin</label>
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="linkedin_url" value="{{ old('linkedin_url') }}" >
                            </div>
                        </div>   
                        <div class="col-md-4 px-1">
                            <div id="emailtextbox" class="form-group">
                                <label>Email</label>
                                <div class="input-group my-group mb-1">
                                    <input type="email" class="form-control mt-0 emailid" id="emails" name="email[]" value="" required="">
                                    <select id="email_type[]" name="email_type[]" class="">
                                        <option value="Work">Work</option>
                                        <option value="Home">Home</option>

                                    </select>
                                </div>  
                            </div>
                             <lable id="addemail" class="btn btn-sm  btn-warning"> + </lable>
                            <div class="error" id="emailErr"></div> 
                        </div>
                        <div class="col-md-4 pl-1">
                            <div id="phonetextbox" class="form-group">
                                <label>Client Phone</label>
                                <div class="input-group my-group mb-1">
                                    <input type="text" class="form-control mt-0 phno" id="client_phones" name="client_phone[] " pattern="[1-9]{1}[0-9]{9}" value="" required="">
                                    <select id="phone_type[]" name="phone_type[]" class="">
                                        <option value="Mobile">Mobile</option>
                                        <option value="Landline">Landline</option>   
                                    </select>
                                </div>   
                            </div>
                             <lable id="addphone" class="btn btn-sm  btn-warning" > + </lable>
                            <div class="error" id="mobileErr"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                            <textarea class="form-control form-control2 mt-0 description" name="lead_description" >{{ old('lead_description') }}</textarea>
                          <!--  maxlength="600" -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
</div>

</form>

           