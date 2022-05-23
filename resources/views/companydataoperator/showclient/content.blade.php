<div class="">
    <div class="row">

        <div class="col-md-10 ">
            <h5><a href="{{route('company.dataentryshow',['id'=>$clientdata->company_id,'backto'=>$backto])}}"  class="mt-0"><b>Contacts</b></a> <i class="fa fa-angle-double-right"></i>{{$clientdata->client_first_name}} {{$clientdata->client_last_name}}</h5>   
            <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">       
        </div>
        <div class="col-md-2 float-right">
         
         
              <a href="{{route('company.dataentryshow',['id'=>$clientdata->company_id,'backto'=>$backto])}}"class="btn btn-danger btn-outline rightdiv">Back</a>
              
            <input type="hidden" name="backto" value="{{$backto}}">
          @role('data.entry.manager')
            <a href="{{route('client.edit',['id'=>$clientdata->id,'backto'=>$backto])}}" class="btn btn-success btn-outline rightdiv mr-2">Edit</a>
          @endrole
        </div>
    </div>

    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body ">
                   <div class="row">
                  <div class="col-md-5">  
                  <div class="card s"> 
                    <b style="color: black; text-align: center; background-color: " class="ts">Client Detail</b>
                    <div class="card-body ">
                     
                        <h5><strong style="color: black">Client Name : </strong>{{$clientdata->salutation_name}}  {{$clientdata->client_first_name}}  {{$clientdata->client_last_name}}</h5>
                     
                        <h5><strong style="color: black">Designation : </strong> {{$clientdata->client_designation}}</h5>         
                         
                        <h5><strong style="color: black">Linkedin : </strong> {{$clientdata->linkedin_url}}</h5> 
                         <h5><strong style="color: black">Description : </strong> {{$clientdata->lead_description}}</h5>     
                     
                   
                        <h5><strong style="color: black">Company Name : </strong> {{$companydata->company_name}}</h5>  
                        <input type="hidden" name="clientid" value="{{$clientdata->id}}" id="clientid">
                  
                    </div> <!-- inner card1 body -->
                  </div><!--  inner card1  -->
                 </div> <!-- inner card column  -->
               
                  <div class="col-md-4">  
                  <div class="card s"> 
                       <b style="color: black; text-align: center; background-color: " class="ts">Client Email</b>
                       <div class="card-body text-center">
                       
                          @forelse($emailarray as $emails)
                          
                            <span value="{{$emails->client_email}}"  class="px-1" style="display: inline-block; color: black">{{$emails->client_email}}<i class="fa fa-envelope" aria-hidden="true" style="font-size:15px;color:black"></i>({{$emails->email_type}})</span><br>  
                               
                          @empty

                            <h5 class="ts mt-1" style="text-align: center;"><b>No Email</b></h5>
                          @endforelse
                       
                        </div> <!-- second inner card1 body -->
                    </div><!-- second inner card1  -->
                    </div> <!-- second inner card column  -->
                 
                  
                    <div class="col-md-3">  
                    <div class="card s"> 
                       <b style="color: black; text-align: center; background-color: " class="ts">Client Phone</b>
                       <div class="card-body text-center">   
                       
                          @forelse($phonearray as $phones)
                           
                              <span value="{{$phones->client_phone}}" onclick="redirectToPhoneURL('{{$phones->client_phone}}','{{$phones->phone_type}}')" class="px-1" style="display: inline-block; color:black">{{$phones->client_phone}}<i class="fa fa-phone-square" aria-hidden="true" style="font-size:15px;color:#51C248"></i> ({{$phones->phone_type}})</span><br> 
                            
                          @empty
                              <h5 class="ts mt-1" style="text-align: center;"><b>No Phone</b></h5>     
                          @endforelse
                        
                        </div> <!-- third inner card1 body -->

                    </div><!-- third inner card1  -->
              
                    </div> <!-- third inner card column  -->

                  </div><!--  main card row    -->       
                </div> <!--  main crad body -->
            </div><!-- main card -->
        </div> <!-- main col row -->
    </div> <!-- main row -->
</div> <!-- first div -->



@role('data.entry.manager')
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Dispositions</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="dispositionlog" class="table table-bordered table-striped mb-0" style="width:100%">
                      <thead class="fhead"> 
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Followup Date</th>
                            <th>Description</th>
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
@role('data.entry.manager') 
<div class="row">
    <div class="col-md-10" style="text-align: center;">                  
       <b style="color: black;text-align: center;"class="ts">Activity Log</b></div>
       <div class="col-md-12 mt-1"> 
            <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                <table id="activitylog" class="table table-bordered table-striped mb-0" style="width:100%">
                      <thead class="fhead">
                        
                        <tr >
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






















