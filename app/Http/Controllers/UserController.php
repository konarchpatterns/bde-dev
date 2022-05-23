<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lead;
use App\Company_Master;
use App\Assignuser;
use DataTables;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
          return view('users.viewusers.view');
    }
    public function anydata()
    { 
        $data =User::query();
         return Datatables::of($data)
        
         ->escapeColumns([])  
         ->make(true);


    }
     public function userassign(Request $request)
     {
          $leadids=$request->leadid;
          $selectedleadid = array_map('intval', explode(',', $request->leadid));
          $leadidlegnth=count($selectedleadid);

          for($i=0;$i< $leadidlegnth;$i++){
              $comapnydata=lead::find($selectedleadid[$i]);
              $comapnydata->userassign_id=$request->userid;
              $comapnydata->update();
          }
                // $useraddtolead=lead::where('id',$request->leadid)->update(['userassign_id'=> $request->userid]);
                // $username=User::find($request->userid);
                // $data=$request->userid;
                // return response()->json(['data'=>$data]);
     }
    //store color data in users table 
    public function setcolortheme(Request $request)
    { 
        $setthemecolor = DB::table('users')
                        ->where('id',auth::user()->id)
                        ->update(['color' => $request->new_color]);
     

    }
    //store minimize sidebar data in users table    
    public function maxminsidebar()
    { 
        
        $setmaxminsidebar=User::find(auth::user()->id);
        if($setmaxminsidebar->sidebar == ''){

             $setmaxminsidebar->sidebar='sidebar-mini';
          
        }
        else{
            $setmaxminsidebar->sidebar='';
        }
        $updatemaxminsidebar = DB::table('users')
                        ->where('id',auth::user()->id)
                        ->update(['sidebar' => $setmaxminsidebar->sidebar]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $roledata=Role::all();
         $permissions=Permission::all();
         $teamleaders=User::where([['designation','=','Business Development Manager'],['flag','=',0]])->get();
         
         $designationarray='Admin,Business Development Manager,Data Entry Manager';
         $designationarray=explode(',', $designationarray);
         $admins=User::whereIn('designation',$designationarray)->where('flag','=',0)->get();
         return view('users.adduser.view',compact('roledata','permissions','teamleaders','admins'));
        // return view('users.adduser.view');
    }

    public function list()
    {
        $rolelevel=Role::where('slug','bde')->pluck('level');
        if (Auth::user()->hasRole('admin')){

            $data=User::query()->where([['flag',0],['users.id','!=',6],['users.designation','!=','Admin']]);
        }
        else if(Auth::user()->level() == $rolelevel[0]){
            //user not include with nouser
            // $data=User::query()->where([['flag','=',0],['id','!=',auth::user()->id],['designation','=','Sales Executives'],['email','!=','Nouser@gmail.com']]);
            $data=User::query()->where([['flag','=',0],['id','!=',auth::user()->id],['designation','=','Sales Executives'],['team_leader_id','=',auth::user()->id]]);
       
        }
        else{
             $data=User::query()->where([['flag','=',0],['id','=',auth::user()->id]]);
        }
         // $data =User::query()->where('flag',0);
         return Datatables::of($data)
         ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                $btn="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='{$checkboxvalue}'>";
                     return $btn;
           }) 
         ->escapeColumns([])  
         ->make(true);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //create new user with role and permission
    public function store(Request $request)
    {
      $v = Validator::make($request->all(), [
            'first_name' =>'required',
            'email' => 'required|unique:users,email',
            'designation'=>'required',
            'password'=>'required'
    
       ]);   

      if( $v->fails()){
              return Redirect::back()->withErrors($v)->withInput();
      }    
        $user=new User;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->name=$request->first_name." ".$request->last_name;
        $user->login_name=$request->first_name.substr(trim($request->last_name),0,1);
        $user->email=$request->email;
        $user->designation=$request->designation;
        if($request->designation != 'Admin'){
          $user->team_leader_id=$request->team_leader_id;;
        }
        $user->flag=0;
        $user->password=Hash::make($request->password);
        $user->save();
        if($request->designation == 'Admin'){
           // $user1=User::find($user->id);
           $user->team_leader_id= $user->id;
           $user->save();
        }
        if(Auth::user()->hasRole(['admin'])) {
            $user->attachRole($request->assignroles);
            $user->attachPermission($request->assignpermissions); 
        }
        elseif(Auth::user()->hasRole(['bde'])){
            $rolelevel=Role::where('slug','se')->pluck('id');
            $user->attachRole($rolelevel);
        } 
        return view('users.viewusers.view');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //show user data in edit page
    public function useredit($id){
     
       if(Auth::user()->hasRole('admin')){
            $userdata=User::findorfail($id);
        }
        elseif(Auth::user()->hasRole('bde')){
             $userdata=User::findorfail($id);
             if(Auth::user()->id != $userdata->team_leader_id){
                    return view('error.403');
             }

        }
        else{
              return view('error.403');
        }
        $usernames=User::all();
        $teamleaders=User::where([['designation','=','Business Development Executives'],['flag','=',0]])->get();
         $designationarray='Admin,Business Development Manager,Data Entry Manager';
         $designationarray=explode(',', $designationarray);
         $admins=User::whereIn('designation',$designationarray)->where('flag','=',0)->get();
        $roledata=Role::all();
        $permissions=Permission::all();
          return view('users.edituserrole.view',compact('userdata','roledata','permissions','teamleaders','admins','usernames'));

    }
    //softdelete user only change password and deactivate user
     public function userdelete(Request $request){
          
        $userdata=User::findorfail($request->user_id);
        $userdata->flag=1;
        $userdata->update();

        $unassigncompanys=Company_Master::where('user_assign_id',$request->user_id)->get();
        if(count($unassigncompanys) > 0){
            foreach ($unassigncompanys as $unassigncompany) {
                $updatecompany=Company_Master::find($unassigncompany->id);
                $updatecompany->user_assign_id=6;
                $updatecompany->assign_by=auth::user()->name;
                $updatecompany->update();
            }
        }

        $unassignfromtables=Assignuser::where([['user_id','=',$request->user_id],['unassign','=','assign']])->get();
        if(count($unassignfromtables) > 0){
            foreach ($unassignfromtables as $unassignfromtables) {
                $updateassignfromtable=Assignuser::find($unassignfromtables->id);
                $updateassignfromtable->unassign_by=auth::user()->id;
                $updateassignfromtable->unassign="unassign";
                $updateassignfromtable->update();
            }
        }





         
    }
    //update user detail, role and permission
    public function userupdate(Request $request){
       
        
        $v = Validator::make($request->all(), [
            'first_name' =>'required',
            'designation'=>'required',
            'team_leader_id'=>'required',
            'email' => 'required|email|unique:users,email,'.$request->id
        ]);

        if( $v->fails()){
              return Redirect::back()->withErrors($v);
        } 

        $userdata=User::findorfail($request->id);
        $userdata->first_name=$request->first_name;
        $userdata->last_name=$request->last_name;
        $userdata->login_name=$request->first_name.substr(trim($request->last_name),0,1);
        $userdata->name=$request->first_name." ".$request->last_name;
        if(Auth::user()->hasRole('admin')){
            $userdata->email=$request->email;
            if($request->password != ""){
                $userdata->password=Hash::make($request->password);
            }
        }

        $userdata->designation=$request->designation;
        $userdata->team_leader_id=$request->team_leader_id;
        $userdata->update();
    if(Auth::user()->hasRole(['admin'])) {
        if ($request->has('assignroles')) 
        { 
                $userdata->syncRoles($request->assignroles);  
        }
        else{
            $userdata->detachAllRoles();
        }
        if($request->has('assignpermissions')){
            $userdata->syncPermissions($request->assignpermissions);
        }
        else{
            $userdata->detachAllPermissions();
        }
    }
        return redirect()->route('user.index');
    }
//view users data in datatable
    public function rolesdata(){
     
    // $q1=DB::raw("(SELECT GROUP_CONCAT(roles.name) FROM roles WHERE users.id = role_user.user_id GROUP BY users.id ) as rolename");
     // $data=DB::table('users')
     // ->join('role_user','users.id','=','role_user.user_id')
     // ->join('roles','roles.id','=','role_user.role_id')
     // ->select('users.id','users.name',$q1)
     // ->distinct()->groupBy('users.id','users.name','roles.name');
     // return Datatables::of($data)
     // ->escapeColumns([])  
     //      ->make(true);
    $rolelevel=Role::where('slug','bde')->pluck('level');
    if (Auth::user()->hasRole('admin')){
        $data=User::query()->where([['flag',0],['email','!=','Nouser@gmail.com']]);
      
    }
    else if(Auth::user()->level() == $rolelevel[0]){
          $data=User::query()->where([['flag','=',0],['id','!=',auth::user()->id],['designation','=','Sales Executives'],['email','!=','Nouser@gmail.com'],['team_leader_id','=',auth::user()->id]]);
       
    }
    
          return Datatables::of($data)
         ->addColumn('role',function($data){
             $c=count($data->getRoles());
             if($c > 0){
                $roles=$data->getRoles();
                  $btn=[];
                  foreach($roles as $role) {
                     $result=$role->name;
                      $btn[]=$result;
                  }
          
                return $btn;
            }
           }) 
        ->addColumn('leadername',function($data){
             $teamleadername= User::where([['id',$data->team_leader_id],['flag',0]])->get();
             $countteamleadername=count($teamleadername);
             if($countteamleadername > 0){
                foreach($teamleadername as  $leader) {
                     $leadername=$leader->name;
            
                }
             }
             else{
                $leadername="Deleted/Not Assign";
             }

             return $leadername;

        })
        ->addColumn('edit',function($data){
             $edit= route('user.useredit',['id'=> $data->id]);
             return "<a href='{$edit}' class='btn btn-sm btn-fill btn-info'>Edit</a>";

        })
        ->addColumn('delete',function($data){
            
              $btn="<a href='#' class='btn btn-sm btn-fill btn-danger deleteuser' value=1>Delete</a>";
                return $btn;

        })
        ->escapeColumns([])  
        ->make(true);
     }
    public function showprofile(){

        
        $userdata=User::find(Auth()->user()->id);
        $userathorityname=User::where('id',$userdata->team_leader_id)->pluck('name');
        $userathorityname=$userathorityname[0];
        return view('profile.view',compact('userathorityname'));

    }
     public function updateprofile(Request $request){
        $userdata=User::findorfail(Auth()->user()->id);
         $v = Validator::make($request->all(), [
            'name' =>'required',
            'email' => [
                            'required','email',
                         Rule::unique('users')->where(function($query) {
                  $query->where('id', '<>', Auth()->user()->id);
             
            })
            ],
         ]);   
       
         if( $v->fails()){
              return Redirect::back()->withErrors($v);
         }
        if (Auth::user()->hasRole('admin')){ 
            $userdata->name=$request->name;
            $userdata->email=$request->email;
        }
       
      
        if($request->password != ""){

            $userdata->password=Hash::make($request->password);
        }
        $userdata->calendarpassword=$request->calendarpassword;
        $userdata->update();
        if($request->password != ""){
                auth()->logout();
        }
          return redirect()->route('company.index');
     }

}
