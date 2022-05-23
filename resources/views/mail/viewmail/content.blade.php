<div class="">
    <div class="row">
        <div class="col-md-1">
          <h5><b>Mail</b></h5> 
        </div>
        <div class="col-md-9">
              <a class="btn btn-sm btn-fill btn-danger" data-toggle="tooltip" data-placement="top" title="Refresh Table"  id="delsession" ><i class="fa fa-eraser" aria-hidden="true"style="color:white"></i></a>
        </div>
    @permission('create.email')
        <div class="col-md-2">
            <a class="btn btn-primary btn-outline rightdiv" href="{{route('mail.create')}}">Create Mail</a>
        </div>
    @endpermission 
    </div>

<div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive  mt-2">
    <table id="mailrecords" class="table table-bordered table-striped mb-0" style="width:100%">
        <thead>
            <tr >
                <th>No</th>
                <th>From</th>
                <th>To</th>
                <th>Subject</th>
                <th>Times</th>
            @permission('edit.email')
                <th>Edit</th>
            @endpermission 
            @permission('delete.email')
                <th>Delete</th>
            @endpermission
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    
</div>
</div>