<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Event extends Model
{
	  use LogsActivity;
	 protected static $logName = 'Event Detail';
     protected $fillable = ['title','start_date','end_date','google_id','description','create_user_id','update_user_id','flag'];
     protected static $logFillable = true;        
     protected static $logAttributes = ['*'];
     protected static $logAttributesToIgnore =['created_at','updated_at'];
     protected static $logOnlyDirty = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
    	 // $activity->attributes3 ="{$activity->subject_id}";
    	  $eventdetals=DB::table('events')->where('id',$activity->subject_id)->get();
    	  foreach ($eventdetals as $eventdetal) {
    	       $activity->attributes2="{$eventdetal->title}";
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
