<div class="">
    <div class="row">
        <div class="col-md-3">
          <h5 class=""><b>Unassigned Accounts</b></h5> 
           <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">
        </div>
         <div class="col-md-1">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession" ><i class="fa fa-eraser" aria-hidden="true" id="delsession" style="color:white"></i></a>

         </div>
       
         <div class="col-md-1">
            
         
        </div>
        
        <div class="col-md-7">
            @permission('create.company')
               <a class="btn btn-primary btn-outline rightdiv  " href="{{route('company.create')}}">Create Account</a>
            @endpermission 
            @permission('edit.company.assign.user')
             <a href="#" id="assignuser" class="btn btn-info btn-sm btn-outline rightdiv mr-2">Assign User</a>
            @endpermission 
            @permission('edit.company.assign.user')
            <a class="btn btn-success btn-sm btn-outline rightdiv mr-2" href="{{route('company.showassigncompany')}}" data-toggle="tooltip" data-placement="bottom" title="Assigned Accounts">AA</a>
            @endpermission
            @permission('edit.company.assign.user')
            <a class="btn btn-success btn-sm rightdiv btn-outline mr-2" href="{{route('company.index')}}" data-toggle="tooltip" data-placement="bottom" title="Show All Accounts">SAA</a>
            @endpermission 
            <a class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont" href="javascript:void(0)"  data-toggle="tooltip" data-placement="bottom" title="Dialed Accounts"  value="DA">DA</a>
            <a class="btn btn-warning btn-sm btn-outline rightdiv mr-2 filternewdialaccont" href="javascript:void(0)"  data-toggle="tooltip" data-placement="bottom" title="New Accounts"  value="NA">NA</a>
             <a class="btn btn-warning btn-sm btn-outline active rightdiv mr-2 filternewdialaccont" href="javascript:void(0)"  data-toggle="tooltip" data-placement="bottom" title="All"  value="All">All</a> 
        </div>
    </div>
       

 <?php $row ="show companyname"; ?>
@if(isset($errors))
@foreach ($errors as $error)
  <li style="color:white"> {{$error}}</li>
@endforeach
@endif

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="compnyrecords" class="table table-bordered table-striped mb-0" style="width:100%">
        <thead  class="fhead">
            <tr class="firstrow">
               @permission('view.company.checkbox')
                <th><input type="checkbox"  id="checkboxid1"></th>
               @endpermission
               @permission('view.company.name')
                <th>No</th>
               @endpermission
               @permission('view.company.name')
                <th>Company</th>
               @endpermission
               @permission('view.company.website')
                <th>Website</th>
               @endpermission
               @permission('view.company.phone')
                <th>Phno</th>
               @endpermission
               @permission('view.company.email')
                <th>Email</th>
               @endpermission
               @permission('view.company.assign.user')
                <th>User</th>
               @endpermission
               @permission('view.company.assign.by')
                <th>Assign By</th>
               @endpermission
               @permission('view.company.address')
                <th>State</th> 
               @endpermission
               @permission('view.company.country')
              <!--  <th>Business Type</th> -->
             
                <th>Country</th>  
               @endpermission
               @permission('view.company.address')
                <th>Time Zone</th> 
               @endpermission
               @permission('view.company.address')
                <th>Disposition</th> 
               @endpermission
             
            </tr>
            <tr class="secondrow">
          
               @permission('view.company.checkbox')
                <th><input type="checkbox"  id="checkboxid1"></th>
               @endpermission
               @permission('view.company.name')
                <th>No</th>
               @endpermission
               @permission('view.company.name')
                <th>Company</th>
               @endpermission
               @permission('view.company.website')
                <th>Website</th>
               @endpermission
               @permission('view.company.phone')
                <th>Phno</th>
               @endpermission
               @permission('view.company.email')
                <th>Email</th>
               @endpermission
               @permission('view.company.assign.user')
                <th>User</th>
               @endpermission
               @permission('view.company.assign.by')
                <th>Assign By</th>
               @endpermission
               @permission('view.company.address')
                <th>State</th> 
               @endpermission
               @permission('view.company.country')
              <!--  <th>Business Type</th> -->
             
                <th>Country</th>  
               @endpermission
               @permission('view.company.address')
                <th>Time Zone</th> 
               @endpermission
               @permission('view.company.address')
                <th>Disposition</th> 
               @endpermission
         
           
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>

<div class="modal fade right" id="AssignuserModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                  <label id="closeuser" class="btn btn-danger btn-outline btn-sm"><i class="fa fa-times"></i></label>
            </div>

            <div class="modal-body">
              
                 <input type="hidden" value="" name="companyid" id="companyid">
                 <input type="hidden" value="" id="currentPageIndexid">
                 
                <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                    <table id="userrecord" class="table table-hover table-striped" style="width:100%">
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

</div>
@include('company.companymodal.companydisposition.content')
@include('company.companymodal.companyinfoindisposition.content')