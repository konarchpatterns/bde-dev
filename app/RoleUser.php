<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Model;
//use Klaravel\Ntrust\Traits\NtrustRoleTrait;

class RoleUser extends Model
{
    

    protected $table = 'role_user';

    protected static $roleProfile = 'user';


    protected $fillable = ['role_id',  'user_id' ] ;

  

   public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    // public function clientdtls()
    // {
    //     return $this->hasMany('App\Models\ClientDtl');
    // }
     
}
