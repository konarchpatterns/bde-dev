<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Eventuser extends Model
{
	use LogsActivity;
	 protected static $logName = 'Event User';
	protected $table = 'eventuser';
    protected $fillable = ['event_id', 'attendess_name', 'attendess_email','type','responsestatus','flag'];
    protected static $logFillable = true;        
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore =['created_at','updated_at'];
    protected static $logOnlyDirty = true;
    public function tapActivity(Activity $activity, string $eventName)
    {
    	 // $activity->attributes3 ="{$activity->subject_id}";
    	  $eventdetals=DB::table('eventuser')->where('id',$activity->subject_id)->get();
    	  foreach ($eventdetals as $eventdetal){

    	  	   $eventnames=DB::table('events')->where('id',$eventdetal->event_id)->get();
    	  	   foreach ($eventnames as $eventname) {
    	  	   	$activity->attributes2="{$eventname->title}";
    	  	   }
    	       
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
                                  $string .=  $key.' was empty. ';
                         }
                         else{
                               $string .= $key.' was '. $value.'. ';
                         }
                  }
              }

               $text1 = str_replace('_', ' ', $string);
             
               $activity->attributes1="{$text1}";   
           
    }
}
