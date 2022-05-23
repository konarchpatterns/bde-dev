<div class="">
    <div class="row">
        <div class="col-md-1">
               <a><h5><b>Roles</b></h5></a> 
        </div>
        <div class="col-md-9">
              <a class="btn btn-sm btn-fill btn-danger"  id="delsession" data-toggle="tooltip" data-placement="top" title="Refresh Table"><i class="fa fa-eraser" aria-hidden="true" style="color:white"></i></a>
        </div>
        <div class="col-md-2">
         <!--    <a class="createpermission btncreate" href="#">Create Permission</a> -->
        @permission('create.role') 
            <a class="btn btn-primary btn-outline rightdiv" href="{{route('role.create')}}">Create Role</a>
        @endpermission
        </div>
    </div>
  
<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="rolerecords" class="table table-bordered table-striped mb-0" style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Slug</th>
                <th>Level</th>
            @permission('edit.role') 
                <th>Edit</th>
            @endpermission
            @permission('delete.role')    
                <th>Delete</th>
            @endpermission
            </tr>
        </thead>
        <tbody>  
        </tbody>
    </table>
    
</div>
</div>

