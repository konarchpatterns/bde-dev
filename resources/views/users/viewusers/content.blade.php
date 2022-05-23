<div class="">
    <div class="row">
        <div class="col-md-3">
          <h5><b>User's Roles & Permission</b></h5> 
        </div>
        <div class="col-md-7">
             <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
        </div>
     @permission('create.users') 
        <div class="col-md-2">
            <a class="btn btn-primary btn-outline rightdiv" href="{{route('user.create')}}">Create User</a>
        </div>
     @endpermission
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="userwithrolesrecords" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Role</th> 
                <th>Designation</th>
                <th>Reporting Authority</th>
            @permission('edit.users') 
                <th>Edit</th> 
            @endpermission
            @permission('delete.users')  
                <th>Delete</th> 
            @endpermission
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>