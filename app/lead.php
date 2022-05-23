<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Support\Facades\DB;
class lead extends Model
{
    use LogsActivity;
     protected static $logName = 'Company Lead';
    protected $table = 'leads';
       protected $fillable = [
         'company_id','userassign_id','usercreated_id','status','source','opportunity_amount','followup_date_time','discription','disposition','leaddepatment','customdetail'
    ];
    protected static $logFillable = true;        

    protected static $logAttributes = ['*'];
     protected static $logAttributesToIgnore = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
    	 $companyids=DB::table('leads')->where('id', $activity->subject_id)->get();
         foreach ($companyids as $companyid){
              $activity->attributes3 ="{$companyid->company_id}";
              $companyids1=DB::table('company_masters')->select('company_name')->where('id',$companyid->company_id)->get();
              foreach ($companyids1 as $companyid1){
                 $activity->attributes2="{$companyid1->company_name}";
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
	