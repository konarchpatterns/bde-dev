<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
class User extends Authenticatable
{
    use Notifiable;
     use HasRoleAndPermission;
     use LogsActivity;
     protected static $logName = 'User Detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','workfrom','sidebar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    public function hasDirectPermission($permission){
         $directpermission = DB::table("permission_user")->select('permission_user.permission_id')->where([["permission_user.user_id",$this->attributes["id"]],['permission_user.permission_id',$permission]])->get();
         if(count($directpermission) > 0){
            
             return true;
             //convert into array than send
             //by default it take is array
          }
         else{
             return false;
          }
    }
    public function hasRolePermission($permission){
        $rolepermissions=DB::table('role_user')->select('role_user.role_id')->where('role_user.user_id',$this->attributes["id"])->get();
        foreach ($rolepermissions as $rolepermission) {
            $checkrolepermissions=DB::table('permission_role')->select('permission_role.permission_id')->where([['permission_role.role_id',$rolepermission->role_id],['permission_role.permission_id',$permission]])->get();
        }
        if(count($checkrolepermissions) > 0){
            return true;
        }
        else{
            return false;
        }
     
    }

    // public function getDirectPermission(){
    //     $directpermissions=DB::table('permission_user')->select('permission_user.permission_id')->where('permission_user.user_id',$this->attributes["id"])->get();
    //     foreach ($directpermissions as $directpermission) {
    //           $getpermission=DB::table('permissions')->select('permissions.name')->where('permission_user.user_id',$this->attributes["id"])->get();
    //     }

    // }
 
    protected static $logFillable = true;        

    protected static $logAttributes = ['*'];
     protected static $logAttributesToIgnore = ['password','calendarpassword','created_at','updated_at'];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
         
              $activity->attributes3 ="{$activity->subject_id}";
              $activity->attributes4="{$activity->subject_id}";
              $nameiss=DB::table('users')->select('name')->where('id',$activity->subject_id)->get();
               foreach ($nameiss as $nameis){

                     $activity->attributes2="{$nameis->name}";
                    
               }
 
              
                   
                    
                 
              $string='';  
              foreach($activity->properties['attributes'] as $key=>$value)
              {
               
                if($value == null)
                {
                   $string .=  $key.' is empty. ';
                }
                else{
                  $string .= $key.' is '. $value.'. ';
                }
                
                   
              
                             
              } 
              if(isset($activity->properties['old'])){

                  $string.=' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $string .=  $key.' was empty';
                         }
                         else{
                               $string .= $key.' was '. $value.'. ';
                         }
                  }
              }

               $text = str_replace('_', ' ', $string);
               $activity->attributes1="{$text}";
           
           
           
    }

}
