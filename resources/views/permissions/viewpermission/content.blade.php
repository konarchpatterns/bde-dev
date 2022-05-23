<div class="">
    <div class="row">
        <div class="col-md-2">
          <h5><b>Permissions</b></h5> 
        </div>
        <div class="col-md-8">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
        </div>
        <div class="col-md-2">
           @permission('create.permission')    
            <a class="createpermission btn btn-primary btn-outline" href="#">Create Permission</a>
           @endpermission
        </div>
    </div>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="permissionrecords" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
            @permission('edit.permission')  
                <th>Edit</th>
            @endpermission
            @permission('delete.permission')  
                <th>Delete</th>
            @endpermission   
            </tr>
        </thead>
        <tbody>  
        </tbody>
    </table>
    
</div>
</div>

<div class="modal fade right" id="CreatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                  <label  class="btn btn-danger btn-sm closepermission"><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>

            <div class="modal-body">
              
                 <!-- <input type="hidden" value="" name="leadid" id="leadid">
                 <input type="hidden" value="" id="currentPageIndexid"> -->
                 
               <div class="row">

                    <div class="col-md-3 pr-1">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="" id="name"required="">
                            </div>
                    </div>
                    <div class="col-md-3 px-1">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="" id="slug" required="">
                            </div>
                    </div> 
                    <div class="col-md-2 px-1">
                            <div class="form-group ">
                                <label>Model</label>
                                <input type="text" class="form-control mt-0" name="model" value="Permission" id="model" required="">
                            </div>
                    </div> 
                     <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label >Description</label>
                                <textarea class="form-control form-control2 mt-0" name="description" id="description"  required=""></textarea>
                               
                            </div>
                    </div> 
               </div>
               <div class="row">
                    <div class="col-md-4 pr-1">
                                <div class="form-group ">
                                     <a class="btn btn-primary btn-outline submitpermission" href="#">Submit</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>

<!-- update permission model -->
<div class="modal fade right" id="UpdatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading1"></h4>
                  <label  class="btncancle closeupadepermission">Cancel</label>
            </div>

            <div class="modal-body">
              
                 <input type="hidden" value="" name="permissionid" id="permissionid">
                 <input type="hidden" value="" name="currentPageIndexid" id="currentPageIndexid">
                 
               <div class="row">

                    <div class="col-md-4 pr-1">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="" id="updatename" required="">
                            </div>
                    </div>
                    <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="" id="updateslug" required="">
                            </div>
                    </div> 
                 <!--     <div class="col-md-2 px-1">
                            <div class="form-group ">
                                <label>Model</label>
                                <input type="text" class="form-control mt-0" name="model" value="" id="updatemodel" required="">
                            </div>
                    </div>  -->
                     <div class="col-md-4 px-1">
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea class="form-control form-control2 mt-0" name="description" id="updatedescription" value=""  required=""></textarea>
                            </div>
                    </div> 
               </div>
               <div class="row">
                    <div class="col-md-4 pr-1">
                                <div class="form-group ">
                                     <a class="btncreate submitupdatepermission" href="#">Update</a>
                                </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>