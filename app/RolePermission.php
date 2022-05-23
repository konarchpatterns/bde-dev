<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;


class RolePermission extends Model
{
    

    protected $table = 'permission_role';

    protected static $roleProfile = 'user';

    protected $fillable = ['permission_id',  'role_id' ] ;

    
    public function  permission()
    {

        return $this->belongsTo('App/Models/Permission');
    
    }
     
    public function  role()
    {

        return $this->belongsTo('App/Models/Role');
    
    } 
}
