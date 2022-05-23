<div class="">
    <div class="row">
        <div class="col-md-3">
          <h5><b>CSV List  </b></h5> 
        </div>
        <div class="col-md-7">
             <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table" id="delsession"><i class="fa fa-eraser" aria-hidden="true"  style="color:white"></i></a>
        </div>
    
    </div>
 <br>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
    <table id="seatrecords" class="table table-bordered table-striped mb-0"style="width:100%; border:1px black solid;">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Name</th>
                <th>Deatil</th>
                 <th>Accounts</th>
                 <th>Time</th>
              @permission('show.csv.list') 
                <th>Show</th>
              @endpermission
              @permission('edit.csv.list')  
                <th>Edit</th>
              @endpermission  
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>

<!-- update permission model -->
<div class="modal fade right" id="UpdatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading1"></h4>
                  <label  class="btn btn-danger btn-outline btn-sm closeupadepermission"><i class="fa fa-times" aria-hidden="true"></i></label>
            </div>

            <div class="modal-body">
              
                 <input type="hidden" value="" name="permissionid" id="permissionid">
                 <input type="hidden" value="" name="currentPageIndexid" id="currentPageIndexid">
                 
               <div class="row">

                    <div class="col-md-6 pr-1">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="" id="updatename" required="">
                            </div>
                    </div>
                    <div class="col-md-12 pr-1">
                            <div class="form-group ">
                                <label>Detail</label>
                                <textarea class="form-control form-control form-control2 mt-0" id="updatedetail"></textarea>
                               
                            </div>
               
               </div>
               <div class="row">
                <div class="col-md-3">
                </div>
                    <div class="col-md-4 pr-1">
                          <div class="form-group">
                              <a class="btn btn-primary btn-outline submitupdatepermission" href="#">Update</a>
                          </div>
                    </div>
               </div>
            </div>

        </div>

    </div>

</div>