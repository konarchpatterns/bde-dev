<div class="">
    <div class="row">
        <div class="col-md-1">
          <h5 class="" ><b>Accounts</b></h5> 
          <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">
        </div>
         <div class="col-md-1">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession" ><i class="fa fa-eraser" aria-hidden="true" id="delsession" style="color:white"></i></a>

         </div>
       
         <div class="col-md-2">
            
            @role('admin')
            <a href="#" id="showcsv" class="btncreate rightdiv" >Upload CSV</a>
            <form action="{{route('company.import')}}" method="post" enctype='multipart/form-data' class="csvnotvisible" id="formidetity">
            
                    @csrf
                        <input id="uploadFile" class="disableInputField" placeholder="Upload CSV" disabled="disabled" />
                        <label class="fileUpload">
                            <input id="uploadBtn" type="file"  name="file"  class="upload" />
                            <span class="uploadBtn"><i class="fa fa-upload mt-1" style="font-size:24px;color:orange"></i>
                            </span>
                        </label>
                         <button class="btn btn-warning btn-sm mt-1">Import CSV</button>
<!-- 
                       <div class="col-md-4"> 
                       </div>
                        <div class="col-md-1"> 
                            
                             
                             
                              <input id="uploadFile" placeholder="Select File" disabled="disabled" />
                           <input type="file" name="file" id="file">
                        </div>
                        <div class="col-md-10">
                         <input type='submit' class='mt-1' name='submit' value='Submit'>
                        </div> -->
                              
                   
            </form>
          @endrole
        </div>
        
    </div>
       

 <?php $row ="show companyname"; ?>
@if(isset($errors))
@foreach ($errors as $error)
  <li style="color:black"> {{$error}}</li>
@endforeach
@endif

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="compnyrecords" class="table table-bordered  mb-0" style="width:100%">
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
              
              
                <th>Comments</th>
               
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
               
              
                <th>Comments</th>
         
               @permission('view.company.address')
                <th>State</th> 
               @endpermission
               @permission('view.company.country')  
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
@include('calendars.companypage')
@include('company.companymodal.assignusermodal.content')
@include('company.companymodal.companydisposition.content')
@include('company.companymodal.companyinfoindisposition.content')