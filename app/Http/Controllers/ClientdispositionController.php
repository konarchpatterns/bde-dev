<?php
namespace App\Http\Controllers;
use App\Client_disposition;
use App\Company_disposition;

use Auth;
use Carbon\Carbon;
use App\Event;
use App\Client_Master;
use App\Company_Master;
use App\Company_address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use App\User;
use Notification;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MyEventNotification;
class ClientdispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('frontdashboard.front.view');
   
    }
    public function record(){
       // dd(auth()->user()->id);

       // $clnoanswer=Client_disposition::where([['status','No Answer'],['user_id',auth()->user()->id]])->count();
        $clnoanswer=Client_disposition::where('status','No Answer')->count();
       $clbusynumber=Client_disposition::where('status','Busy Number')->count();
       $clansweringmachine=Client_disposition::where('status','Answering Machine')->count();



       $condoes=Company_disposition::where('status',"Doesn't Qualify")->count();
       $cobsale=Company_disposition::where('status','Sale')->count();
       $conoanswer=Company_disposition::where('status',"No Answer")->count();
       $coansweringmachine=Company_disposition::where('status','Answering Machine')->count();
       $cohangup=Company_disposition::where('status','Hang Up')->count();
       $coansweringmachine=Company_disposition::where('status','Disconnected Number')->count();
       $coansweringmachine=Company_disposition::where('status',' Not Interested')->count();
       $coansweringmachine=Company_disposition::where('status','Wrong Number')->count();
       $coansweringmachine=Company_disposition::where('status',' Number Not In Service')->count();
       $coansweringmachine=Company_disposition::where('status','Interested')->count();
       $coansweringmachine=Company_disposition::where('status','Follow Up')->count();
       $coansweringmachine=Company_disposition::where('status',' Busy Number')->count();
       $coansweringmachine=Company_disposition::where('status',' Call Back
       ')->count();

        return  response()->json(['clnoanswer'=>$clnoanswer,'clbusynumber'=>$clbusynumber,'clansweringmachine'=>$clansweringmachine,'conoanswer'=>$conoanswer,'cobusynumber'=>$cobusynumber,'coansweringmachine'=>$coansweringmachine]);
       // dd($noanswer .  $busynumber . $answeringmachine);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function predispositionentry(Request $request){

      $latdispositions=Client_disposition::where([['client_id','=',$request->client_id],['user_id','=',auth()->user()->id]])->orderBy('id', 'DESC')->first();
     
      $companyid=Client_Master::where('id',$request->client_id)->pluck('company_id');
      $disposition=new Client_disposition;
      $disposition->client_id=$request->client_id;
      $disposition->company_id=$companyid[0];
      $disposition->user_id=auth()->user()->id;
      $disposition->phonenumber=$request->phonenumber;
      $disposition->phonenumbertype=$request->phonenumbertype;
      $disposition->created_atus=Carbon::now('America/New_York');
      $disposition->save();
      activity()->disableLogging();
          $adddammy=Client_disposition::find( $disposition->id);
          $adddammy->status="Closed Window";
          $adddammy->update();

          $clientlastdisposition=Client_Master::find($disposition->client_id);
          $clientlastdisposition->client_last_disposition_id=$disposition->id;
          $clientlastdisposition->clientlastdisposition="Closed Window"."<br>".$disposition->created_at;
          $clientlastdisposition->update();
      activity()->enableLogging();
      return Response($disposition->id);


    }

//store it update disposition predisposition already store disposition so store update diposition 1-11-2020
    public function store(Request $request)
    {
           $v = Validator::make($request->all(), [
               "status"=>'required',
           ]);   
           if( $v->fails()){
              return Redirect::back()->withErrors($v);
           }    
           $disposition=Client_disposition::find($request->id);
           // $disposition->client_id=$request->client_id;
            //$disposition->company_id=$companyid[0];
           // $disposition->user_id=auth()->user()->id;
           // $disposition->phonenumber=$request->phonenumber;
            $disposition->status=$request->status;
            $disposition->follow_up_date=$request->follow_up;
            $disposition->description=$request->description;
            $disposition->update();
            $clientdatas=Client_Master::where('id',$disposition->client_id)->get();
            foreach ($clientdatas as $clientdata) {

            }
            $clientlastdisposition=Client_Master::find($disposition->client_id);
            $clientlastdisposition->client_last_disposition_id=$disposition->id;
            $clientlastdisposition->clientlastdisposition=$disposition->updated_at."<br>".$request->status;
            $clientlastdisposition->update();

            if($request->status == 'Follow Up' || $request->status == 'Call Back' || $request->status == 'Interested')
            { 
              activity()->disableLogging();
                $storereminder= new Event;
                $storereminder->title=$request->status.' to '." Client : ".$clientdata->client_name;
                $storereminder->timezone="Client,".$disposition->client_id;
                $storereminder->description=$request->description;
                $storereminder->start_date=$request->follow_up;
                $storereminder->end_date=date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up)));
                $storereminder->type="task";
                $storereminder->flag=0;
                $storereminder->create_user_id=auth()->user()->id;
                $storereminder->save();
              activity()->enableLogging();
               
    
   
            $description='title is '.$request->status.' to Client: '.$clientdata->client_name.',start date is '.$request->follow_up.',end date is '.date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up))).',create user id is '.auth()->user()->id;


              $data=array('log_name'=>'Client Task','causer_id'=>auth()->user()->id,'causer_type'=>'App\User','subject_type'=>'App\Event','subject_id'=>$storereminder->id,'description'=>'created','attributes1'=>"Follow up is ".$description,'attributes2'=>$clientdata->client_name,'attributes3'=>$disposition->client_id,'attributes4'=>$clientdata->company_id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);




            }    
        if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();

           $link= route('client.show',['id'=> $disposition->client_id,'backto'=>"normal"]);
             $details = [
            'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$clientdata->client_name} by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
        }
        elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
            $link= route('client.show',['id'=> $disposition->client_id,'backto'=>"normal"]);
           $details = [
                  'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$clientdata->client_name} by ".auth()->user()->name.".",
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
        }        
    }

    public function predispositionentrycompany(Request $request){
     
          $comdisposition=new Company_disposition;
          $comdisposition->company_id=$request->company_id;
          $comdisposition->user_id=auth()->user()->id;
          $comdisposition->phonenumber=$request->companycallingnumber;
          $comdisposition->phonenumbertype=$request->phonenumbertype;
          $comdisposition->created_atus=Carbon::now('America/New_York');
          $comdisposition->save(); 
          activity()->disableLogging();
               $adddammy=Company_disposition::find( $comdisposition->id);
               $adddammy->status="Closed Window";
               $adddammy->update();
               $companylastdisposition=Company_Master::find($comdisposition->company_id);
               $companylastdisposition->last_disposition_id=$comdisposition->id;
               $companylastdisposition->last_disposition=$comdisposition->created_at."<br>"."Closed Window";
               $companylastdisposition->update();
          activity()->enableLogging();
          return Response($comdisposition->id);
    }
    public function companydispositionstore(Request $request)
    {
              $comdisposition=Company_disposition::find($request->id);
              //$comdisposition->company_id=$request->company_id;
              //$comdisposition->user_id=auth()->user()->id;
              $comdisposition->status=$request->status;
              //$comdisposition->phonenumber=$request->companycallingnumber;
              $comdisposition->follow_up_date=$request->follow_up;
              $comdisposition->description=$request->description;
              $comdisposition->update(); 

            $companydatas=Company_Master::where('id',$comdisposition->company_id)->get();
                foreach ($companydatas as $companydata) {
                   
                }
            $companylastdisposition=Company_Master::find($comdisposition->company_id);
            $companylastdisposition->last_disposition_id=$comdisposition->id;
            $companylastdisposition->last_disposition=$comdisposition->updated_at."<br>".$request->status;
            $companylastdisposition->update();

              if($request->status == 'Follow Up' || $request->status == 'Call Back' || $request->status == 'Interested')
            {
              
             activity()->disableLogging();  
              $storereminder= new Event;
              if($companydata->converted == 'converted'){

                $storereminder->title=$request->status.' to '." Company : ".$companydata->company_name;
                $storereminder->timezone="Company,".$comdisposition->company_id;
              }
              else{
                $storereminder->title=$request->status.' to '." Lead : ".$companydata->company_name;
                $storereminder->timezone="Lead,".$comdisposition->company_id;
              }
                $storereminder->description=$request->description;
                $storereminder->start_date=$request->follow_up;
                $storereminder->end_date=date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up)));
                $storereminder->type="task";
                $storereminder->flag=0;
                $storereminder->create_user_id=auth()->user()->id;
                $storereminder->save();
               activity()->enableLogging();

                $description='title is '.$request->status.' to Company: '.$companydata->company_name.',start date is '.$request->follow_up.',end date is '.date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up))).',create user id is '.auth()->user()->id;

                $data=array('log_name'=>'Company Task','causer_id'=>auth()->user()->id,'causer_type'=>'App\User','subject_type'=>'App\Event','subject_id'=>$storereminder->id,'description'=>'created','attributes1'=>$description,'attributes2'=>$companydata->company_name,'attributes3'=>$companydata->id,'attributes4'=>$companydata->id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);

            } 
   
          if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();

           $link= route('company.show',['id'=> $comdisposition->company_id,'backto'=>"normal"]);
             $details = [
               'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$companydata->company_name} by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
        }
        elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('company.show',['id'=> $comdisposition->company_id,'backto'=>"normal"]);
           $details = [
              'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$companydata->company_name} by ".auth()->user()->name.".", 
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
        }   
      
    }
    public function taskstore(Request $request){
           $findtask=Event::findOrFail($request->task_id);
             $description=$request->description;
             $status=$request->status;
             if($description == ""){
              $description="nodata";
             }
             if($status == ""){
              $status="nodata";
             }
            $description= "Follow up description is ".$description." and status is ".$status;
            if($findtask->create_user_id == auth()->user()->id){
                $findtask1=Event::where('id',$request->task_id)->update(['taskfollowup'=>$request->status.$request->description]);
             $clientdatas=Client_Master::where('id',$request->client_id)->get();
            foreach ($clientdatas as $clientdata) {
                
            }
            //insert data manually in activity log
              $data=array('log_name'=>'Client Task',"causer_id"=>auth()->user()->id,'causer_type'=>'App\User','attributes1'=>$description,'subject_type'=>'App\Event','subject_id'=>$request->task_id,'description'=>'updated','attributes2'=>$clientdata->client_name ,'attributes3'=>$request->client_id,'attributes4'=>$clientdata->compny_id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);

             
            $companyid=Client_Master::where('id',$request->client_id)->pluck('company_id');
            $disposition=new Client_disposition;
            $disposition->client_id=$request->client_id;
            $disposition->company_id=$companyid[0];
            $disposition->user_id=auth()->user()->id;
            $disposition->status=$request->status;
            $disposition->follow_up_date=$request->follow_up;
            $disposition->description=$request->description;
            $disposition->phonenumber=$request->phonenumber;
            $disposition->phonenumbertype=$request->phonenumbertype;
            $disposition->created_atus=Carbon::now('America/New_York');
            $disposition->save();
          
            $clientdatas=Client_Master::where('id',$request->client_id)->get();
            foreach ($clientdatas as $clientdata) {
            }
            $clientlastdisposition=Client_Master::find($request->client_id);
            $clientlastdisposition->client_last_disposition_id=$disposition->id;
            $clientlastdisposition->clientlastdisposition=$disposition->created_at."<br>".$request->status;
            $clientlastdisposition->update();

            if($request->status == 'Follow Up' || $request->status == 'Call Back' || $request->status == 'Interested' )
            { 
              activity()->disableLogging();
                $storereminder= new Event;
                $storereminder->title=$request->status.' to '." Client : ".$clientdata->client_name;
                $storereminder->timezone="Client,".$request->client_id;
                $storereminder->description=$request->description;
                $storereminder->start_date=$request->follow_up;
                $storereminder->end_date=date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up)));
                $storereminder->type="task";
                $storereminder->flag=0;
                $storereminder->create_user_id=auth()->user()->id;
                $storereminder->save();
              activity()->enableLogging();
               
    
   
            $description='title is '.$request->status.' to Client: '.$clientdata->client_name.',start date is '.$request->follow_up.',end date is '.date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up))).',create user id is '.auth()->user()->id;


              $data=array('log_name'=>'Client Task','causer_id'=>auth()->user()->id,'causer_type'=>'App\User','subject_type'=>'App\Event','subject_id'=>$storereminder->id,'description'=>'created','attributes1'=>"Follow up is ".$description,'attributes2'=>$clientdata->client_name,'attributes3'=>$request->client_id,'attributes4'=>$clientdata->company_id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);




            }    
        if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();

           $link= route('client.show',['id'=> $request->client_id,'backto'=>"normal"]);
             $details = [
      'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$clientdata->client_name} by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
        }
        elseif(auth()->user()->designation == "Sales Executives"){

             $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
            $link= route('client.show',['id'=> $request->client_id,'backto'=>"normal"]);
           $details = [
          'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$clientdata->client_name} by ".auth()->user()->name.".",
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
        } 

              return  response()->json(['data'=>1]);

          
            }
            else{
             return  response()->json(['data'=>2]);
            }
           

    }
     public function companytaskdispositionstore(Request $request){
           $findtask=Event::findOrFail($request->task_id);

          $description=$request->description;
             $status=$request->status;
             if($description == ""){
              $description="nodata";
             }
             if($status == ""){
              $status="nodata";
             }
            $description= "Follow up description is ".$description." and status is ".$status;
            if($findtask->create_user_id == auth()->user()->id){
               $findtask1=Event::where('id',$request->task_id)->update(['taskfollowup'=>$request->status.$request->description]);
               $companydatas=Company_Master::find($request->company_id)->get();
               foreach ($companydatas as $companydata) {
                 # code...
               }

            //insert data manually in activity log
               $data=array('log_name'=>'Company Task',"causer_id"=>auth()->user()->id,'causer_type'=>'App\User','attributes1'=>$description,'subject_type'=>'App\Event','subject_id'=>$request->task_id,'description'=>'updated','attributes2'=>$companydata->company_name ,'attributes3'=>$request->company_id,'attributes4'=>$request->company_id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);

                $comdisposition=new Company_disposition;
                $comdisposition->company_id=$request->company_id;
                $comdisposition->user_id=auth()->user()->id;
                $comdisposition->status=$request->status;
                $comdisposition->phonenumber=$request->companycallingnumber;
                $comdisposition->phonenumbertype=$request->phonenumbertype;
                $comdisposition->follow_up_date=$request->follow_up;
                $comdisposition->description=$request->description;
                $comdisposition->created_atus=Carbon::now('America/New_York');
                $comdisposition->save(); 
                 $companydatas=Company_Master::where('id',$request->company_id)->get();
                foreach ($companydatas as $companydata) {
                   
                }
               $companylastdisposition=Company_Master::find($comdisposition->company_id);
               $companylastdisposition->last_disposition_id=$comdisposition->id;
               $companylastdisposition->last_disposition=$comdisposition->created_at."<br>".$request->status;
               $companylastdisposition->update();
            if($request->status == 'Follow Up' || $request->status == 'Call Back' || $request->status == 'Interested')
            {
              activity()->disableLogging();  
              $storereminder= new Event;
              if($companydata->converted == 'converted'){

                $storereminder->title=$request->status.' to '." Company : ".$companydata->company_name;
                $storereminder->timezone="Company,".$request->company_id;
              }
              else{
                $storereminder->title=$request->status.' to '." Lead : ".$companydata->company_name;
                $storereminder->timezone="Lead,".$request->company_id;
              }
                $storereminder->description=$request->description;
                $storereminder->start_date=$request->follow_up;
                $storereminder->end_date=date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up)));
                $storereminder->type="task";
                $storereminder->flag=0;
                $storereminder->create_user_id=auth()->user()->id;
                $storereminder->save();
               activity()->enableLogging();

                $description='title is '.$request->status.' to Company: '.$companydata->company_name.',start date is '.$request->follow_up.',end date is '.date('Y-m-d H:i',strtotime('+00 hour +30 minutes',strtotime($request->follow_up))).',create user id is '.auth()->user()->id;

                $data=array('log_name'=>'Company Task','causer_id'=>auth()->user()->id,'causer_type'=>'App\User','subject_type'=>'App\Event','subject_id'=>$storereminder->id,'description'=>'created','attributes1'=>$description,'attributes2'=>$companydata->company_name,'attributes3'=>$companydata->id,'attributes4'=>$companydata->id,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                $clientids=DB::table('activity_log')->insert($data);

            } 
          if(auth()->user()->designation == "Business Development Executives") {
           $user1=User::where('id',auth()->user()->id)->get();

           $link= route('company.show',['id'=> $request->company_id,'backto'=>"normal"]);
             $details = [
            'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$companydata->company_name} by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
        }
        elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('company.show',['id'=> $request->company_id,'backto'=>"normal"]);
           $details = [
            'data' =>"<a href='{$link}'>{$request->status}</a> disposition has been added to {$companydata->company_name} by ".auth()->user()->name.".",
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
        }   
                
                return  response()->json(['data'=>1]);
            }
            else{
               return  response()->json(['data'=>2]);
           }
     }

     public function clientdispositionlog($id){
        $data =DB::table('client_dispositions')
        ->join('users','client_dispositions.user_id','=','users.id')
        ->select('client_dispositions.id','client_dispositions.status','client_dispositions.follow_up_date','users.name','client_dispositions.description','client_dispositions.phonenumbertype','client_dispositions.created_at')->where('client_id',$id)
         ->distinct()->groupBy('client_dispositions.id','client_dispositions.status','client_dispositions.follow_up_date','users.name','client_dispositions.description','client_dispositions.phonenumbertype','client_dispositions.created_at');
         // $data=Client_disposition::all();
         return Datatables::of($data)
               
         ->escapeColumns([])  
         ->make(true);
     }
       public function companyclientdispositionlog($id){
        $clients=Client_Master::where('company_id',$id)->pluck('id');
        // dd($clients);
        $data =DB::table('client_dispositions')
        ->join('users','client_dispositions.user_id','=','users.id')
        ->join('client_masters','client_dispositions.client_id','=','client_masters.id')
        ->select('client_dispositions.id','client_dispositions.status','client_dispositions.follow_up_date','client_masters.client_name','users.name','client_dispositions.description','client_dispositions.phonenumbertype','client_dispositions.created_at')->whereIn('client_id',$clients)
        ->distinct()->groupBy('client_dispositions.id','client_dispositions.status','client_dispositions.follow_up_date','client_masters.client_name','client_dispositions.phonenumbertype','users.name','client_dispositions.description','client_dispositions.created_at');
         // $data=Client_disposition::all();
         return Datatables::of($data)
               
         ->escapeColumns([])  
         ->make(true);
     }
    public function companydispositionlog($id){
        $data =DB::table('company_dispositions')
        ->join('users','company_dispositions.user_id','=','users.id')
        ->select('company_dispositions.id','company_dispositions.status','company_dispositions.follow_up_date','users.name','company_dispositions.description','company_dispositions.phonenumbertype','company_dispositions.created_at')->where('company_id',$id)
        ->distinct()->groupBy('company_dispositions.id','company_dispositions.status','company_dispositions.follow_up_date','users.name','company_dispositions.description','company_dispositions.phonenumbertype','company_dispositions.created_at');
         // $data=Client_disposition::all();
         return Datatables::of($data)
               
         ->escapeColumns([])  
         ->make(true);
     }
   
    public function showdatacompanyindisposition(Request $request)
    {
         $comapnydetail=Company_Master::find($request->companyid);
         $companyaddresses=Company_address::where('company_id',$request->companyid)->get();
         foreach ($companyaddresses as $companyaddress){}
         $clientdetails=Client_Master::where('company_id',$request->companyid)->get();
            $clientlist="";
            $i=1;
         foreach ($clientdetails as $clientdetail) {
             $clientlist .= '<tr>'.'<td>' . $i . '</td>' .'<td>' . $clientdetail->client_name . '</td>' .'<td>' . $clientdetail->client_designation . '</td>'.'</tr>' ;
                  $i++;
         }
         $companydispositions=Company_disposition::where('company_id',$request->companyid)->get();
         $dispositionlist='';
         $j=1;
         $lastremove=count($companydispositions);
         foreach ($companydispositions as $companydisposition) {
           if($lastremove != $j){
              $dispositionlist .= '<tr>'.'<td>' . $j . '</td>' .'<td>' . $companydisposition->status . '</td>' .'<td>' . $companydisposition->follow_up_date . '</td>' .'<td><span data-toggle="tooltip" data-placement="left" title="'.$companydisposition->description.'">' . $companydisposition->description . '</span></td>'.'<td>' . $companydisposition->created_at . '</td>'.'</tr>' ;
                  $j++;
           }        
         }

         return Response([[$comapnydetail],[$companyaddress],[$clientlist],[$dispositionlist]]);
    }
   
  
    public function showdataclientindisposition(Request $request)
    {
      //dd($request->all());
      $clientdata=Client_Master::find($request->clientid);
      $companydatas=Company_Master::where('id',$clientdata->company_id)->get();
      foreach($companydatas as $companydata){}
      $companyaddressdatas=Company_address::where('company_id',$clientdata->company_id)->get();
      foreach ($companyaddressdatas as $companyaddressdata) {}
      $clientdetails=Client_Master::where('company_id',$clientdata->company_id)->get();
            $clientlist="";
            $i=1;
         foreach ($clientdetails as $clientdetail) {
             $clientlist .= '<tr>'.'<td>' . $i . '</td>' .'<td>' . $clientdetail->client_name . '</td>' .'<td>' . $clientdetail->client_designation . '</td>'.'</tr>' ;
                  $i++;
         }
      $clientdispositions=Client_disposition::where('client_id',$request->clientid)->get();
         $dispositionlist='';
         $j=1;
         $lastremove=count($clientdispositions);
         foreach ($clientdispositions as $clientdisposition) {
           if($lastremove != $j){
              $dispositionlist .= '<tr>'.'<td>' . $j . '</td>' .'<td>' . $clientdisposition->status . '</td>' .'<td>' . $clientdisposition->follow_up_date . '</td>' .'<td><span data-toggle="tooltip" data-placement="left"  title="'.$clientdisposition->description.'">' . $clientdisposition->description . '</span></td>'.'<td>' . $clientdisposition->created_at . '</td>'.'</tr>' ;
                  $j++;
           }        
         }
      return Response([[$clientdata],[$companyaddressdata],[$companydata],[$clientlist],[$dispositionlist]]); 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client_disposition  $client_disposition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client_disposition $client_disposition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client_disposition  $client_disposition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client_disposition $client_disposition)
    {
        //
    }
}
