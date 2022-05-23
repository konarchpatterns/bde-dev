@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif
                       
@if(Session::has('alert-warning'))
    <div class="alert alert-warning">
        {{ Session::get('flash_message1') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input type="hidden" name="company_id" value="{{$client->company_id}}">
 <div class="row">
    <div class="col-md-3">  
        <h3>View Company</h3>
    </div>
    <div class="col-md-9 mt-3">
        <a href="#" class="btn btn-danger btn-outline rightdiv ml-2">Cancel</a>
      
      
    </div>
 </div>

<div class="card temcolor1">

 
<div class="card-body">
  <div class="row"> 
   <div class="col-md-5 px-2">
    <div class="rounded border border-fill s">
      <div class="card-body">
        <h5 align="center" class="ts"><b>Company Information</b></h5>
        <h5><label class="labviewcolor">Company Name : </label>
        <span class="spantext">{{$client->client_company}}</span></h5>
        <h5><label class="labviewcolor">Website : </label>
        <span class="spantext">{{$client->website}}</span></h5>
        <h5><label class="labviewcolor">Company Type : </label>
        <span class="spantext">{{$client->store_type}}</span></h5>
        <h5><label class="labviewcolor">Industry : </label>
        <span class="spantext">{{$client->industry}}</span></h5>
        <h5><label class="labviewcolor">Company Special Details : </label>
        <span class="spantext">{{$client->company_specific}}</span></h5>
       </div>
     </div>
     <div class="rounded border border-fill s mt-2">
      <div class="card-body">
      @permission('vend-file-price.show')
        <h5><label class="labviewcolor">Vector Price : </label>
        <span class="spantext">{{$client->unit_price}}</span></h5> 
      @endpermission
      @permission('v_emb_rate.show')
        <h5><label class="labviewcolor">Emb. Rate : </label>
        <span class="spantext">{{$client->digit_rate}}</span></h5> 
      @endpermission
        <h5><label class="labviewcolor">Client Source : </label>
        <span class="spantext">{{$client->client_source}}</span></h5> 
        <h5><label class="labviewcolor">Sales Executive : </label>
        <span  class="spantext">{{$client->csr_person}}</span></h5>           
      </div> 
     </div>
  </div>
  <div class="col-md-3 px-0">
    <div class="card s">
      <div class="card-body ">
          <h5 align="center" class="ts"><b>Company Contact</b></h5>
        <h5 align="center"><label class="labviewcolor">email</label></h5>
     @permission('show.primary-email')  
        @php
            $a=1;
        @endphp
            @foreach(explode(",",$client->email) as $compemailarray)  
                      <h5><span class="spantext">{{$a++}}) {{$compemailarray}}</span></h5>
            @endforeach
     @else
         <h5 align="center"><span class="spantext">No Permission</h5>
     @endpermission 
     
        <h5 align="center"><label class="labviewcolor">Phone</label></h5>
     @permission('contact1.show') 
        @php
            $b=1;
        @endphp
            @foreach(explode(",",$client->phone) as $compephonrarray)
                   @if($compephonrarray != "")
                      <h5><span class="spantext">{{$b++}}) {{$compephonrarray}}</span></h5>
                   @else
                       <h5>No Phone</h5>
                   @endif

            @endforeach
     @else
        <h5 align="center"><span class="spantext">No Permission</h5>
     @endpermission
 
      </div>
     </div>
      <h5><label class="labviewcolor">BlackList : </label>
          <span class="spantext">{{$client->red_list}}</span></h5>
      <h5><label class="labviewcolor">Black Reason : </label> 
          <span class="spantext">{{$client->red_list_details}}</span></h5> 
  </div>
  <div class="col-md-4 px-2">
    <div class="card s">
      <div class="card-body ">
         <h5 align="center" class="ts"><b>Company Address</b></h5>
        @permission('client.address.show')
          <h5><label class="labviewcolor">Unit No : </label>
          <span class="spantext">{{$client->unitno}}</span></h5> 
          <h5><label class="labviewcolor">Street Name : </label>
          <span class="spantext">{{$client->client_address1}}</span></h5>
          <h5><label class="labviewcolor">Address Line2 : </label>
          <span>{{$client->client_address_line2}}</span></h5>
          <h5><label class="labviewcolor">Country : </label>
          <span class="spantext">{{$client->client_country}}</span></h5>  
          <h5><label class="labviewcolor">State : </label>
          <span class="spantext">{{$client->client_state}}</span></h5>
          <h5><label class="labviewcolor">City/County : </label>
          <span class="spantext">{{$client->city}}</span></h5> 
          <h5><label class="labviewcolor">Zip Code : </label>
          <span class="spantext">{{$client->zipcode}}</span></h5> 
          <h5><label class="labviewcolor">Time Zone : </label>
          <span class="spantext">{{$client->timezone_type}}</span> </h5>
          <h5><label class="labviewcolor">About Company : </label>
          <span class="spantext">{{$client->about_company}}</span></h5>
        @else
          <h5 align="center"><span class="spantext">No Permission</h5>
        @endpermission 
      </div>
     </div>
  </div>
 </div>
<!-- end company id -->
<br>
 <h5 align="center"><b style="text-align: center;"class="ts">Client Team Information</b></h5> 
  <div class="row">
      
             
 
                 <div class="col-md-12 mt-1"> 
                      <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                      <table id="clientrecords" class="table table-bordered table-striped mb-0" style="width:100%">
                                       <thead>
                                         <tr>
                                             <th>No</th>
                                             <th>Name</th>
                                          @permission('show.primary-email')
                                             <th>Email</th>
                                          @endpermission
                                          @permission('contact1.show')
                                             <th>Phone</th>
                                          @endpermission
                                             <th>Designation</th>
                                             <th>Client Note</th>
                                             <th>Block list</th>
                                             <th>Action</th>
                                           
                                         </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                     </table>
                      </div>   
                </div>

  </div>
 

