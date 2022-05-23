<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


//class PermissionUser extends EntrustUserWithPermissionsTrait
class PermissionUser extends Model
{
    
    protected $table = 'permission_user';

    protected $fillable = ['user_id',  'permission_id'] ;


  public function user()
	{
    
      return $this->belongsTo('App\User');

	}

	public function permission()
	{
    
      return $this->belongsTo('App\Models\Permission');

	}
	 public function getDirectPermission(){
		 $directpermission = DB::table("permission_user")->select('permission_user.permission_id','permission_user.permission_id')->where([["permission_role.role_id",$this->attributes["id"]],["permission_role.permission_id",$permission]])->get();
		 if(count($directpermission) > 0){
             return $directpermission;
          }
         else{
             return false;
          }
	 }

    
     
}
