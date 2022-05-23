<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Client_Master extends Model
{
         use LogsActivity;
    protected static $logName = 'Client Detail';
	protected $table = 'client_masters';
    protected $fillable = [
        'client_name','client_designation','deleted'
    ];
     protected static $logFillable = true;        
     protected static $logAttributes = ['*'];
     protected static $logAttributesToIgnore = ['salutation_name','client_first_name','client_last_name','created_user_id','created_at','updated_at'];
     protected static $logOnlyDirty = true;

    public function ClientPhone()
    {
        return $this->hasMany('App\Client_phone_number','client_id');
    }
    public function ClientEmail()
    {
        return $this->hasMany('App\Client_email_address','client_id');
    }
    
    public function tapActivity(Activity $activity, string $eventName)
    {
         
              $activity->attributes3 ="{$activity->subject_id}";
              $clientids1=DB::table('client_masters')->where('id',$activity->subject_id)->get();
             
              foreach ($clientids1 as $clientid2){
                 $activity->attributes2="{$clientid2->client_first_name}";
                  $activity->attributes4=$clientid2->company_id;
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
                                  $string .=  $key.'was empty. ';
                         }
                         else{
                               $string .= $key.' was '. $value.'. ';
                         }
                  }
              }

                // $text1 = str_replace('_', ' ', $string);
                $text2 = str_replace('client_id', 'id', $string);
                $text3 = str_replace('client_name', 'name', $text2);
                $text4 = str_replace('client_designation', 'designation', $text3);
                $text5 = str_replace('linkedin_url', 'linkedin url', $text4);
                $text6 = str_replace('company_id', 'company id', $text5);
                $text7 = str_replace('user_assign_id', 'user assign id', $text6); 
                $text9 = str_replace('clientconverted', 'status', $text7);
                $text10 = str_replace('lead_id', 'lead id', $text9);
               $activity->attributes1="{$text10}";
           
           
    }

}
