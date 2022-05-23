<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    
     
    protected $table = 'roles';

    protected static $roleProfile = 'user';


    protected $fillable = ['name',  'display_name', 'description' ] ;


     public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }
  
}
