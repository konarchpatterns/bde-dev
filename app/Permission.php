<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Permission extends Model
{
    


    /*
     * Role profile to get value from ntrust config file.
     */
    protected static $roleProfile = 'user';
    
    protected $table = 'permissions';

    protected $fillable = ['name',  'display_name', 'description' ] ;



     
}
