<div class="modal fade right" id="AssignuserModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <b class="modal-title" id="modelHeading">Assign User</b>
            @permission('edit.company.assign.user')
                <a href="#" class="btn btn-warning btn-outline" id="unassignuser" >Unassign User</a>
            @endpermission 
                  <label id="closeuser" class="btn btn-danger btn-sm btn-outline"><i class="fa fa-times"></i></label>
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