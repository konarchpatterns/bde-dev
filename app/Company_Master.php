<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Company_Master extends Model
{    
     use LogsActivity;
   protected static $logName = 'Company Detail';
	 protected $table = 'company_masters';
    
    protected $guarded = [];
    
    protected static $logFillable = true;        
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;

    
    // public function user()
    // {
    //       return $this->hasOne('App\User', 'id', 'user_assign_id');
    // }
  
    public function CompanyAddress()
    {  
        return $this->hasOne('App\Company_address','company_id');
    }
    public function CompanyPhone()
    {
        return $this->hasMany('App\Company_phone_number','company_id');
    }
    public function CompanyEmail()
    {
        return $this->hasMany('App\Company_email_address','company_id');
    }
    public function CompanyClient()
    {
        return $this->hasMany('App\Client_Master','company_id');
    }
     public function tapActivity(Activity $activity, string $eventName)
    {
         
              $activity->attributes3 ="{$activity->subject_id}";
              $activity->attributes4="{$activity->subject_id}";
              $companyids1=DB::table('company_masters')->select('company_name')->where('id',$activity->subject_id)->get();

                 foreach ($companyids1 as $companyid1){
                     $activity->attributes2="{$companyid1->company_name}";
                    
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
