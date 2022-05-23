 <div class="">
      <input type="hidden" id="diapositiondata" name="disposition" value="{{$companydata->disposition}}">
      <input type="hidden" id="companyid" name="id" value="{{$companydata->id}}">
        <div class="row">

            <div class="col-md-10">
                <h5><a href="{{route('company.dataoperatoranydata')}}"><b>Account</b></a> <i class="fa fa-angle-double-right"></i>{{$companydata->company_name}}</h5><input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">       
            </div>
            <div class="col-md-2">
          <a href="{{route('company.dataoperatoranydata')}}" class="btn btn-danger btn-outline rightdiv mr-2">back</a>
@php
$backto="index";
@endphp
     @role('data.entry.manager')
          <a href="{{route('company.edit',['id'=>$companydata->id,'backto'=>$backto])}}" class="btn btn-success btn-outline rightdiv mr-2">Edit</a>
     @endrole
            </div>
        </div>

        <div class="row  mt-2">
            <div class="col-md-12">
                <div class="card">
                <div class="card-body ">
                <div class="row">
                  <div class="col-md-6">
                     <div class="card s">
                          <b style="color: black; text-align: center; background-color: " class="ts">Company Detail</b>
                       <div class="card-body ">
               
                             <h5 ><strong style="color:black">Company Name : </strong>{{$companydata->company_name}}</h5>
                      
                        
               
                            <h5><b style="color: black">Website : </b>{{$companydata->website_address}}</h5>
                      
                             <h5><b style="color: black">Fax No : </b>{{$companyaddress->fax_no}}</h5>
                       
                   </div>
                 </div>
              
                    <div class="card s">
                       <b style="color: black;text-align: center;"class="ts">Address</b>                  
                          <div class="card-body">
                       
                              <h5><strong style="color: black">Ho/No :</strong> {{$companyaddress->house_no}}</h5>

                        
                              <h5><strong style="color: black">Street Name :</strong>  {{$companyaddress->street_name}}</h5>
                           
                              <h5><strong style="color: black">Address Line2 :</strong>  {{$companyaddress->address_line_2}}</h5>
                         
                         
                            <h5><strong style="color: black">Country :</strong>  {{$companyaddress->Country}}</h5>
                            
                         
                            <h5><strong style="color: black">State :</strong>  {{$companyaddress->state}}</h5>
                            
                            <h5><strong style="color: black">City/County :</strong>  {{$companyaddress->County}}</h5>
                          
                            <h5><strong style="color: black">Zip Code :</strong>  {{$companyaddress->zip_code}}</h5>
                          
                            <h5><strong style="color: black">Time Zone :</strong>  {{$companyaddress->time_zone}}</h5>
                            
                         
                      </div> 
                    </div>
          
                 <!-- cut -->
                 
               </div>
                
                  <!--   <hr style="background-color: white"> -->
              
                  <div class="col-md-6">
                  <!-- phone -->
                 
                    <div class="card">
                       <b style="color: black;text-align: center;"class="ts">Other Detail</b>                  
                          <div class="card-body">
                          
                                <h5><strong style="color:black">Vendor Type :</strong>  {{$companydata->vendor_type}}</h5>
                           
                                <h5><strong style="color:black">Business Type :</strong>  {{$companydata->type_business}}</h5>
                          
                                  <h5><strong style="color:black">Description :</strong> {{$companydata->lead_description}}</h5>
                             
                          </div> 
                    </div>
                    
                    <div class="row">
                   
                     <div class="col-md-7 pr-1">
                          <div class="card sr mb-4" > 
                             <h6 class="ts mt-1" style="color:black; text-align: center;"><b>Email</b></h6>
                             <div class="card-body text-center mt-1">
                              
                                @forelse($companyemails as $emails)
                                
                                  <span value="{{$emails->company_email}}" data-toggle="tooltip" title="{{$emails->company_email}} ({{$emails->email_type}})" class="px-1">{{$emails->company_email}} <i class="fa fa-envelope" aria-hidden="true" style="font-size:15px;"></i> ({{$emails->email_type}})</span><br>   
                          
                                @empty

                                  <h5 class="ts mt-1" style="text-align: center;"><b>No Email</b></h5>  
                            
                              
                                @endforelse
                              
                             
                           </div>
                        </div>
                        </div>
                      
                      
                        <div class="col-md-5 pl-1">
                           <div class="card sr mb-4">
                             <h6 class=" ts mt-1" style="color:black; text-align: center;"><b>Phone</b></h6>
                             <div class="card-body text-center mt-1">
                              
                                @forelse($companyphones as $phones)
                                    <span value="{{$phones->company_phone}}" data-toggle="tooltip" title="{{$phones->company_phone}} ({{$phones->phone_type}})"  class="px-1">{{$phones->company_phone}}<i class="fa fa-phone-square" aria-hidden="true" style="font-size:15px;color:#51C248"></i> ({{$phones->phone_type}})</span><br> 
                                @empty
                                    <h5 class="ts mt-1" style="color:white; text-align: center;"><b>No Phone</b></h5>
                                  @endforelse
                               
                            </div>
                        </div>  
                        </div>
                       
                     </div>   
                              
  
                         
                  </div>
                     
                             
                      
                 </div>
                </div><!-- card body -->
         </div><!-- card -->
         </div><!-- col-md-12 -->
                      
      </div> <!-- first row -->
 </div> <!-- main div -->

 
     <div class="row">
               <div class="col-md-10" style="text-align: center;">                  
              <b style="color: black;text-align: center;"class="ts">Company Contacts</b>  </div>
              @permission('create.client')
                <div class="col-md-2"> 
                
                    <a href="{{route('client.create',['id'=>$companydata->id])}}"class="btn btn-primary btn-outline rightdiv">Add Client</a>
               
                 </div>  
              @endpermission      
                 <div class="col-md-12 mt-1"> 
                      <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                      <table id="clientrecords" class="table table-bordered table-striped mb-0" style="width:100%">
                                       <thead>
                                         <tr>
                                             <th>Id</th>
                                      
                                             <th>Name</th>
                                       
                                             <th>Designation</th>
                                    
                                             <th>Phone</th>
                                         
                                             <th>Email</th>
                                      
                                             <th>Show</th>  
                                          @permission('delete.client')
                                             <th>Delete</th>
                                          @endpermission 
                                         </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                     </table>
                      </div>   
                </div>
    </div>  

<!--  company disposition log  --> 
  
<!--  client disposition log  --> 

<!-- activity log table -->
@role('data.entry.manager')
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Activity Log</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="activitylog" class="table table-bordered table-striped mb-0" style="width:100%">
                    <thead class="fhead">
                        <tr class="firstrow">
                          <th>No</th>
                          <th>User</th>
                          <th>Action</th>
                          <th>Name</th>
                          <th>Record Type</th>
                          <th>What Modify</th> 
                          <th>Time</th>
                        </tr>
                        <tr class="secondrow">
                            <th>No</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Record Type</th>
                            <th>What Modify</th>
                            <th>Time</th>  
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>   
  @endrole   

