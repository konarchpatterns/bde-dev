<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Client_disposition extends Model
{
    use LogsActivity;
	  protected static $logName = 'Client Disposition';
    protected $table = 'client_dispositions';
    protected $fillable = [
        'client_id','user_id','status','follow_up_date','description','created_atus'
    ];
    protected static $logFillable = true;        
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['client_id','user_id','created_at','updated_at'];
    protected static $logOnlyDirty = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
    	 $clientids=DB::table('client_dispositions')->where('id', $activity->subject_id)->get();
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
                   $string .=  $key.'=No data ,';
                }
                else{
                  $string .= $key.'='. $value.',';
                }
                             
              } 
              if(isset($activity->properties['old'])){

                  $string.=' old data ';
                  foreach ($activity->properties['old'] as $key => $value) {
                         if($value == null){
                                  $string .=  $key.'= No data ,';
                         }
                         else{
                               $string .= $key.'='. $value.',';
                         }
                  }
              }

              $text = str_replace('_', ' ', $string);
           
               $activity->attributes1="{$text}";
           
           
          }
        
    }

}
