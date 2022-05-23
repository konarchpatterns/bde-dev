<?php

namespace App\Http\Controllers;
use DataTables;	
use Illuminate\Http\Request;
use App\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
// use Notification;
// use App\Notifications\Companycreate;
class PermissionController extends Controller
{
   public function index()
   {
          return view('permissions.viewpermission.view');
   } 
   public function anydata()
   {
    	 $data =Permission::query();
         return Datatables::of($data)
          ->addColumn('edit',function($data){
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-info'>Edit</a>" ;
                     return $btn;
           }) 
          ->addColumn('delete',function($data){
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-danger'>Delete</a>" ;
                     return $btn;
           }) 
         ->escapeColumns([])  
         ->make(true);
    }
    public function store(Request $request){
    	 $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'slug' => 'required|unique:permissions,slug',
            'description' => 'required',
         ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->description = $request->description;
        $permission->model =$request->model;
        $permission->save();
    }
    public function update(Request $request){
    	// dd("hi");
    	// $this->validate($request, [
     //        'name' => 'required|unique:permissions,name',
     //        'slug' => 'required|unique:permissions,slug',
     //        'description' => 'required',
     //     ]);

        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->slug = $request->slug;
        $permission->description = $request->description;
        //$permission->model =$request->model;
        $permission->update();
   
    }
    public function destroy(Request $request)
    {
        //dd($request->permission_id);
      $deletepermission=Permission::findorfail($request->permission_id)->delete();
    }
}
