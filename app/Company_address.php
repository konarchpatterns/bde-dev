<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Contracts\Activity;
class Company_address extends Model
{
	  use LogsActivity;
     protected static $logName = 'Company Address';
   protected $table ='company_addresses';
     protected $fillable = [
        'company_id','house_no','street_name','address_line_2','County','state','zip_code','Country','time_zone','fax_no','type_business','link_address','dammy',
    ];
    protected static $logFillable = true;        
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at','updated_at'];
    protected static $logOnlyDirty = true;
 
    public function tapActivity(Activity $activity, string $eventName)
    {
    	 $companyids=DB::table('company_addresses')->where('id', $activity->subject_id)->get();
         foreach ($companyids as $companyid){
              $activity->attributes3 ="{$companyid->company_id}";
               $activity->attributes4="{$companyid->company_id}";
              $companyids1=DB::table('company_masters')->select('company_name')->where('id',$companyid->company_id)->get();
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
                                  $string .=  $key.' was empty. ';
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
  
}
