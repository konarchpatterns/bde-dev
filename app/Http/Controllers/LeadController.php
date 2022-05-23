<?php

namespace App\Http\Controllers;
use App\lead;
use App\Company_Master;
use App\Company_address;
use App\Company_phone_number;
use App\Company_email_address;
use App\Client_Master;
use App\Client_phone_number;
use App\Client_email_address;
use App\User;
use DataTables;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Session;
use Redirect;
use Notification;
use App\Notifications\MyEventNotification;
use App\Notifications\AssignuserNotification;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Assignuser;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       
        return view('leads.viewleads.view');
    }

    public function anydata(){
        $q1=DB::raw("(SELECT GROUP_CONCAT(company_phone_numbers.company_phone,'(',company_phone_numbers.phone_type,')') FROM company_phone_numbers WHERE company_phone_numbers.company_id = company_masters.id and company_phone_numbers.deleted=0 GROUP BY company_masters.id ) as company_phone_no");
          $q2=DB::raw("(SELECT GROUP_CONCAT(company_email_addresses.company_email,'(',company_email_addresses.email_type,')') FROM company_email_addresses WHERE company_email_addresses.company_id = company_masters.id and company_email_addresses.deleted=0  GROUP BY company_masters.id ) as company_email_add");

          $rolelevel=Role::where('slug','bde')->pluck('level');
   if (Auth::user()->level() >= $rolelevel[0]){
   
      $data =DB::table('company_masters')
          ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          ->join('leads','company_masters.id','=','leads.company_id')
          ->join('company_addresses','company_addresses.company_id','=','company_masters.id')
          ->join('users','users.id','=','company_masters.user_assign_id')
          ->select('company_masters.id','company_masters.lead_id','leads.status','company_masters.company_name','company_masters.website_address','users.name','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by',$q1,$q2)->where('converted','not converted')
          ->distinct()->groupBy('company_masters.id','company_masters.lead_id','leads.status','company_masters.company_name','company_masters.website_address','company_masters.industry','users.name','company_masters.type_business','company_phone_numbers.company_phone','company_email_addresses.company_email','company_addresses.state','company_addresses.Country','company_masters.assign_by');

        // $data =DB::table('leads')
        //   ->join('users','users.id','=','leads.userassign_id')
        //   ->join('company_masters','company_masters.id','=','leads.company_id')
        //   ->select('leads.id','company_masters.company_name','company_masters.website_address','leads.status','leads.created_at','users.name')
        //   ->distinct()->groupBy('leads.id','company_masters.company_name','company_masters.website_address','leads.status','leads.created_at','users.name');

    }
    else{
        $data=DB::table('company_masters')
          ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          ->join('leads','company_masters.id','=','leads.company_id')
          ->join('company_addresses','company_addresses.company_id','=','company_masters.id')
          ->join('users','users.id','=','company_masters.user_assign_id')
          ->select('company_masters.id','company_masters.lead_id','leads.status','company_masters.company_name','company_masters.website_address','users.name','company_masters.industry','company_masters.type_business','company_addresses.Country','company_addresses.state','company_masters.assign_by',$q1,$q2)->where('converted','not converted')
          ->distinct()->groupBy('company_masters.id','company_masters.lead_id','leads.status','company_masters.company_name','company_masters.website_address','company_masters.industry','users.name','company_masters.type_business','company_phone_numbers.company_phone','company_email_addresses.company_email','company_addresses.state','company_addresses.Country','company_masters.assign_by')->where('company_masters.user_assign_id',Auth()->user()->id)->orWhere('company_masters.created_user_id',Auth()->user()->id);



       // $data =DB::table('leads')
       //    ->join('users','users.id','=','leads.userassign_id')
       //    ->join('company_masters','company_masters.id','=','leads.company_id')
       //    ->select('leads.id','company_masters.company_name','company_masters.website_address','leads.status','leads.created_at','users.name')
       //    ->distinct()->groupBy('leads.id','company_masters.company_name','company_masters.website_address','leads.status','leads.created_at','users.name')->where('leads.userassign_id',Auth()->user()->id);
    }      
         return Datatables::of($data)
         ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                    $btn="<input type='checkbox'  id='checkboxid[]' value='{$checkboxvalue}' name='checkbox[]'>";            
                     return $btn;
           })
         ->addColumn('companyname',function($data){
                $name=$data->company_name;
                if($name == " " || $name== NULL){
                  $name="Null";
                }
                $edit= route('lead.show',['id'=> $data->lead_id,'backto'=>"index"]);
                $btn="<a href='{$edit}'>{$name}</a>";        
                     return $btn;
           }) 
         ->escapeColumns([])  
         ->make(true);


    }

    public function tableedit($id){


        // $leaddatas = lead::find($id);
        // foreach ($leaddatas->lead_company_address as $company_address_data) {
        //           //dd($company_address_data->street_name);
        //       }
        //       //dd($company_address_data->street_name);
        // foreach($leaddatas->lead_client_detail as $client_data){

        // }


        // $phonearray=$leaddatas->lead_client_phone;
        // $emailarray=$leaddatas->lead_client_email;
        // //dd(count($phonearray));
        // //dd($phonearray[0]->mobile_number);
        // foreach($leaddatas->company_master_lead as $company_data){

        // }

     
        
        // foreach($leaddatas->company_phone_lead as $company_number){

        // }
      
      
        // return view('leads.editlead.view',['leaddatas'=>$leaddatas,'company_address_data'=>$company_address_data,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'company_number'=>$company_number]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users=User::all();
      $rolelevel=Role::where('slug','admin')->pluck('level');
      if (Auth::user()->level() >= $rolelevel[0]){

        return view('leads.adminaddlead.view',compact('users'));
      }
      else{
        return view('leads.addlead.view',compact('users'));
      }
    }

    public function import(Request $request){

      
    }
    public function store(Request $request)
    {
      $b=0;
       $v = Validator::make($request->all(), [
        'companyemail.*'=>'unique:company_email_addresses,company_email,null,null,deleted,'.$b,
        'companyclient_phone.*'=>'unique:company_phone_numbers,company_phone,null,null,deleted,'.$b,
        'email.*.*'=>'unique:client_email_addresses,client_email,null,null,deleted,'.$b,
        'client_phone.*.*'=>'unique:client_phone_numbers,client_phone,null,null,deleted,'.$b
       ]);
 
      if( $v->fails()){
           return Redirect::back()->withErrors($v);
      }
  if($request->company_name != ""){
    $companynames=Company_Master::where('company_name',$request->company_name)->get();
  }
  else{
     $companynames=Company_Master::where('company_name',"hkhkh65vh")->get();
  }
      if(count($companynames)>0){
          foreach($companynames as $companyname){}
             $leaddata1=$companyname->lead_id;
              //Add client data
            $clientcount=$request->lastvalue;
           for($i=0;$i<=$clientcount;$i++){
            if(isset($request->salutation_name[$i])){
             $clientdata=new Client_Master;
             $clientdata->client_name= $request->salutation_name[$i]." ". $request->client_first_name[$i]." ".$request->client_last_name[$i];
             $clientdata->salutation_name= $request->salutation_name[$i];
             $clientdata->client_first_name= $request->client_first_name[$i];
             $clientdata->client_last_name= $request->client_last_name[$i];
             $clientdata->linkedin_url= $request->linkedin_url[$i];
             $clientdata->client_designation= $request->client_designation[$i];
             $clientdata->company_id=$companyname->id;
             $clientdata->clientconverted="not converted";
             $clientdata->lead_id=$companyname->lead_id;
             $clientdata->save();
                 
           //client phone
             $mcp=0;
             $mcl=0;
             for($j=0; $j < 15; $j++){
                if(isset($request->client_phone[$i][$j]))
                 {
                    $clientnumber=new Client_phone_number;
                    $clientnumber->client_phone=$request->client_phone[$i][$j];
                   if($request->phone_type[$i] == 'Mobile'){
                     $mcp++;
                     $clientnumber->phone_type=$request->phone_type[$i][$j].$mcp;
                   }
                   else{
                      $mcl++;
                      $clientnumber->phone_type=$request->phone_type[$i][$j].$mcl;
                   }
                    $clientnumber->client_id=$clientdata->id;
                    $clientnumber->save();  
                } 
             }
             
           //client email
              $ecw=0;
              $ech=0;
              for($j=0; $j < 15; $j++){
               if(isset($request->email[$i][$j])){
                $clientemail=new Client_email_address;
                    $clientemail->client_email=$request->email[$i][$j];
                   if($request->email_type[$i][$j] == "Work"){
                    $ecw++;
                    $clientemail->email_type=$request->email_type[$i][$j].$ecw;
                   }
                   else{
                    $ech++;
                    $clientemail->email_type=$request->email_type[$i][$j].$ech;
                   }
                    $clientemail->client_id=$clientdata->id;
                    $clientemail->save(); 
                }    
             }        
          }
        }

      }
      else{  
    //company data
        $companydata= new Company_Master;
        $companydata->company_name=$request->company_name;
        $companydata->website_address=$request->website_address;
        $companydata->vendor_type=$request->vendor_type;
        $companydata->industry=$request->industry;
        $companydata->type_business=$request->type_business;
        $companydata->lead_description=$request->lead_description;
        $companydata->user_assign_id=$request->assignto;
        $companydata->assign_by=Auth()->user()->name;
        $companydata->created_user_id=Auth()->user()->id;
        $companydata->lead_id="not assign";
        $companydata->converted='not converted';
        $companydata->save(); 

    //lead data 
       $leaddata = new lead;
       $leaddata->company_id=$companydata->id;
       $leaddata->status= $request->status;
       $leaddata->source= $request->lead_source;
       $leaddata->opportunity_amount= $request->opportunity_amount;
       $leaddata->followup_date_time= $request->followup_date_time;
       $leaddata->userassign_id=$request->assignto;
       $leaddata->discription=$request->lead_description;
       $leaddata->usercreated_id=Auth()->user()->id;
       $leaddata->leadprovideby=$request->leadprovidedby;
       if (strpos($leaddata->leaddepatment, 'Custom') !== false) {
                 
                  $leaddata->customdetail=""; 
       }
       else{
        $leaddata->customdetail=$request->customdetail;
                 
       }
    if($request->leaddepatment != ""){
         $leaddata->leaddepatment=implode(',', $request->leaddepatment);
    }
    else{
        $leaddata->leaddepatment=$request->leaddepatment;
    }     
       $leaddata->customdetail=$request->customdetail;  
       $leaddata->save();
       $leaddata1=$leaddata->id;
    // Assign leadid to company
       $assignleadid=Company_Master::find($companydata->id);
       $assignleadid->lead_id=$leaddata->id;
       $assignleadid->update();
       // Assigned lead to user
       if($request->assignto != ""){

         

          $userassign=new Assignuser;
          $userassign->company_id=$companydata->id;
          $userassign->user_id=$request->assignto;
          $userassign->assign_by=Auth()->user()->id;
          $userassign->unassign="assign";
          $userassign->save();

       }

    //company address data 
       $companyaddress=new Company_address;
        $companyaddress->street_name=$request->street_name;
        $companyaddress->house_no=$request->house_no;
        $companyaddress->address_line_2=$request->address_line_2;
        if(isset($request->other_state)) {
          $companyaddress->state=$request->other_state;
        }
        else{
            $companyaddress->state=$request->State;
        }
        if(isset($request->other_county)) {
          $companyaddress->County=$request->other_county;
        }
        else{
             $companyaddress->County=$request->County;
        }
        if(isset($request->other_timezone)){
          $companyaddress->time_zone=$request->other_timezone;
        }
        else{
          $companyaddress->time_zone=$request->time_zone;
        }
        $companyaddress->Country=$request->Country;
        $companyaddress->zip_code=$request->zip_code;
        $companyaddress->fax_no=$request->fax_no;
        $companyaddress->type_business=$request->type_business;
        $companyaddress->company_id=$companydata->id;
        $companyaddress->save();

     
     
      //company phone
        $mp=0;
        $ml=0;
        $companyphonecount=count($request->companyclient_phone);
        for($i=0; $i < $companyphonecount; $i++){
          if(isset($request->companyclient_phone[$i])){
              $phonenumber=new Company_phone_number;
              $phonenumber->company_phone=$request->companyclient_phone[$i];
             if($request->company_phone_type[$i] == 'Mobile'){
              $mp++; 
              $phonenumber->phone_type=$request->company_phone_type[$i].$mp;
             }
             else{
              $ml++; 
              $phonenumber->phone_type=$request->company_phone_type[$i].$ml;
             }
              $phonenumber->company_id=$companydata->id;
              $phonenumber->save();
          }    
        }

      //company email
        $companyemailcount=count($request->companyemail);
        $ew=0;
        $eo=0;
        for($i=0; $i < $companyemailcount; $i++){
          if(isset($request->companyemail[$i])){  
              $companyemail=new Company_email_address;
              $companyemail->company_email=$request->companyemail[$i];
             if($request->company_email_type[$i] == 'Work'){
               $ew++;
               $companyemail->email_type=$request->company_email_type[$i].$ew;
             }
             else{
                $eo++;
                $companyemail->email_type=$request->company_email_type[$i].$eo;
             }
              $companyemail->company_id=$companydata->id;
              $companyemail->save();  
          }                           
        }

      //Add client data
        $clientcount=$request->lastvalue;
       for($i=0;$i<=$clientcount;$i++){
        if(isset($request->client_first_name[$i])){
         $clientdata=new Client_Master;
         $clientdata->client_name= $request->salutation_name[$i]." ". $request->client_first_name[$i]." ".$request->client_last_name[$i];
         $clientdata->salutation_name= $request->salutation_name[$i];
         $clientdata->client_first_name= $request->client_first_name[$i];
         $clientdata->client_last_name= $request->client_last_name[$i];
         $clientdata->linkedin_url= $request->linkedin_url[$i];
         $clientdata->client_designation= $request->client_designation[$i];
         $clientdata->company_id=$companydata->id;
         $clientdata->clientconverted="not converted";
         $clientdata->lead_id=$leaddata->id;
         $clientdata->save();
             
       //client phone
         $mcp=0;
         $mcl=0;
         for($j=0; $j < 15; $j++){
            if(isset($request->client_phone[$i][$j]))
             {
                $clientnumber=new Client_phone_number;
                $clientnumber->client_phone=$request->client_phone[$i][$j];
              if($request->phone_type[$i][$j] == 'Mobile'){
                $mcp++;
                $clientnumber->phone_type=$request->phone_type[$i][$j].$mcp;
              }
              else{
                $mcl++;
                $clientnumber->phone_type=$request->phone_type[$i][$j].$mcl;
              }
                $clientnumber->client_id=$clientdata->id;
                $clientnumber->save();  
            } 
         }
         
       //client email
          $ecw=0;
          $ech=0;
           for($j=0; $j < 15; $j++){
           if(isset($request->email[$i][$j])){
            $clientemail=new Client_email_address;
                $clientemail->client_email=$request->email[$i][$j];
               if($request->email_type[$i][$j] == "Work"){ 
                $ecw++;
                $clientemail->email_type=$request->email_type[$i][$j].$ecw;
               }
               else{
                $ech++;
                $clientemail->email_type=$request->email_type[$i][$j].$ech;
               }
                $clientemail->client_id=$clientdata->id;
                $clientemail->save(); 
            }    
         }        
      }
    }
     if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('lead.show',['id'=> $leaddata1,'backto'=>"index"]);
             $details = [
               'data' =>"<a href='{$link}'>{$companydata->company_name}</a> lead has been created by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
       }
     elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('lead.show',['id'=> $leaddata1,'backto'=>"index"]);
           $details = [
                  'data' =>"<a href='{$link}'>{$companydata->company_name}</a> lead has been created by ".auth()->user()->name.".",  
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
       }
  }
   

      return redirect()->route('lead.show', ['id' => $leaddata1,'backto'=>'index']);  
  }

  public function adminstore(Request $request)
    {
      $b=0;
       
  if($request->company_name != ""){
    $companynames=Company_Master::where('company_name',$request->company_name)->get();
  }
  else{
     $companynames=Company_Master::where('company_name',"hkhkh65vh")->get();
  }
      if(count($companynames)>0){
          foreach($companynames as $companyname){}
             $leaddata1=$companyname->lead_id;
              //Add client data
            $clientcount=$request->lastvalue;
           for($i=0;$i<=$clientcount;$i++){
            if(isset($request->salutation_name[$i])){
             $clientdata=new Client_Master;
             $clientdata->client_name= $request->salutation_name[$i]." ". $request->client_first_name[$i]." ".$request->client_last_name[$i];
             $clientdata->salutation_name= $request->salutation_name[$i];
             $clientdata->client_first_name= $request->client_first_name[$i];
             $clientdata->client_last_name= $request->client_last_name[$i];
             $clientdata->linkedin_url= $request->linkedin_url[$i];
             $clientdata->client_designation= $request->client_designation[$i];
             $clientdata->company_id=$companyname->id;
             $clientdata->clientconverted="not converted";
             $clientdata->lead_id=$companyname->lead_id;
             $clientdata->save();
                 
           //client phone
             $mcp=0;
             $mcl=0;
             for($j=0; $j < 15; $j++){
                if(isset($request->client_phone[$i][$j]))
                 {
                    $clientnumber=new Client_phone_number;
                    $clientnumber->client_phone=$request->client_phone[$i][$j];
                   if($request->phone_type[$i] == 'Mobile'){
                     $mcp++;
                     $clientnumber->phone_type=$request->phone_type[$i][$j].$mcp;
                   }
                   else{
                      $mcl++;
                      $clientnumber->phone_type=$request->phone_type[$i][$j].$mcl;
                   }
                    $clientnumber->client_id=$clientdata->id;
                    $clientnumber->save();  
                } 
             }
             
           //client email
              $ecw=0;
              $ech=0;
              for($j=0; $j < 15; $j++){
               if(isset($request->email[$i][$j])){
                $clientemail=new Client_email_address;
                    $clientemail->client_email=$request->email[$i][$j];
                   if($request->email_type[$i][$j] == "Work"){
                    $ecw++;
                    $clientemail->email_type=$request->email_type[$i][$j].$ecw;
                   }
                   else{
                    $ech++;
                    $clientemail->email_type=$request->email_type[$i][$j].$ech;
                   }
                    $clientemail->client_id=$clientdata->id;
                    $clientemail->save(); 
                }    
             }        
          }
        }

      }
      else{  
      //company data
        $companydata= new Company_Master;
        $companydata->company_name=$request->company_name;
        $companydata->website_address=$request->website_address;
        $companydata->vendor_type=$request->vendor_type;
        $companydata->industry=$request->industry;
        $companydata->type_business=$request->type_business;
        $companydata->lead_description=$request->lead_description;
        $companydata->user_assign_id=$request->assignto;
        $companydata->assign_by=Auth()->user()->name;
        $companydata->created_user_id=Auth()->user()->id;
        $companydata->lead_id="not assign";
        $companydata->converted='not converted';
        $companydata->save(); 

    //lead data 
       $leaddata = new lead;
       $leaddata->company_id=$companydata->id;
       $leaddata->status= $request->status;
       $leaddata->source= $request->lead_source;
       $leaddata->opportunity_amount= $request->opportunity_amount;
       $leaddata->followup_date_time= $request->followup_date_time;
       $leaddata->userassign_id=$request->assignto;
       $leaddata->discription=$request->lead_description;
       $leaddata->usercreated_id=Auth()->user()->id;
       $leaddata->leadprovideby=$request->leadprovidedby; 
       if (strpos($leaddata->leaddepatment, 'Custom') !== false) {
                 
                  $leaddata->customdetail=""; 
       }
       else{
        $leaddata->customdetail=$request->customdetail;
                 
       }
    if($request->leaddepatment != ""){
         $leaddata->leaddepatment=implode(',', $request->leaddepatment);
    }
    else{
        $leaddata->leaddepatment=$request->leaddepatment;
    } 
       
       $leaddata->save();
       $leaddata1=$leaddata->id;
    // Assigned lead to user
       if($request->assignto != ""){

         

          $userassign=new Assignuser;
          $userassign->company_id=$companydata->id;
          $userassign->user_id=$request->assignto;
          $userassign->assign_by=Auth()->user()->id;
          $userassign->unassign="assign";
          $userassign->save();

       }
    // Assign leadid to company
       $assignleadid=Company_Master::find($companydata->id);
       $assignleadid->lead_id=$leaddata->id;
       $assignleadid->update();

    //company address data 
       $companyaddress=new Company_address;
        $companyaddress->street_name=$request->street_name;
        $companyaddress->house_no=$request->house_no;
        $companyaddress->address_line_2=$request->address_line_2;
        if(isset($request->other_state)) {
          $companyaddress->state=$request->other_state;
        }
        else{
            $companyaddress->state=$request->State;
        }
        if(isset($request->other_county)) {
          $companyaddress->County=$request->other_county;
        }
        else{
             $companyaddress->County=$request->County;
        }
        if(isset($request->other_timezone)){
          $companyaddress->time_zone=$request->other_timezone;
        }
        else{
          $companyaddress->time_zone=$request->time_zone;
        }
        $companyaddress->Country=$request->Country;
        $companyaddress->zip_code=$request->zip_code;
        $companyaddress->fax_no=$request->fax_no;
        $companyaddress->type_business=$request->type_business;
        $companyaddress->company_id=$companydata->id;
        $companyaddress->save();

     
     
      //company phone
        $mp=0;
        $ml=0;
        $companyphonecount=count($request->companyclient_phone);
        for($i=0; $i < $companyphonecount; $i++){
          if(isset($request->companyclient_phone[$i])){
              $phonenumber=new Company_phone_number;
              $phonenumber->company_phone=$request->companyclient_phone[$i];
             if($request->company_phone_type[$i] == 'Mobile'){
              $mp++; 
              $phonenumber->phone_type=$request->company_phone_type[$i].$mp;
             }
             else{
              $ml++; 
              $phonenumber->phone_type=$request->company_phone_type[$i].$ml;
             }
              $phonenumber->company_id=$companydata->id;
              $phonenumber->save();
          }    
        }

      //company email
        $companyemailcount=count($request->companyemail);
        $ew=0;
        $eo=0;
        for($i=0; $i < $companyemailcount; $i++){
          if(isset($request->companyemail[$i])){  
              $companyemail=new Company_email_address;
              $companyemail->company_email=$request->companyemail[$i];
             if($request->company_email_type[$i] == 'Work'){
               $ew++;
               $companyemail->email_type=$request->company_email_type[$i].$ew;
             }
             else{
                $eo++;
                $companyemail->email_type=$request->company_email_type[$i].$eo;
             }
              $companyemail->company_id=$companydata->id;
              $companyemail->save();  
          }                           
        }

      //Add client data
        $clientcount=$request->lastvalue;
       for($i=0;$i<=$clientcount;$i++){
        if(isset($request->client_first_name[$i])){
         $clientdata=new Client_Master;
         $clientdata->client_name= $request->salutation_name[$i]." ". $request->client_first_name[$i]." ".$request->client_last_name[$i];
         $clientdata->salutation_name= $request->salutation_name[$i];
         $clientdata->client_first_name= $request->client_first_name[$i];
         $clientdata->client_last_name= $request->client_last_name[$i];
         $clientdata->linkedin_url= $request->linkedin_url[$i];
         $clientdata->client_designation= $request->client_designation[$i];
         $clientdata->company_id=$companydata->id;
         $clientdata->clientconverted="not converted";
         $clientdata->lead_id=$leaddata->id;
         $clientdata->save();
             
       //client phone
         $mcp=0;
         $mcl=0;
         for($j=0; $j < 15; $j++){
            if(isset($request->client_phone[$i][$j]))
             {
                $clientnumber=new Client_phone_number;
                $clientnumber->client_phone=$request->client_phone[$i][$j];
              if($request->phone_type[$i][$j] == 'Mobile'){
                $mcp++;
                $clientnumber->phone_type=$request->phone_type[$i][$j].$mcp;
              }
              else{
                $mcl++;
                $clientnumber->phone_type=$request->phone_type[$i][$j].$mcl;
              }
                $clientnumber->client_id=$clientdata->id;
                $clientnumber->save();  
            } 
         }
         
       //client email
          $ecw=0;
          $ech=0;
           for($j=0; $j < 15; $j++){
           if(isset($request->email[$i][$j])){
            $clientemail=new Client_email_address;
                $clientemail->client_email=$request->email[$i][$j];
               if($request->email_type[$i][$j] == "Work"){ 
                $ecw++;
                $clientemail->email_type=$request->email_type[$i][$j].$ecw;
               }
               else{
                $ech++;
                $clientemail->email_type=$request->email_type[$i][$j].$ech;
               }
                $clientemail->client_id=$clientdata->id;
                $clientemail->save(); 
            }    
         }        
      }
    }
     if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('lead.show',['id'=> $leaddata1,'backto'=>"index"]);
             $details = [
               'data' =>"<a href='{$link}'>{$companydata->company_name}</a> lead has been created by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
       }
     elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('lead.show',['id'=> $leaddata1,'backto'=>"index"]);
           $details = [
                  'data' =>"<a href='{$link}'>{$companydata->company_name}</a> lead has been created by ".auth()->user()->name.".",  
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
       }
  }
   

      return redirect()->route('lead.show', ['id' => $leaddata1,'backto'=>'index']);  
  }

    public function show($id,$backto)
    {
      $leaddata=lead::findorfail($id);
      $companydatas=Company_Master::where('lead_id',$id)->get();
      foreach ($companydatas as $companydata) {
      
      }
      $rolelevel=Role::where('slug','bde')->pluck('level');
      if( Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companydata->user_assign_id ||  auth()->user()->id == $companydata->created_user_id)
      {  
        
        $companyaddresses=Company_address::where('company_id',$companydata->id)->get();
        foreach ($companyaddresses as $companyaddress) {
          
        }
        $companyphones=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();

        $companyemails=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();
        
        return view('leads.showlead.view',['leaddata'=>$leaddata,'companydata'=>$companydata,'companyphones'=>$companyphones,'companyemails'=>$companyemails,'companyaddress'=>$companyaddress,'backto'=>$backto]);
      }
      else{
        return view('error.403');
      }
        
    }

  public function edit($id,$backto)
  {
     $leaddata=lead::findorfail($id);

        $companydatas=Company_Master::where('lead_id',$id)->get();
        foreach ($companydatas as $companydata) {
          
        }
    $rolelevel=Role::where('slug','bde')->pluck('level');
    if( Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companydata->user_assign_id ||  auth()->user()->id == $companydata->created_user_id)
    {  
        $username=User::find($leaddata->userassign_id);

        $companyaddresses=Company_address::where('company_id',$companydata->id)->get();
        foreach ($companyaddresses as $companyaddress) {
          
        }

        $companyphones=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();

        $companyemails=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();
       
        $departmentarray=['Graphics','Data','Operations','Custom'];

      
        return view('leads.editlead.view',['leaddata'=>$leaddata,'companydata'=>$companydata,'companyphones'=>$companyphones,'companyemails'=>$companyemails,'companyaddress'=>$companyaddress,'username'=>$username,'departmentarray'=>$departmentarray,'backto'=>$backto]);
    }
    else{
        return view('error.403');
    }
  }

    public function update(Request $request)
    {
      
        $leaddata=lead::findorfail($request->id);
      if(auth()->user()->hasPermission('edit.lead.status')){  
        $leaddata->status=$request->status;
      }
      if(auth()->user()->hasPermission('edit.lead.source')){  
        $leaddata->source=$request->source;
      }
      if(auth()->user()->hasPermission('edit.lead.amount')){  
        $leaddata->opportunity_amount=$request->opportunity_amount;
      }
      if(auth()->user()->hasPermission('edit.lead.followup.date')){  
        $leaddata->followup_date_time=$request->followup_date_time;
      }
      if(auth()->user()->hasPermission('edit.lead.description')){  
        $leaddata->discription=$request->lead_description;
      }

       if (strpos($leaddata->leaddepatment, 'Custom') !== false) {
                 
                  $leaddata->customdetail=""; 
       }
       else{
        $leaddata->customdetail=$request->customdetail;
                 
       }
      if($request->leaddepatment != ""){
         $leaddata->leaddepatment=implode(',', $request->leaddepatment);
    }
    else{
        $leaddata->leaddepatment=$request->leaddepatment;
    }
   
     
        $leaddata->update();

     
      $companydata=Company_Master::find($leaddata->company_id);
        
      if(auth()->user()->hasPermission('edit.lead.name')){  
        $companydata->company_name=$request->company_name;
      }
      if(auth()->user()->hasPermission('edit.lead.website')){  
        $companydata->website_address=$request->website_address;
      }
      if(auth()->user()->hasPermission('edit.lead.vendor.type')){
        $companydata->vendor_type=$request->vendor_type;
      }
     
      if(auth()->user()->hasPermission('edit.lead.business.type')){
        $companydata->type_business=$request->type_business;
      }
      if(auth()->user()->hasPermission('edit.lead.description')){
        $companydata->lead_description=$request->lead_description;
      }
   
        $companydata->update();

         //update address data
      
        $companyaddresses=$companydata->CompanyAddress;
      
      $update_company_address=Company_address::find($companyaddresses->id);
      if(auth()->user()->hasPermission('edit.lead.address')){
         $update_company_address->house_no=$request->house_no;
         $update_company_address->street_name=$request->street_name;
         $update_company_address->address_line_2=$request->address_line_2;
         $update_company_address->Country=$request->Country;
         if(isset($request->other_state)) {
              $update_company_address->state=$request->other_state;
         }
         else{
              $update_company_address->state=$request->State;
         }
         if(isset($request->other_county)) {
              $update_company_address->County=$request->other_county;
         }
         else{
              $update_company_address->County=$request->County;
         } 
         if(isset($request->other_timezone)){
              $update_company_address->time_zone=$request->other_timezone;
         }
         else{
              $update_company_address->time_zone=$request->time_zone;
         }
         $update_company_address->zip_code=$request->zip_code;
      }
      if(auth()->user()->hasPermission('edit.lead.fax')){
         $update_company_address->fax_no=$request->fax_no;
      }
         $update_company_address->update();


         //update company phno
      if(auth()->user()->hasPermission('edit.lead.phone')){
         $phonearray=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();
         $phoneidarray=[];
           foreach($phonearray as $phone_data)
           {
                      $phone_id=$phone_data->id;
                      $ids=$phone_id;
                      $phoneidarray[]=$ids;
           }       
           $phonecount=count($phonearray);       
           for($i=0; $i < $phonecount; $i++)
           {
                $id=$phoneidarray[$i];
                $update_phone=Company_phone_number::find($id);
                $update_phone->company_phone=$request->companyclient_phone[$i];
                $update_phone->phone_type=$request->company_phone_type[$i];
                $update_phone->update();

               //$update_phone=Company_phone_number::where('id',$id)->update(['company_phone'=>$request->companyclient_phone[$i]]);   
           }
        

          //add new company number
    
           $newphonecount=count($request->companyclient_phone);
            for($i=$phonecount; $i < $newphonecount; $i++){
              if(isset($request->companyclient_phone[$i])){
                $companynumber=new Company_phone_number;
                $companynumber->company_phone=$request->companyclient_phone[$i];
                $companynumber->phone_type=$request->company_phone_type[$i];
                $companynumber->company_id=$companydata->id;
                $companynumber->save();
              }
            }
      } 

            //update comapany email
      if(auth()->user()->hasPermission('edit.lead.email')){
            $emailarray=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();
                $emailidarray=[];
                foreach($emailarray as $email_data)
                {
                      $email_id=$email_data->id;
                      $ids=$email_id;
                      $emailidarray[]=$ids;

                }

            $emailcount=count($emailarray);
            for($i=0; $i < $emailcount; $i++)
            {   
              $id= $emailidarray[$i];
              $update_email=Company_email_address::find($id);
              $update_email->company_email=$request->companyemail[$i];  
              $update_email->email_type=$request->company_email_type[$i];
              $update_email->update(); 
            }
      
            // add new company email
     
            $newemailcount=count($request->companyemail);
            for($i=$emailcount; $i < $newemailcount; $i++){
              if(isset($request->companyemail[$i])){
                $comemail=new Company_email_address;
                $comemail->company_email=$request->companyemail[$i];
                $comemail->email_type=$request->company_email_type[$i];
                $comemail->company_id=$companydata->id;
                $comemail->save();   
              }        
            } 
      }   
        return redirect()->route('lead.show',['id'=>$leaddata->id,'backto'=>$request->backto]);
     

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(lead $lead)
    {
        //
    }


    public function phonedelete($id){
       
       //$id=Phone_no_client::find($id)->delete();delete only pivot table data according to Espo crm
       $pivote=Lead_Client_Phone::where('client_phone_id',$id)->delete();
       return  response()->json(['data'=>$pivote]);
    }

    public function emaildelete($id){
      //$info=Email_Address::find($id)->delete();delete only pivot table data according to Espo crm
      $pivote=Email_Lead::where('email_id',$id)->delete();

      return  response()->json(['data'=>$pivote]);
    }

    public function companylog($id){

       $data =DB::table('activity_log')
        ->join('users','activity_log.causer_id','=','users.id')
        ->select('activity_log.id','activity_log.log_name','activity_log.subject_id','activity_log.subject_type','activity_log.attributes1','activity_log.attributes2','users.name','activity_log.description','activity_log.created_at')->where('attributes4',$id);
         
         return Datatables::of($data)
               
         ->escapeColumns([])  
         ->make(true);
    }
}
