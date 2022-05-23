<?php

namespace App\Http\Controllers;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Session;
use Illuminate\Validation\Rule;
class RoleController extends Controller
{
   public function index()
   {
          return view('roles.viewrole.view');
   } 
   public function anydata()
   {
    	  $data =Role::query();
         return Datatables::of($data)
          ->addColumn('edit',function($data){
                 $edit= route('role.edit',['id'=> $data->id]);
                 $rolename=$data->name;
                      $btn="<a href='{$edit}' class='btn btn-sm btn-fill btn-info'>Edit</a>";
                     return $btn;
           }) 
           ->addColumn('delete',function($data){
                 $delete=$data->id;
                
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-danger'>Delete</a>";
                     return $btn;
           }) 
          ->escapeColumns([])  
         ->make(true);	

 
    }
    public function create()
    {

    	$permissions=Permission::all();
        return view('roles.addrole.view',['permissions'=>$permissions]);

    }

    public function store(Request $request)
    {
 
        $this->validate($request, [

            'slug' => 'required|unique:roles,slug',

            'name' => 'required|unique:roles,name',

            'description' => 'required',
            'level' => 'required',
          

        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->level = $request->level;
        $role->save();
        if ($request->has('assignpermissions')) 
        {
            foreach ($request->assignpermissions as $key => $value) {

                $role->attachPermission($value);

            }
        }
        return redirect()->route('role.index')

                        ->with('success','Role created successfully');
    }
    public function edit($id)
    {
    	$role=Role::find($id);
     
        $permissions=Permission::all();
    	//$permissions=$role->getAllPermissions();
    	return view('roles.editrole.view',['role'=>$role,'permissions'=>$permissions]);
    }
    public function update(Request $request)
    {
    	 $this->validate($request, [

            'slug' => [
                       'required',
                     Rule::unique('roles')->ignore($request->id),
             ],
            'name' =>[
                       'required',
                     Rule::unique('roles')->ignore($request->id),
             ],
            'description' => 'required',
            'level' => 'required',
           

        ]);
    	$role =Role::find($request->id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->level = $request->level;
        $role->update();

        if($request->has('assignpermissions')) {

		        $role->syncPermissions($request->assignpermissions);
        }
        else{

            $role->detachAllPermissions();
        }


         return redirect()->route('role.index')

                        ->with('success','Role created successfully');

    }
    public function destroy(Request $request)
    {
        //dd($request->role_id);
        $deleterole=Role::findorfail($request->role_id)->delete();
    }

}