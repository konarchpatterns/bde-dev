<?php

namespace App\Http\Controllers;

use App\Client_Master;
use App\Client_email_address;
use App\Client_phone_number;
use App\lead;
use App\Lead_Client_Phone;
use App\Company_Address;
use App\Client_Company_Address;
use App\Phone_no_client;
use App\Client_Phone_Client;
use App\Email_Address;
use App\Email_Client;
use App\Company_Master;
use Carbon\Carbon;
use App\Company_disposition;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use Spatie\Activitylog\Models\Activity;
use DataTables;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Notification;
use App\Notifications\MyEventNotification;
use jeremykenedy\LaravelRoles\Models\Role;

class ClientMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        // activity()->disableLogging();
        // $companydatas=Company_Master::all();
        // foreach ($companydatas as $companydata) {
        //   $inserttime=Company_Master::find($companydata->id);
        //   $companydate=Carbon::createFromFormat('Y-m-d H:i:s', $companydata->created_at, 'UTC')->setTimezone('America/Los_Angeles');
        //   $inserttime->created_atus=$companydate;
        //   $inserttime->save();

        // }
        // activity()->enableLogging();
        
        
       
            
    }
    public function index()
    {    
       // $clientfullname=Client_Master::where('clientconverted','converted')->get();
       // foreach ($clientfullname as $name) {
       //  $change=Client_Master::where('id',$name->id)->update(['client_name'=>$name->salutation_name." ".$name->client_first_name." ".$name->client_last_name]);
       // }
   
        return view('clients.viewclients.view');
    }
    public function anydata()
    {
        
      // $q1=DB::raw("(SELECT GROUP_CONCAT(client_phone_numbers.client_phone,'(',client_phone_numbers.phone_type,')' ORDER BY client_phone_numbers.id) FROM client_phone_numbers WHERE client_phone_numbers.client_id = client_masters.id and client_phone_numbers.deleted= 0 GROUP BY client_masters.id) as client_phone_no");
     
      // $q2=DB::raw("(SELECT GROUP_CONCAT(client_email_addresses.client_email,'(',client_email_addresses.email_type,')' ORDER BY client_email_addresses.id) FROM client_email_addresses WHERE client_email_addresses.client_id = client_masters.id  and client_email_addresses.deleted= 0 GROUP BY client_masters.id ) as client_email_add");
    $rolelevel=Role::where('slug','bde')->pluck('level');
    if (Auth::user()->level() >= $rolelevel[0]){
      $data =DB::table('client_masters')
       // ->leftJoin('client_email_addresses','client_masters.id','=','client_email_addresses.client_id')
       //   ->select('company_address_company_master.*')
       // ->leftJoin('client_phone_numbers','client_masters.id','=','client_phone_numbers.client_id')
        ->leftjoin('company_masters','client_masters.company_id','=','company_masters.id')
        ->select('client_masters.id','client_masters.client_name','client_masters.client_designation','company_masters.company_name','client_masters.clientlastdisposition')->where('client_masters.deleted',0)
        ->distinct()->groupBy('client_masters.id','client_masters.client_name','client_masters.client_designation','company_masters.company_name','client_masters.clientlastdisposition'
      );
    }
    else{
        $data =DB::table('client_masters')
       // ->leftJoin('client_email_addresses','client_masters.id','=','client_email_addresses.client_id')
        // ->select('company_address_company_master.*')
      //  ->leftJoin('client_phone_numbers','client_masters.id','=','client_phone_numbers.client_id')
        ->join('company_masters','client_masters.company_id','=','company_masters.id')
        ->select('client_masters.id','client_masters.client_name','client_masters.client_designation','company_masters.company_name','client_masters.clientlastdisposition')->where([['client_masters.deleted',0],['company_masters.user_assign_id',auth()->user()->id]])
        ->distinct()->groupBy('client_masters.id','client_masters.client_name','client_masters.client_designation','company_masters.company_name','client_masters.clientlastdisposition');
    }

          return Datatables::of($data)
           ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                $btn="<input type='checkbox'  id='checkboxid[]' value='{$checkboxvalue}'>";
                     return $btn;
           }) 
           ->addColumn('name',function($data){
                 $edit= route('client.show',['id'=> $data->id,'backto'=>"normal"]);
                 $clientname=$data->client_name;
                      $btn="<a href='{$edit}'>{$clientname}</a>";
                     return $btn;
           }) 
           ->addColumn('client_phone_no' , function($data){
                     //dd($data->id);

                $result  =  DB::table('client_phone_numbers')->select('client_phone', 'phone_type')
                ->where('client_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($q1);

                $client_phone_no='';

                 foreach ($result as $key => $value) {
                        $client_phone_no .=  $value->client_phone .'(' . $value->phone_type .')'  .',';
                 }

                  return substr($client_phone_no, 0, -1);

                //  dd($client_phone_no);

                 // return $client_phone_no;
           })
            ->addColumn('client_email_add' , function($data){
                    
                   $result  =  DB::table('client_email_addresses')->select('client_email', 'email_type')
                ->where('client_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($q1);
                $client_email_add = '';

                 foreach ($result as $key => $value) {
                        $client_email_add.=  $value->client_email .'(' . $value->email_type .')' .',';
                 }

                    return  substr($client_email_add,0,-1);
           })
          // ->addColumn('name',function($data){
          //       $edit= route('client.show',['id'=> $data->id]);
          //       $salutation_name=$data->salutation_name;

          //       $fistname=$data->client_first_name;
          //       $lastname=$data->client_last_name;
          //            $btn="<a href='{$edit}'>{$salutation_name} {$fistname} {$lastname}</a>";
          //            return $btn;
          //  })
          ->escapeColumns([])  
          ->make(true);




        // $data =Client_Master::query();
        //  return Datatables::of($data)
        //  ->addColumn('checkbox',function($data){
        //         $checkboxvalue= $data->id;
        //              $btn="<input type='checkbox'  id='checkboxid[]' value='{$checkboxvalue}'>";
        //              return $btn;
        //    })
        //  ->addColumn('name',function($data){
        //         $edit= route('client.show',['id'=> $data->id]);
        //         $salutation_name=$data->salutation_name;
        //         $fistname=$data->client_first_name;
        //         $lastname=$data->client_last_name;
        //              $btn="<a href='{$edit}'>{$salutation_name} {$fistname} {$lastname}</a>";
        //              return $btn;
        //    })
        //  ->addColumn('companyname',function($data){
        //            $id = $data->company_id;

        //            if($id == "" || $id== "no company"){
        //               $btn="No Company";
        //            }
        //            else{
        //              $name=Company_Master::query()->find($id);
        //              $btn=$name->company_name;  
        //            }
        //             return $btn;
        //    })
        //  ->addColumn('email',function($data){
        //              // $clientdata=Client_Master::find($data->id);
        //             $emailarray=$data->client_email;
        //             foreach ($emailarray as $emailarra) {}
        //             $btn=$emailarra->email;
        //             return $btn;
        //    })
        //  ->addColumn('phone',function($data){
        //              // $clientdata=Client_Master::find($data->id);
        //             $phonearray=$data->client_phone_client;
        //             foreach ($phonearray as $phonearra) {}
        //             $btn=$phonearra->mobile_number;
        //             return $btn;
        //    })

        //  ->escapeColumns([])  
        //  ->make(true);


    }
    
    
    
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      // dd(is_numeric($id));
      if(is_numeric($id)){
        $companydata=Company_Master::find($id);
        return view('clients.addclient.view',['companydata'=>$companydata]);
      }
      else{
         return view('clients.addclient.view');
      }  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
      $b=0;
      $v = Validator::make($request->all(), [
        'client_first_name.*' =>'required',
        'company_name' => 'required|exists:company_masters,company_name',
        'email.*'=>'unique:client_email_addresses,client_email,null,null,deleted,' .$b,
        'client_phone.*'=>'unique:client_phone_numbers,client_phone,null,null,deleted,' .$b
      
       ]);   
      if( $v->fails()){
              return Redirect::back()->withErrors($v)->withInput();

      }    
 
        $companyid=Company_Master::where('company_name',$request->company_name)->pluck('id');
      
        $clientdata=new Client_Master;
        $clientdata->salutation_name= $request->salutation_name;
        $clientdata->client_first_name= $request->client_first_name;
        $clientdata->client_last_name= $request->client_last_name;
        $clientdata->client_name=$request->salutation_name." ".$request->client_first_name." ".$request->client_last_name;
        $clientdata->linkedin_url= $request->linkedin_url;
        $clientdata->client_designation=$request->client_designation;
        $clientdata->company_id=$companyid[0];
        $clientdata->lead_description= $request->lead_description;
        $clientdata->save();
        

  //store client phone
    
        $phonecount=count($request->client_phone);
        $mp=0;
        $ml=0;
        for($i=0; $i < $phonecount; $i++){
         if(isset($request->client_phone[$i])){
            
            $clientnumber=new Client_phone_number;
                $clientnumber->client_phone=$request->client_phone[$i];
                if($request->phone_type[$i] == 'Mobile'){
                     $mp++;
                    $clientnumber->phone_type=$request->phone_type[$i].$mp;
                }
                else{
                     $ml++;
                    $clientnumber->phone_type=$request->phone_type[$i].$ml;
                }  
               
                $clientnumber->client_id=$clientdata->id;
                $clientnumber->save();
               
        }
      }

  //store client email
        
        $emailcount=count($request->email);
        $ew=0;
        $eh=0;
        for($i=0; $i < $emailcount; $i++){
          if(isset($request->email[$i])){
            $clientemail=new Client_email_address;
                $clientemail->client_email=$request->email[$i];
              if($request->email_type[$i] == "Work"){
                $ew++;
                $clientemail->email_type=$request->email_type[$i].$ew;
              }
              else{
                $eh++;
                $clientemail->email_type=$request->email_type[$i].$eh;
              
              }
                $clientemail->client_id=$clientdata->id;
                $clientemail->save(); 
          }
          
        }

       if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();

           $link= route('client.show',['id'=> $clientdata->id,'backto'=>"normal"]);
             $details = [
               'data' =>"<a href='{$link}'>{$clientdata->client_name}</a> client has been created by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
       }
       elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
            $link= route('client.show',['id'=> $clientdata->id,'backto'=>"normal"]);
           $details = [
                  'data' =>"<a href='{$link}'>{$clientdata->client_name}</a> client has been created by ".auth()->user()->name.".",
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
       }
       if(isset($request->company_id)){
           return redirect()->route('client.show', ['id' => $clientdata->id,'backto'=>"company"]);
       }
       else{
        return redirect()->route('client.show', ['id' => $clientdata->id,'backto'=>"normal"]);
       }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client_master  $client_master
     * @return \Illuminate\Http\Response
     */
    public function show($id,$backto)
    {

          $clientdata=Client_Master::find($id);
          //dd($clientdata->ClientEmail);
          // $phonearray=$clientdata->ClientPhone;
          // $emailarray=$clientdata->ClientEmail;
          $phonearray=Client_phone_number::where([['client_id',$id],['deleted',0]])->get();
    
          $emailarray=Client_email_address::where([['client_id',$id],['deleted',0]])->get();
          // $clientaddresses=$clientdata->client_company_address;
          $companydatas=Company_Master::where('id',$clientdata->company_id)->get();
          if(count($companydatas) == 0){
              $copmany_name="No company";
              $company_id="No companyid";
          }
          else{
          foreach($companydatas as $companydata){
               
           }
         }
         $users=User::where('id',$clientdata->user_assign_id)->get();
          if(count($users) == 0){
              $user_name="No User";
               $user_id="No userid";

          }
          else{
          foreach($users as $user){
                $user_name= $user->name;
                $user_id=$user->id;
           }
         }
        
         // foreach($clientaddresses as  $clientaddress){}
      $rolelevel=Role::where('slug','bde')->pluck('level');
      if( Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companydata->user_assign_id ||  auth()->user()->id == $companydata->created_user_id || Auth::user()->hasRole('data.entry.manager'))
      { 
         if(Auth::user()->hasRole('data.entry') || Auth::user()->hasRole('data.entry.manager') ){
           return view('companydataoperator.showclient.view',['clientdata'=>$clientdata,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'companydata'=>$companydata,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]);
         }
         else{
          return view('clients.showclient.view',['clientdata'=>$clientdata,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'companydata'=>$companydata,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]);
         }
      }
      else{
            return view('error.403');
      }

    }

    public function edit($id,$backto)
    {
        $clientdata=Client_Master::find($id);
        // $phonearray=$clientdata->ClientPhone;
        // $emailarray=$clientdata->ClientEmail;
        $phonearray=Client_phone_number::where([['client_id',$id],['deleted',0]])->get();
    
        $emailarray=Client_email_address::where([['client_id',$id],['deleted',0]])->get();

        $companynames=Company_Master::where('id',$clientdata->company_id)->get();
          if(count($companynames) == 0){
              $copmany_name="No company";
              $company_id="No companyid";
          }
          else{
          foreach($companynames as $companyname){
                $copmany_name= $companyname->company_name;
                $company_id=$companyname->id;
           }
         }
        $users=User::where('id',$clientdata->user_assign_id)->get();
          if(count($users) == 0){
              $user_name="No User";
               $user_id="No userid";

          }
          else{
          foreach($users as $user){
                $user_name= $user->name;
                $user_id=$user->id;
           }
         }
      $rolelevel=Role::where('slug','bde')->pluck('level');
      if( Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companyname->user_assign_id ||  auth()->user()->id == $companyname->created_user_id || Auth::user()->hasPermission('edit.client') || Auth::user()->hasRole('data.entry.manager'))
      {     
        if(Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
          return view('companydataoperator.editclient.view',['clientdata'=>$clientdata,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'copmany_name'=>$copmany_name,'company_id'=>$company_id,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]);
        }
        else{
         return view('clients.editclient.view',['clientdata'=>$clientdata,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'copmany_name'=>$copmany_name,'company_id'=>$company_id,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]);
        }
      }
      else{
            return view('error.403');
      }
    }

    public function update(Request $request)
    {
     // dd($request->all());
      $b=0;
      $v = Validator::make($request->all(), [
        'client_first_name' =>'required',
        'company_name' => 'required|exists:company_masters,company_name',
       ]);   
      if( $v->fails()){
              return Redirect::back()->withErrors($v)->withInput();

      }    
 
    
      $companyid=Company_Master::where('company_name',$request->company_name)->pluck('id');
        if(count($companyid) == 0){

          return back()->with('error','Company name not exist so client data not updated !');
        }
      else{
      $clientdata=Client_Master::find($request->id);

    if (auth()->user()->hasPermission('edit.client.name') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
     
      $clientdata->client_name=$request->salutation_name." ".$request->client_first_name." ".$request->client_last_name;
      $clientdata->salutation_name=$request->salutation_name;
      $clientdata->client_first_name=$request->client_first_name;
      $clientdata->client_last_name=$request->client_last_name;

    }
    if (auth()->user()->hasPermission('edit.client.designation') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){

      $clientdata->client_designation=$request->client_designation;
    }
    if (auth()->user()->hasPermission('edit.client.company.name') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){

      $clientdata->company_id=$companyid[0];
    }
    if (auth()->user()->hasPermission('edit.client.linkedin') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
      $clientdata->linkedin_url=$request->linkedin_url;
    }
    if (auth()->user()->hasPermission('edit.client.description') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
      $clientdata->lead_description=$request->lead_description;
    } 
      // $clientdata->user_assign_id=$request->user_assign_id;
      $clientdata->update();


      
    if (auth()->user()->hasPermission('edit.client.phone') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
      //update client phone
      $phonearray=Client_phone_number::where([['client_id',$request->id],['deleted',0]])->get();
    
        
       $phoneidarray=[];
       $phonetype_m=[];
       $phonetype_l=[];

         foreach($phonearray as $phone_data)
         {
                    $phone_id=$phone_data->id;
                    if(strpos($phone_data ,"Mobile")){
                       $phonetype_m[]=$phone_data->phone_type;
                    }
                    else{
                      $phonetype_l[]=$phone_data->phone_type;
                    }
                    $ids=$phone_id;
                    $phoneidarray[]=$ids;
         }
            
         $phonecount=count($phonearray);       
         for($i=0; $i < $phonecount; $i++)
         {
            $id= $phoneidarray[$i];
            $match=Client_phone_number::where([['client_phone',$request->client_phone[$i]],['id',$id],['deleted',0]])->get();
            if(count($match) == 1 ){
              
            } 
            else{
              $match=Client_phone_number::where([['client_phone',$request->client_phone[$i]],['deleted',0]])->get();
              if(count($match) != 0){
                 return Redirect::back()->withErrors([$request->client_phone[$i].' already existed']);
              }
              else{
                $update_email=Client_phone_number::find($id);
                $update_email->update(['client_phone'=>$request->client_phone[$i],'phone_type'=>$request->phone_type[$i]]);  
              } 
            }
              
            
         }
   
      //add new client phone
        $typevalue_m=end($phonetype_m);   
        $typevalue_m=substr($typevalue_m, -1);
        $typevalue_l=end($phonetype_l);   
        $typevalue_l=substr($typevalue_l, -1); 
        if( $typevalue_m != ""){
          $pm= $typevalue_m;
        }
        else{
          $pm=0;
        }
        if( $typevalue_l != ""){
          $pl= $typevalue_l;
        }
        else{
          $pl=0;
        }

          // dd($typevalue_m); 
        $newphonecount=count($request->client_phone);

        for($i=$phonecount; $i < $newphonecount; $i++){
          if(isset($request->client_phone[$i])){
            $match=Client_phone_number::where([['client_phone',$request->client_phone[$i]],['deleted',0]])->get();
            if(count($match) != 0){
                 return Redirect::back()->withErrors([$request->client_phone[$i].' already existed']);
            }
            else{
                $clientnumber=new Client_phone_number;
                $clientnumber->client_phone=$request->client_phone[$i];
               if($request->phone_type[$i] == 'Mobile'){
                $pm++;
                $clientnumber->phone_type=$request->phone_type[$i].$pm;
               }
               else{
                $pl++;
                $clientnumber->phone_type=$request->phone_type[$i].$pl;
               }
                $clientnumber->client_id=$request->id;
                $clientnumber->save();
            }    
        } 
      }
    }

    if (auth()->user()->hasPermission('edit.client.email') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
      //update client email
        $emailarray=Client_email_address::where([['client_id',$request->id],['deleted',0]])->get();
        
        $emailidarray=[];
        $emailtype_w=[];
        $emailtype_h=[];
        foreach($emailarray as $email_data)
        {
              $email_id=$email_data->id;
              if(strpos($email_data ,"Work")){
                 $emailtype_w[]=$email_data->email_type;
              }
              else{
                 $emailtype_h[]=$email_data->email_type;
              }
              $ids=$email_id;
              $emailidarray[]=$ids;

        }

        $emailcount=count($emailarray);
        for($i=0; $i < $emailcount; $i++)
        {   
            $id= $emailidarray[$i];
            $match=Client_email_address::where([['client_email',$request->email[$i]],['id',$id],['deleted',0]])->get();
            if(count($match) == 1 ){
              
            } 
            else{
             $match=Client_email_address::where([['client_email',$request->email[$i]],['deleted',0]])->get();
              if(count($match) != 0){
                 return Redirect::back()->withErrors([$request->email[$i].' already existed']);
              } 
              else{
                 $update_email=Client_email_address::find($id);
                $update_email->update(['client_email'=>$request->email[$i],'email_type'=>$request->email_type[$i]]); 
              }
            }
                    
        }
        //add new client email
      //this code use for add dynamic home and work email typr work1,work2
        $emailtype_w=end($emailtype_w);   
        $emailtype_w=substr($emailtype_w, -1);
        $emailtype_h=end($emailtype_h);   
        $emailtype_h=substr($emailtype_h, -1); 
        if( $emailtype_w != ""){
          $ew= $emailtype_w;
        }
        else{
          $ew=0;
        }
        if( $emailtype_h != ""){
          $eh= $emailtype_h;
        }
        else{
          $eh=0;
        }
        $newemailcount=count($request->email);
        for($i=$emailcount; $i < $newemailcount; $i++){
          if(isset($request->email[$i])){
            $match=Client_email_address::where([['client_email',$request->email[$i]],['deleted',0]])->get();
            if(count($match) != 0){
                 return Redirect::back()->withErrors([$request->email[$i].' already existed']);
            }
            else{
            $clientemail=new Client_email_address;
                $clientemail->client_email=$request->email[$i];
              if($request->email_type[$i] == "Work"){
                $ew++;
                $clientemail->email_type=$request->email_type[$i].$ew;
              }
              else{
                $eh++;
                $clientemail->email_type=$request->email_type[$i].$eh;
              }
                $clientemail->client_id=$request->id;
                $clientemail->save(); 
            }
          }
        }
    }
       return redirect()->route('client.show', ['id' => $clientdata->id,'backto'=>$request->backto]);
     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_master  $client_master
     * @return \Illuminate\Http\Response
     */
    public function destroy(client_master $client_master)
    {
        //
    }

    public function phonedelete($id){
       
           $deletephone=Client_phone_number::find($id);
           $deletephone->update(['deleted'=>1]);
           $activity = Activity::all()->last();

            $activity->update(['description'=>'Delete','attributes1'=>$deletephone->client_phone. ' Deleted']);
           return  response()->json(['data'=>$id]);
    }

    public function emaildelete($id){

          $deleteemail=Client_email_address::find($id);
          $deleteemail->update(['deleted'=>1]);
           $activity = Activity::all()->last();

            $activity->update(['description'=>'Delete','attributes1'=>$deleteemail->client_email. ' Deleted']);
          return  response()->json(['data'=>$info]);
    }

   
    public function activitylog($id){
      $search="Client";
       $data =DB::table('activity_log')
        ->join('users','activity_log.causer_id','=','users.id')
        ->select('activity_log.id','activity_log.log_name','activity_log.subject_id','activity_log.subject_type','activity_log.attributes1','activity_log.attributes2','users.name','activity_log.description','activity_log.created_at')->where([['attributes3',$id],['log_name','LIKE','%Client%']]);
         
         return Datatables::of($data)
               
         ->escapeColumns([])  
         ->make(true);
    }
 public function isexist(Request $request){
  if(is_numeric($request->id) && isset($request->email)){
      $match=Client_email_address::where([['client_email',$request->email],['id',$request->id],['deleted',0]])->get();
       if(count($match) == 1 ){
       
       } 
       else{
         $match=Client_email_address::where([['client_email',$request->email],['deleted',0]])->get();
            if(count($match) != 0){
                 return  response()->json("Already Exist");
            } 
       }
   }
   elseif(isset($request->email)){
      $match=Client_email_address::where([['client_email',$request->email],['deleted',0]])->get();
       if(count($match) != 0){
        return  response()->json("Already Exist");
       } 
   }
  if(is_numeric($request->id) && isset($request->phone)){
    
      $match=Client_phone_number::where([['client_phone',$request->phone],['id',$request->id],['deleted',0]])->get();
       if(count($match) == 1 ){
       
       } 
       else{
         $match=Client_phone_number::where([['client_phone',$request->phone],['deleted',0]])->get();
            if(count($match) != 0){
                 return  response()->json("Already Exist");
            } 
       }
   }
   elseif(isset($request->phone)){
      $match=Client_phone_number::where([['client_phone',$request->phone],['deleted',0]])->get();
       if(count($match) != 0){
        return  response()->json("Already Exist");
       } 
   }
       
 } 

}
