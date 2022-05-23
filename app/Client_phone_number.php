<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Client_phone_number extends Model
{
	use LogsActivity;
  protected static $logName = 'Client Phone';
    protected $table = 'client_phone_numbers';
     protected $fillable = [
        'client_id','client_phone','phone_type','dammy','deleted'
    ];
    protected static $logFillable = true;        
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['dammy','created_at','updated_at'];
    protected static $logOnlyDirty = true;
     public function tapActivity(Activity $activity, string $eventName)
    {
    	 $clientids=DB::table('client_phone_numbers')->where('id', $activity->subject_id)->get();
         foreach ($clientids as $clientid){
              $activity->attributes3 ="{$clientid->client_id}";
              $clientids1=DB::table('client_masters')->where('id',$clientid->client_id)->get();
              foreach ($clientids1 as $clientid2){
                 $activity->attributes2="{$clientid2->client_first_name}";
                 $activity->attributes4="{$clientid2->company_id}";
              }
             $string='';  
              foreach($activity->properties['attributes'] as $key=>$value)
              {

                if($value == null)
                {
                   $string .=  $key.' is empty. ';
                }
                else{
                  $string .= $key.' is '. $value.', ';
                }
                             
              } 
              if(isset($activity->properties['old'])){

                  $string.=' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $string .=  $key.' was empty. ';
                         }
                         else{
                               $string .= $key.' was '. $value.'. ';
                         }
                  }
              }

              // $text1 = str_replace('_', ' ', $string);
              $text2 = str_replace('client_id', 'client id', $string);
              $text3 = str_replace('client_phone', 'phone', $text2);
              $text4 = str_replace('phone_type', 'phone type', $text3);
              $activity->attributes1="{$text4}";
           
           
          }

        
    }
}
