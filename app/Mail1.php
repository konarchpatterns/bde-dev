<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class Mail1 extends Model
{
	 use LogsActivity;
	 protected static $logName = 'Mail Detail';
     protected $table = 'emails';
      protected $fillable = [
         'from','to','subject','body','created_user_id','send_by','flag','created_at','updated_at'
    ];
    protected static $logFillable = true;        

    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
    	 // $activity->attributes3 ="{$activity->subject_id}";
    	  $maildetals=DB::table('emails')->where('id',$activity->subject_id)->get();
    	  foreach ($maildetals as $maildetal) {
    	       $activity->attributes2="{$maildetal->subject}";
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
