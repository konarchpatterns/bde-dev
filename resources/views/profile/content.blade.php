<form action="{{route('user.updateprofile')}}" method="post" >
         @csrf
<div class="">
    <div class="row">
        <div class="col-md-8">
            <h5><b>User Profile</b></h5>           
        </div>

        <div class="col-md-4">
            <a href="#" class="btn btn-info btn-outline rightdiv" onclick="location.href = document.referrer; return false;">Back</a>
            <!-- <a href="" class=" btn-lg btncancle rightdiv">Back</a>   -->
            <button  class="btn btn-success btn-outline rightdiv mr-2">Save</button>  
        </div>
    </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
             
                <div class="card-body ">
                  
                    <div class="row">
                     
                        <div class="col-md-3 pr-1">  
                            <div class="form-group">
                                <label>Name</label>
                        @role('admin')  
                              <input type="text" class="form-control mt-0"   name="name" value="{{auth()->user()->name}}" required="">
                        @else
                            <input type="text" class="form-control mt-0"   name="name" value="{{auth()->user()->name}}" required="" readonly="">
                        @endrole
                            </div>
                        </div>
                        
                    
                        <div class="col-md-5 px-1">
                            <label>Email</label>
                            <div class="form-group">
                            @role('admin') 
                                <input type="email" class="form-control mt-0 "   name="email" value="{{auth()->user()->email}}">
                            @else
                                <input type="email" class="form-control mt-0 "   name="email" value="{{auth()->user()->email}}" readonly="">
                            @endrole
                            </div>
                        </div>
                         <div class="col-md-4 pl-1">
                            <label>Designation</label>
                            <div class="form-group">
                            @role('admin') 
                                <input type="text" class="form-control mt-0"  name="" value="{{auth()->user()->designation}}">
                            @else
                                <input type="text" class="form-control mt-0"  name="" value="{{auth()->user()->designation}}" readonly>
                            @endrole
                            </div>
                        </div>   
                       
                        
                       
                    </div>
                    <div class="row">
                        @role('bde') 
                        @else

                            <div class="col-md-3 pr-1">

                               <label>Reporting Authority</label>
                                <div class="form-group">
                                   
                               
                                    <input type="text" class="form-control mt-0"  name="" value="{{$userathorityname}}" readonly>
                               
                                </div>
                            </div>
                         @endrole 
                        <div class="col-md-3 pr-1">
                            <label>Change Password</label>
                            <div class="form-group">
                                <input type="text" class="form-control mt-0"  name="password" value="">
                            </div>
                        </div> 
                         <div class="col-md-3 pr-1">
                            <!-- <label>Calendar Password</label> -->
                            <div class="form-group">
                        <input type="hidden" class="form-control mt-0"  name="calendarpassword" value="{{auth()->user()->calendarpassword}}">
                            </div>
                        </div>   
                       
                    </div>
                    
                </div>
            </div>
        </div>
     
    </div>
</div>

</form>

           