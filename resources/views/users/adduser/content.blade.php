<form action="{{ route('user.store') }}" method="post">
    @csrf


    <div class="">
        <div class="row">
            <div class="col-md-9">
                <h5>
                    <a href="{{ route('user.index') }}">
                        <b>User's Roles & Permission</b>
                    </a> <i class="fa fa-angle-double-right "></i>Create
                </h5>
            </div>
            <div class="col-md-3">
                <a href="{{ route('user.index') }}" class="btn btn-danger btn-outline rightdiv ">Cancel</a>
                <button class="btn btn-success btn-outline rightdiv mr-2">Save</button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row  mt-2">
            <div class="col-md-12">
                <div class="card ">

                    <div class="card-body ">
                        <h5 align="center" class="rounded pt-2 pb-2 ts" style=" color:black;"><b>New User</b></h5>
                        <div class="row">
                            <div class="col-md-3 pr-1 ">
                                <div class="form-group ">
                                    <label>First Name</label>
                                    <input type="text" class="form-control mt-0" name="first_name"
                                        value="{{ old('first_name') }}" required="">
                                </div>
                            </div>
                            <div class="col-md-3 px-1 ">
                                <div class="form-group ">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control mt-0" name="last_name"
                                        value="{{ old('last_name') }}" required="">
                                </div>
                            </div>
                            <div class="col-md-4 px-1 ">
                                <div class="form-group ">
                                    <label>E-Mail Address</label>
                                    <input type="email" class="form-control mt-0" name="email"
                                        value="{{ old('email') }}" required="">
                                </div>
                            </div>
                            <div class="col-md-2 pl-1">
                                <div class="form-group ">
                                    <label>Designation</label>
                                    <select name="designation" class="form-control mt-0" id="designation">
                                        @role('admin')
                                            <option value="Admin">Admin</option>
                                        @endrole
                                        @foreach ($roledata as $role)
                                            @if (Auth::user()->level() > $role->level)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-3 pr-1 ">
                                <div class="form-group ">
                                    <label>Reporting Authority</label>
                                    <select name="team_leader_id" class="form-control mt-0" id="select1">

                                        @role('admin')
                                            <option value='None' class="onlyadmin followupvisible">None</option>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}" class="adminautority">
                                                    {{ $admin->name }}</option>
                                            @endforeach
                                        @endrole
                                        @foreach ($teamleaders as $teamleader)
                                            <option value="{{ $teamleader->id }}" class="bdaauthority">
                                                {{ $teamleader->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3 pl-1 ">
                                <div class="form-group ">
                                    <label>Password</label>
                                    <input type="text" id="password" class="form-control mt-0" name="password"
                                        value="{{ old('password') }}" required="">
                                </div>
                            </div>
                        </div>
                        @role('admin')
                            <h5 align="center" class="rounded pt-2 pb-2 ts" style=" color:black;"><b>Roles</b></h5>
                            <!--     <h4 style="color:black"><b>Roles:</b></h4> -->
                            <div class="row">
                                <table>
                                    <tr>
                                        <?php $row = 0; ?>
                                        @foreach ($roledata as $role)
                                            @if ($row == 8)
                                                <?php $row = 0; ?>
                                    </tr>
                                    <tr>
                                        @endif
                                        <?php $row++; ?>


                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="assignroles[]"
                                                        value="{{ $role->id }}">
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $role->name }}</td>
                                        @endforeach
                                </table>
                            </div>
                            <h5 align="center" class="rounded pt-2 pb-2 ts mt-4" style=" color:black;"><b>Permission</b>
                            </h5>
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

                                        <?php $row = 0; ?>
                                        <td>user</td>
                                        @foreach ($permissions as $permission)
                                            @if (in_array($permission->description, ['company', 'client', 'lead', 'user', 'role', 'permission', 'logs', 'event', 'email']))
                                                @if ($row == 4)
                                                    <?php $row = 0; ?>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                @endif
                                                <?php $row++; ?>

                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="assignpermissions[]" value="{{ $permission->id }}">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                    <!-- </td><td style="color: white">{{ $permission->name }}</td> -->
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

                                        <?php $row = 0; ?>
                                        <td>client name</td>
                                        @foreach ($permissions as $permission)
                                            @if (in_array($permission->description, ['client name', 'client company name', 'client phone', 'client email', 'client designation', 'client linkedin', 'client description']))
                                                @if ($row == 3)
                                                    <?php $row = 0; ?>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                @endif
                                                <?php $row++; ?>

                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="assignpermissions[]" value="{{ $permission->id }}">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                    <!-- </td><td style="color: white">{{ $permission->name }}</td> -->
                                            @endif
                                        @endforeach
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h5 align="center" class="ts  font-weight-bold ">Company Permission</h5>
                                    <table id="roles" class="" style="width:100%">
                                        <tr>
                                            <th>Field</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <!--  <th>Delete</th>   -->
                                        </tr>

                                        <?php $row = 0; ?>
                                        <td>company checkbox</td>
                                        @foreach ($permissions as $permission)
                                            @if (in_array($permission->description, ['company checkbox', 'company name', 'company website', 'company phone', 'company email', 'company assign user', 'company assign by', 'company country', 'company fax', 'company address', 'company vendor type', 'company business type', 'company description', 'Csv list']))
                                                @if ($row == 3)
                                                    <?php $row = 0; ?>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                @endif
                                                <?php $row++; ?>

                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="assignpermissions[]" value="{{ $permission->id }}">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                    <!-- </td><td style="color: white">{{ $permission->name }}</td> -->
                                            @endif
                                        @endforeach
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h5 align="center" class="ts  font-weight-bold ">Lead Permission</h5>
                                    <table id="roles" class="" style="width:100%">
                                        <tr>
                                            <th>Field</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <!--  <th>Delete</th>   -->
                                        </tr>

                                        <?php $row = 0; ?>
                                        <td>lead checkbox</td>
                                        @foreach ($permissions as $permission)
                                            @if (in_array($permission->description, ['lead checkbox', 'lead name', 'lead website', 'lead phone', 'lead email', 'lead assign user', 'lead assign by', 'lead country', 'lead fax', 'lead address', 'lead vendor type', 'lead business type', 'lead description', 'lead status', 'lead source', 'lead followup date', 'lead amount']))
                                                @if ($row == 3)
                                                    <?php $row = 0; ?>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                @endif
                                                <?php $row++; ?>

                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="assignpermissions[]" value="{{ $permission->id }}">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                    <!-- </td><td style="color: white">{{ $permission->name }}</td> -->
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

                                        <?php $row = 0; ?>
                                        <td>Show</td>
                                        @foreach ($permissions as $permission)
                                            @if (in_array($permission->description, ['show lead phone', 'show lead email', 'show company phone', 'show company email', 'show client phone', 'show client email']))
                                                @if ($row == 6)
                                                    <?php $row = 0; ?>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $permission->description }}</td>
                                                @endif
                                                <?php $row++; ?>

                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="assignpermissions[]" value="{{ $permission->id }}">
                                                            <span class="form-check-sign"></span>
                                                        </label>
                                                    </div>
                                                    <!-- </td><td style="color: white">{{ $permission->name }}</td> -->
                                            @endif
                                        @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole
            </div>
</form>
