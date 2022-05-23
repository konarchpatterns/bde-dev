<div class="">
    <div class="row">
        <div class="col-md-2">
          <h5 class="" ><b> Data Accounts</b></h5> 
          <input type="hidden" name="worktype" id="worktypeid" value="{{auth()->user()->workfrom}}">
        </div>
        <div class="col-md-1">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession" ><i class="fa fa-eraser" aria-hidden="true" id="delsession" style="color:white"></i></a>

        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
        </div>
    </div>
       

 <?php $row ="show companyname"; ?>


<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="compnyrecords" class="table table-bordered  mb-0" style="width:100%">
        <thead  class="fhead">
            <tr class="firstrow">
                <th>No</th>
                <th>Company</th>
                <th>Website</th>
                <th>Phno</th>
                <th>Email</th>
              @role('data.entry.manager')
                <th>Created By</th>
              @endrole
                <th>State</th> 
                <th>Country</th>  
                <th>Time Zone</th>  
                <th>Created at</th> 
            </tr>
            <tr class="secondrow">
                <th>No</th>
                <th>Company</th>
                <th>Website</th>
                <th>Phno</th>
                <th>Email</th>
              @role('data.entry.manager')
                <th>Created By</th>
              @endrole
                <th>State</th> 
                <th>Country</th>  
                <th>Time Zone</th>  
                <th>Created at</th> 
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>
