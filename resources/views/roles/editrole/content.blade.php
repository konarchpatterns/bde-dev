<form action="{{route('role.update')}}" method="post" >
    @csrf
<input type="hidden" name="id" value="{{$role->id}}">

<div class="">
    <div class="row">
        <div class="col-md-9">
            <h5><a href="{{route('role.index')}}"><b>Roles</b></a> <i class="fa fa-angle-double-right"></i><b>Update</b></h5>          
        </div>
        <div class="col-md-3">
            <a href="{{route('role.index')}}" class="btn btn-danger btn-outline rightdiv">Cancel</a>
               <button class="btn btn-primary btn-outline rightdiv mr-2">Update</button>
        </div>
    </div>
  @if ($errors->any())
    <div class="alert alert-danger mt-1 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li >{{ $error }}</li>
            @endforeach
        </ul>
    </div>
 @endif
    <div class="row  mt-2">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                     <div class="col-md-3 pr-1 ">
                            <div class="form-group ">
                                <label>Name</label>
                                <input type="text" class="form-control mt-0" name="name" value="{{$role->name}}"   required="">
                                <input type="hidden" name="id" value="{{$role->id}}">
                            </div>
                        </div>
                        <div class="col-md-4 px-1 ">
                            <div class="form-group ">
                                <label>Slug</label>
                                <input type="text" class="form-control mt-0" name="slug" value="{{$role->slug}}"   required="">
                            </div>
                        </div>
                        <div class="col-md-1 px-1 ">
                            <div class="form-group ">
                                <label>Level</label>
                                <input type="text" class="form-control mt-0" name="level" value="{{$role->level}}"   required="">
                            </div>
                        </div>
                         <div class="col-md-4 pl-1 ">
                            <div class="form-group ">
                                <label>Description</label>
                                <textarea name="description" class="form-control form-control2 mt-0" value="" required="">{{$role->description}}</textarea>
                               <!--  <input type="text" class="form-control mt-0" name="description" value=""   required=""> -->
                            </div>
                        </div>
                   </div>
                     
                     <h5 align="center" class="rounded pt-2 pb-2 ts" style=" color:black;"><b>Permission</b></h5>
                      <div class="row">
                        <div class="col-md-6">
                                    <h5 align="center" class="ts  font-weight-bold ">Main Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>View</th>
                            <th>Create</th>
                            <th>Edit</th>
                            <th>Delete</th>  
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>user</td>
                        @foreach($permissions as $permission) 
                             @if(in_array($permission->description,['company','client','lead','user','role','permission','logs','event','email'] ))
                                      @if($row == 4)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @endif
                            @endif
                        @endforeach
                        </tr>
                        </table>
                        </div>
                        <div class="col-md-6">
                            <h5 align="center" class="ts  font-weight-bold ">Client Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>client name</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['client name','client company name','client phone','client email','client designation','client linkedin','client description'] ))
                                      @if($row == 3)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                        </table>
                         </div>
                        <div class="col-md-6 mt-3">
                            <h5 align="center"class="ts  font-weight-bold ">Company Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>company checkbox</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['company checkbox','company name','company website','company phone','company email','company assign user','company assign by','company country','company fax','company address','company vendor type','company business type','company description','Csv list'] ))
                                      @if($row == 3)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                             </div></td><!-- <td style="color: white">{{$permission->name}}</td> --> 
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                        </table>
                         </div>
                         <div class="col-md-6 mt-3">
                            <h5 align="center" class="ts  font-weight-bold">Lead Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>lead checkbox</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['lead checkbox','lead name','lead website','lead phone','lead email','lead assign user','lead assign by','lead country','lead fax','lead address','lead vendor type','lead business type','lead description','lead status','lead source','lead followup date','lead amount'] ))
                                      @if($row == 3)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white">{{$permission->name}}</td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                        </table>
                         </div>
                          <div class="col-md-12 mt-3">
                            <h5 align="center" class="ts  font-weight-bold ">Show Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>Lead Phone</th>
                            <th>Lead Email</th>
                            <th>Company Phone</th>
                            <th>Company Email</th>
                            <th>Client Phone</th>
                            <th>Client Email</th>
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Show</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['show lead phone','show lead email','show company phone','show company email','show client phone','show client email']))
                                      @if($row == 6)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                            </div><!-- </td><td style="color: white">{{$permission->name}}</td> -->
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                        </table>
                         </div>

                         <div class="col-md-6 mt-3">
                            <h5 align="center"class="ts  font-weight-bold ">Click Permission</h5>
                        <table id="roles" class="" style="width:100%">   
                        <tr>
                            <th>Field</th>
                            <th>View</th>
                            
                           <!--  <th>Delete</th>   -->
                        </tr>
                        
                            <?php $row =0; ?>
                        <td>Click Client</td>
                        @foreach($permissions as $permission) 
                            @if(in_array($permission->description,['Click Client','Click New Client'] ))
                                      @if($row == 1)
                                        <?php $row =0; ?>
                                        </tr><tr><td>{{$permission->description}}</td>
                                      @endif
                                        <?php $row++; ?>
                                      @if($role->hasPermission($permission->id))

                                      <td> 
                                        <div class="form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}" checked="">
                                        <span class="form-check-sign"></span>
                                         </label>
                                        </div></td><!-- <td style="color: white">{{$permission->name}}</td> -->
                                      @else
                                        <td> 
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="assignpermissions[]" value="{{$permission->id}}">
                                                <span class="form-check-sign"></span>
                                                </label>
                                             </div></td><!-- <td style="color: white">{{$permission->name}}</td> --> 
                                      @endif
                            @else
                            @endif
                         
                        @endforeach
                        </tr>
                        </table>
                         </div>
                         <!-- add here -->
                        </div>
                </div>

            </div>

        </div>
    </div>
 </div>
 </form>  

