<div class="">
<div class="row">
        <div class="col-md-9">
          <h5>Meeting</h5> 
        </div>
        <div class="col-md-3">
                    
            
            <a class="btnback rightdiv" href="javascript:history.go(-1)" title="Return to the previous page">back</a>
            
            <button id="createmeeting" class="btncreate rightdiv mr-2" >Create Meeting</button>
          
        </div>
    </div>
</div>

<div class="modal fade right" id="CreatePermissionModel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>
                  <label  class="btncancle closepermission">Cancel</label>
            </div>

            <div class="modal-body">
              
{!! Form::open(['id' =>'meeting', 'method'=>'post', 'action' => 'MeetingController@store']) !!}
        <div class="row mt-1">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" id="" class="form-control mt-0"  name="name"  value="">
                            </div>
                        </div>
                        <div class="col-md-2 px-1">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" data-name="status" class="form-control">
                                    <option value="Planned" selected="">Planned</option><option value="Held">Held</option>
                                    <option value="Not Held">Not Held</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Start DateTime</label>
                                <input type="text" id="" class="form-control mt-0"  name="name"  value="">
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <label>End DateTime</label>

                                <input type="text" id="" class="form-control mt-0"  name="name"  value="">
                            </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label>Parent</label>
                                <select name="status" data-name="status" class="form-control">
                                    <option value="Company" selected="">Company</option><option value="Lead">Lead</option>
                                    <option value="Client">Client</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company" class="form-control mt-0">
                            </div>
                        </div>
                        <div class="col-md-3 px-1 " id="back">
                            <div class="form-group">
                                <label>Client Name</label>
                                <input type="text" name="client" class="form-control mt-0">
                             
                            </div>
                        </div>
                       
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <label>Attendees User</label>
                                <input type="text" name="client" class="form-control mt-0">
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control form-control2"></textarea>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>

{!! Form::close() !!}
               
            </div>

        </div>

    </div>

</div>