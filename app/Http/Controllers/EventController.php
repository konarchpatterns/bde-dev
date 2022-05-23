<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Calendar;
use Carbon\Carbon;
use App\Event;
use App\Eventuser;
use App\User;
use App\Company_Master;
use App\Client_Master;
use App\Company_email_address;
use App\Company_phone_number;
use App\Client_email_address;
use App\Client_phone_number;
use Spatie\Activitylog\Models\Activity;
use Auth;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Str;
use DateTime;
use Mail;
use View;
use Session;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
  public function localeventindex(){
      $events = [];
        // $data = Event::where('create_user_id',auth()->user()->id)->get();
      if (auth()->user()->hasRole(['admin'])){
              $data=Event::all();
              $userdatas=User::where('flag',0)->get();
      }
      elseif(auth()->user()->hasRole(['bde'])){
           $data=Event::all();
            $userdatas=User::where([['team_leader_id','=',auth()->user()->id],['flag','=',0]])->get();

      }
      else{
           $data=Event::where([['create_user_id','=',auth()->user()->id],['flag','=',0]])->get();
           
            $userdatas="";
      }
        $event =  new Event;
        $events_array =  $data->toArray();

         foreach ($events_array as $key) {
          $key['description']= preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $key['description']);
          $key['title']=preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $key['title']);
              //$key['description']=str_replace("\n","&&",addslashes($key['description']));
                //if($key['id'] == 60) {
                 //dd($key['description']);
                 $data[]  = ['id' =>  $key['id'] ,  'title' => $key['title'] , 'allDay' => false, 'start' => $key['start_date'] , 'end' => $key['end_date'],'description'=>$key['description'],'timezone'=>$key['timezone'],'flag'=>$key['flag'],'google_id'=>$key['google_id'],
                    'type'=>$key['type'],'create_user_id'=>$key['create_user_id'],'taskfollowup'=>$key['taskfollowup'],] ;
              //}
        
          }
       
      return view('localfullcalendar', compact('data', 'event','userdatas'));
  }
  //store local event in calendar
  public function storelocalevent(Request $request){
      $usermaildata=User::find(Auth()->user()->id);   
      $startDateTime = Carbon::parse($request->start_date);
      $endDateTime= Carbon::parse($request->end_date);
       $v = Validator::make($request->all(), [
              'guestname.*'=>'email',
              'username.*'=>'email'
            ]);
      if( $v->fails()){
           return Redirect::back()->withErrors($v);
      }
       $startshow=date('h:i:s a ', strtotime($request->start_date));
       $endshow=date('h:i:s a ', strtotime($request->end_date));
       $dateofevent=date('jS F, Y', strtotime($request->start_date));
       //dd();
          $event = new Event;
          $event->title=$request->title;
          $event->start_date=$startDateTime;
          $event->end_date=$endDateTime;
          $event->timezone=$request->time_zone;
          $event->description=$request->description;
          $event->create_user_id=auth()->user()->id;
          $event->flag=0;
          $event->save();

        if(isset($request->guestname)){
          $guestcount=count($request->guestname);
          for($i=0;$i<$guestcount;$i++){
            $guestuser=new Eventuser;
            $guestuser->attendess_email=$request->guestname[$i];
            $guestuser->event_id=$event->id;
            $guestuser->type="Guest";
            $guestuser->c_id=$request->c_id[$i];
            $guestuser->c_type=$request->c_type[$i];
            $guestuser->responsestatus="needsAction";
            $guestuser->save();
          }
        }

          if(isset($request->username)){
          $usercount=count($request->username);
          for($i=0;$i<$usercount;$i++){
            $homeuser=new Eventuser;
            $homeuser->attendess_email=$request->username[$i];
            $homeuser->event_id=$event->id;
            $homeuser->type="User";
            $homeuser->responsestatus="needsAction";
            $homeuser->save();
          }
        }
        return redirect()->route('localeventindex1');

    }
  //update local event in calendar
  public function updatelocalevent(Request $request){
       $usermaildata=User::find(Auth()->user()->id);
       $startDateTime = Carbon::parse($request->start_date);
       $endDateTime= Carbon::parse($request->end_date);
       $startshow=date('h:i:s a ', strtotime($request->start_date));
       $endshow=date('h:i:s a ', strtotime($request->end_date));
       $dateofevent=date('jS F, Y', strtotime($request->start_date));
        //update event
          $updateevent= Event::find($request->id);
          if($updateevent->flag == 1){
            return Redirect::back();
          }
          $updateevent->title=$request->title;
          $updateevent->start_date=$startDateTime;
          $updateevent->end_date=$endDateTime;
          $updateevent->timezone=$request->time_zone;
          $updateevent->description=$request->description;
          $updateevent->update_user_id=auth()->user()->id;
          $updateevent->update();

        //add new guest eventuser 
          if(isset($request->newguestemail)){
          $newguestcount=count($request->newguestemail);
            for($i=0;$i<$newguestcount;$i++){
              $newguestuser=new Eventuser;
              $newguestuser->attendess_email=$request->newguestemail[$i];
              $newguestuser->event_id=$updateevent->id;
              $newguestuser->type="Guest";
              $newguestuser->c_id=$request->c_id[$i];
              $newguestuser->c_type=$request->c_type[$i];
              //$newguestuser->responsestatus="Pending";
              $newguestuser->save();
            } 
          }
        //update guest eventuser  
        if(isset($request->guestemail)){
          $guesteventids=Eventuser::where([['event_id',$request->id],['type','Guest']])->get(); 
          $guestidarray=[];
          foreach($guesteventids as $guesteventid){
                $guestidarray[]=$guesteventid->id;
          }
          $guestcount=count($request->guestemail);
          for($i=0;$i<$guestcount;$i++){
            $updateguestemail=Eventuser::find($guestidarray[$i]);
            $updateguestemail->attendess_email=$request->guestemail[$i];
            //$updateguestemail->responsestatus="Pending";
            $updateguestemail->update();
          }
        }
        //add new user in eventuser
        if(isset($request->newuseremail)){
          $newusercount=count($request->newuseremail);
          for($i=0;$i<$newusercount;$i++){
            $newuser=new Eventuser;
            $newuser->attendess_email=$request->newuseremail[$i];
            $newuser->event_id=$updateevent->id;
            $newuser->type="User";
            $newuser->responsestatus="Pending";
            $newuser->save();
          }
        }
        //update user  eventuser 
        if(isset($request->useremail)){
          $usereventids=Eventuser::where([['event_id',$request->id],['type','User']])->get(); 
          $useridarray=[];
          foreach($usereventids as $usereventid){
                $useridarray[]=$usereventid->id;
          }
          $usercount=count($request->useremail);
          for($i=0;$i<$usercount;$i++){
            $updateuseremail=Eventuser::find($useridarray[$i]);
            $updateuseremail->attendess_email=$request->useremail[$i];
            $updateuseremail->responsestatus="Pending";
            $updateuseremail->update();
           }
        }  
        return redirect()->route('localeventindex1');
  }  

  public function localeventdelete(Request $request){
      $usermaildata=User::find(Auth()->user()->id);
      $deleteevent=Event::find($request->id);
      if($deleteevent->flag == 1){

           return  response()->json($deleteevent->title .' already deleted.');
      }
      else{
      $startshow=date('h:i:s a ', strtotime($deleteevent->start_date));
      $endshow=date('h:i:s a ', strtotime($deleteevent->end_date));
      $dateofevent=date('jS F, Y', strtotime($deleteevent->start_date));
      $eventusers=Eventuser::where([['event_id',$request->id],['flag',0]])->get();

      foreach ($eventusers as $eventuser) {
        $eventatterndee=$eventuser->attendess_email;
        $eventuserflag=Eventuser::find($eventuser->id);
        $eventuserflag->flag=1;
        $eventuserflag->update();
        $activity = Activity::all()->last();
        $activity->update(['description'=>'Delete','attributes1'=>$eventatterndee.' Deleted.']);
      }
      $deleteevent->flag=1;
      $deleteevent->update();
      $activity = Activity::all()->last();
      $activity->update(['description'=>'Delete','attributes1'=>$deleteevent->title. ' Deleted.']);
     }
  }
  public function localattendeemaildelete(Request $request){
        $usermaildata=User::find(Auth()->user()->id);
      $deleteemail=Eventuser::find($request->id);

      if($deleteemail->flag == 1){
      }
      else{
           $eventdetail=Event::find($deleteemail->event_id);
           $startshow=date('h:i:s a ', strtotime($eventdetail->start_date));
           $endshow=date('h:i:s a ', strtotime($eventdetail->end_date));
           $dateofevent=date('jS F, Y', strtotime($eventdetail->start_date));
           $deleteemail->flag=1;
           $deleteemail->update();
           $activity = Activity::all()->last();

                $activity->update(['description'=>'Delete','attributes1'=>$deleteemail->attendess_email . ' Deleted.']);
       }      
  }
  public function readnotificationmessage(Request $request){
    
       $data =DB::table('notifications')->where('id',$request->notificationid)->update(['read_at'=>Carbon::now()]);
       $data= Auth::user()->unreadNotifications->count();
       return  response()->json($data);
}
public function emailinfo(Request $request){
  
  if($request->type == 2){
      $infos=Client_Master::find($request->id); 
      $emails=Client_email_address::where('client_id',$request->id)->get();
      foreach ($emails as $email) {
        $output=array( 'email' => $email->client_email);
        $output1[]=$output;
      }
      $phones=Client_phone_number::where('client_id',$request->id)->get();
        
      foreach ($phones as $phone) {
           $output=array( 'phone' => $phone->client_phone);
           $output2[]=$output;
         }   
     
       return  response()->json([$infos,$output1,$output2]);
  }
  else{
      $infos=Company_Master::find($request->id);
      $emails=Company_email_address::where('company_id',$request->id)->get();
      foreach ($emails as $email) {
        $output=array( 'email' => $email->company_email);
        $output1[]=$output;
      }
      $phones=Company_phone_number::where('company_id',$request->id)->get();
        
      foreach ($phones as $phone) {
           $output=array( 'phone' => $phone->company_phone);
           $output2[]=$output;
         }
        return  response()->json([$infos,$output1,$output2]);
  }

}

  public function attendemaildelete(Request $request){
      $usermaildata=User::find(Auth()->user()->id);
      $deleteemail=Eventuser::find($request->id);

      if($deleteemail->flag == 1){
      }
      else{
      $eventdetail=Event::find($deleteemail->event_id);
       $startshow=date('h:i:s a ', strtotime($eventdetail->start_date));
       $endshow=date('h:i:s a ', strtotime($eventdetail->end_date));
       $dateofevent=date('jS F, Y', strtotime($eventdetail->start_date));
    
      $eventusersend=$deleteemail->attendess_email;
       // Configuration
        $smtpAddress = 'smtp.zoho.com';
        $port = 465;
        $encryption = 'ssl';
        $yourEmail = $usermaildata->email;
        $yourPassword = $usermaildata->calendarpassword;
           // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                ->setUsername($yourEmail)
                ->setPassword($yourPassword);
        $mailer = new \Swift_Mailer($transport);
            // Send email
        $message = (new \Swift_Message('Cancelled Meeting:'.$eventdetail->title))
             ->setFrom([$yourEmail => $yourEmail])
             ->setTo([$eventusersend => $eventusersend])
             // If you want plain text instead, remove the second paramter of setBody
            ->setBody("Meeting with patterns Canceled at Date: ".$dateofevent."    Time: ".$startshow." to ".$endshow.".", 'text/html');
        $mailer->send($message);

        $deleteemail->flag=1;
        $deleteemail->update();
         $activity = Activity::all()->last();

            $activity->update(['description'=>'Delete','attributes1'=>$deleteemail->attendess_email . ' Deleted.']);
      }      
  }
  public function delete(Request $request){
      $usermaildata=User::find(Auth()->user()->id);
      $deleteevent=Event::find($request->id);
      if($deleteevent->flag == 1){

           return  response()->json($deleteevent->title .' already deleted.');
      }
      else{
      $startshow=date('h:i:s a ', strtotime($deleteevent->start_date));
      $endshow=date('h:i:s a ', strtotime($deleteevent->end_date));
      $dateofevent=date('jS F, Y', strtotime($deleteevent->start_date));

      
      $eventusers=Eventuser::where([['event_id',$request->id],['flag',0]])->get();

      foreach ($eventusers as $eventuser) {
        $eventatterndee=$eventuser->attendess_email;
       // Configuration
        $smtpAddress = 'smtp.zoho.com';
        $port = 465;
        $encryption = 'ssl';
        $yourEmail = $usermaildata->email;
        $yourPassword = $usermaildata->calendarpassword;
           // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                ->setUsername($yourEmail)
                ->setPassword($yourPassword);
        $mailer = new \Swift_Mailer($transport);
            // Send email
        $message = (new \Swift_Message('Cancelled Meeting:'.$deleteevent->title.''))
             ->setFrom([$yourEmail => $yourEmail])
             ->setTo([$eventatterndee => $eventatterndee])
             // If you want plain text instead, remove the second paramter of setBody
             ->setBody("Meeting with patterns Canceled at Date: ".$dateofevent."    Time: ".$startshow." to ".$endshow.".", 'text/html');
        $mailer->send($message);
        

        $eventuserflag=Eventuser::find($eventuser->id);
        $eventuserflag->flag=1;
        $eventuserflag->update();
        $activity = Activity::all()->last();
        $activity->update(['description'=>'Delete','attributes1'=>$eventatterndee.' Deleted.']);


      }
      $deleteevent->flag=1;
      $deleteevent->update();
      $activity = Activity::all()->last();
      $activity->update(['description'=>'Delete','attributes1'=>$deleteevent->title. ' Deleted.']);
     }
  }

    public function useremail(Request $request){
         $useremails=0;
         
         $useremails=User::where('email','LIKE','%'.$request->useremail."%")->get();
    
         $output1=[];
         foreach($useremails as $user_emails){
                $output=array( 'user_email1' => $user_emails->email);
                 $output1[]=$output;
            }
       
            return  response()->json($output1);
    }

    public function guestemail(Request $request){
         $guestemails=0;
        
         $guestemails=Company_email_address::where('company_email','LIKE','%'.$request->guestemail."%")->get();
         $clientguestemails=Client_email_address::where('client_email','LIKE','%'.$request->guestemail."%")->get();
       
         $output2=[];
         foreach($guestemails as $guest_emails){
                $output=array( 'guest_email1' => $guest_emails->company_email,'id1'=> $guest_emails->company_id,'type1'=>1);
                 $output2[]=$output;
            }
         foreach($clientguestemails as $client_guest_emails){
                $output=array( 'guest_email1' => $client_guest_emails->client_email,'id1'=> $client_guest_emails->client_id,'type1'=>2);
                 $output2[]=$output;
            }
         
            return  response()->json($output2);

    }
    public function index1(){

   
         if(Str::endsWith(auth()->user()->email, 'patterns247.net')){
             return redirect()->route('events1');
         }
         else{

            return redirect()->route('events1');
           
         }
    }
    public function index()
    {
        $events = [];
        // $data = Event::where('create_user_id',auth()->user()->id)->get();
      if (auth()->user()->hasRole(['admin'])){
              $data=Event::all();
              $userdatas=User::where('flag',0)->get();
      }
      elseif(auth()->user()->hasRole(['bde'])){
           $data=Event::all();
            $userdatas=User::where([['team_leader_id','=',auth()->user()->id],['flag','=',0]])->get();

      }
      else{
           $data=Event::where([['create_user_id','=',auth()->user()->id],['flag','=',0]])->get();
           
            $userdatas="";
      }
        $event =  new Event;
        $events_array =  $data->toArray();

         foreach ($events_array as $key) {
          $key['description']= preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $key['description']);
          $key['title']=preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $key['title']);
              //$key['description']=str_replace("\n","&&",addslashes($key['description']));
                //if($key['id'] == 60) {
                 //dd($key['description']);
                 $data[]  = ['id' =>  $key['id'] ,  'title' => $key['title'] , 'allDay' => false, 'start' => $key['start_date'] , 'end' => $key['end_date'],'description'=>$key['description'],'timezone'=>$key['timezone'],'flag'=>$key['flag'],'google_id'=>$key['google_id'],
                    'type'=>$key['type'],'create_user_id'=>$key['create_user_id'],'taskfollowup'=>$key['taskfollowup'],] ;
              //}
        
          }
       

      if(Str::endsWith(auth()->user()->email, 'patterns247.net')){
          return view('fullcalendar', compact('data', 'event','userdatas'));
        }
      else{
          return view('fullcalendargoogle', compact('data', 'event','userdatas'));
      }
    }

    public function fullcalander(){

        $events = [];
        $data = Event::all();
        $event =  new Event;
        $events_array =  $data->toArray();

         foreach ($events_array as $key) {
                

                //title: title,      start: start,   end: end,   allDay: allDay
                 $data[]  = [  'id' =>  $key['id'] ,  'title' => $key['title'] , 'allDay' => false, 'start' => $key['start_date'] , 'end' => $key['end_date'],
                                 ] ;
                 //        $data[] = [ 'id' => $key->id];
          }

          return view('calendars.fullsizecalander',compact('data', 'event'));
    }
    
     public function userdetail(Request $request)
    {
       
        $userdatas=Eventuser::where('event_id',$request->id)->get();
        $useremail=[];
        $userstatus=[];
        $guestemail=[];
        $gueststatus=[];
        $userid=[];
        $userflag=[];
        $guestflag=[];
        $guestid=[];
        $guestc_id=[];
        $guestc_type=[];
                 foreach($userdatas as $userdata){
                   if($userdata->type=='Guest') {
                    $guestemail[]=$userdata->attendess_email;
                    $gueststatus[]=$userdata->responsestatus;
                    $guestid[]=$userdata->id;
                    $guestc_id[]=$userdata->c_id;
                    $guestc_type[]=$userdata->c_type;
                     $guestflag[]=$userdata->flag;
                        
                   }
                   else
                   { 
                      $useremail[]=$userdata->attendess_email;
                      $userstatus[]=$userdata->responsestatus;
                      $userid[]=$userdata->id;
                      $userflag[]=$userdata->flag;
                   }
                 }

           return  response()->json(['useremail'=>$useremail,'userstatus'=>$userstatus,'guestemail'=>$guestemail,'gueststatus'=>$gueststatus,'guestid'=>$guestid,'userid'=>$userid,'guestflag'=>$guestflag,'userflag'=>$userflag,'guestc_id'=>$guestc_id,'guestc_type'=>$guestc_type]);

    }
    public function Create_Event()
    {
        // dd('hello');
        return view('calendars.calendar_types');
    }
    public function store(Request $request)
    {
      $usermaildata=User::find(Auth()->user()->id);
      
      $startDateTime = Carbon::parse($request->start_date);
      $endDateTime= Carbon::parse($request->end_date);


 
       $v = Validator::make($request->all(), [
              'guestname.*'=>'email',
              'username.*'=>'email'
            ]);
      if( $v->fails()){
           return Redirect::back()->withErrors($v);
      }
       $startshow=date('h:i:s a ', strtotime($request->start_date));
       $endshow=date('h:i:s a ', strtotime($request->end_date));
       $dateofevent=date('jS F, Y', strtotime($request->start_date));
       //dd();
          $event = new Event;
          $event->title=$request->title;
          $event->start_date=$startDateTime;
          $event->end_date=$endDateTime;
          $event->timezone=$request->time_zone;
          $event->description=$request->description;
          $event->create_user_id=auth()->user()->id;
          $event->flag=0;
          $event->save();
        // Configuration
        $smtpAddress = 'smtp.zoho.com';
        $port = 465;
        $encryption = 'ssl';
        $yourEmail = $usermaildata->email;
        $yourPassword = $usermaildata->calendarpassword;
           // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                ->setUsername($yourEmail)
                ->setPassword($yourPassword);
        $mailer = new \Swift_Mailer($transport);
            // Send email
        $message = (new \Swift_Message('Invitation:'.$request->title.''))
             ->setFrom([ $yourEmail => $yourEmail])
             ->setTo([auth()->user()->email => auth()->user()->email])
             // If you want plain text instead, remove the second paramter of setBody
             ->setBody("You have organized meeting Date: ".$dateofevent." Time: ".$startshow." to ".$endshow."", 'text/html');
        $mailer->send($message);
          $organizeuser=new Eventuser;
          $organizeuser->attendess_email=auth()->user()->email;
          $organizeuser->event_id=$event->id;
          $organizeuser->type="User";
          $organizeuser->responsestatus="accepted";
          $organizeuser->save();

        if(isset($request->guestname)){
          $guestcount=count($request->guestname);
          for($i=0;$i<$guestcount;$i++){
            $guestuser=new Eventuser;
            $guestuser->attendess_email=$request->guestname[$i];
            $guestuser->event_id=$event->id;
            $guestuser->type="Guest";
            $guestuser->c_id=$request->c_id[$i];
            $guestuser->c_type=$request->c_type[$i];
            $guestuser->responsestatus="needsAction";
            $guestuser->save();
        // Configuration
        $smtpAddress = 'smtp.zoho.com';
        $port = 465;
        $encryption = 'ssl';
        $yourEmail = $usermaildata->email;
        $yourPassword = $usermaildata->calendarpassword;
           // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                ->setUsername($yourEmail)
                ->setPassword($yourPassword);
        $mailer = new \Swift_Mailer($transport);
            // Send email
        $message = (new \Swift_Message('Invitation:'.$request->title.''))
             ->setFrom([ $yourEmail => $yourEmail])
             ->setTo([$request->guestname[$i] => $request->guestname[$i]])
             // If you want plain text instead, remove the second paramter of setBody
             ->setBody("Meeting with patterns at Date: ".$dateofevent." Time: ".$startshow." to ".$endshow."</strong>", 'text/html');
        $mailer->send($message);
        // if($mailer->send($message)){
        //     return "Check your inbox";
        // }

        // return "Something went wrong :(";
          }
        }
        if(isset($request->username)){
          $usercount=count($request->username);
          for($i=0;$i<$usercount;$i++){
            $homeuser=new Eventuser;
            $homeuser->attendess_email=$request->username[$i];
            $homeuser->event_id=$event->id;
            $homeuser->type="User";
            $homeuser->responsestatus="needsAction";
            $homeuser->save();
        // Configuration
        $smtpAddress = 'smtp.zoho.com';
        $port = 465;
        $encryption = 'ssl';
        $yourEmail = $usermaildata->email;
        $yourPassword = $usermaildata->calendarpassword;
           // Prepare transport
        $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                ->setUsername($yourEmail)
                ->setPassword($yourPassword);
        $mailer = new \Swift_Mailer($transport);
            // Send email
        $message = (new \Swift_Message('Invitation:'.$request->title.''))
             ->setFrom([ $yourEmail => $yourEmail])
             ->setTo([$request->username[$i] => $request->username[$i]])
             // If you want plain text instead, remove the second paramter of setBody
             ->setBody("Meeting with patterns atDate: ".$dateofevent."Time: ".$startshow." to ".$endshow."", 'text/html');
        $mailer->send($message);
          }
        } 
       
       return redirect()->route('events1');
    }

    public function update(Request $request){
      $usermaildata=User::find(Auth()->user()->id);
      $startDateTime = Carbon::parse($request->start_date);
      $endDateTime= Carbon::parse($request->end_date);
       $startshow=date('h:i:s a ', strtotime($request->start_date));
       $endshow=date('h:i:s a ', strtotime($request->end_date));
       $dateofevent=date('jS F, Y', strtotime($request->start_date));
        //update event
          $updateevent= Event::find($request->id);
          if($updateevent->flag == 1){
            return Redirect::back();
          }
          $updateevent->title=$request->title;
          $updateevent->start_date=$startDateTime;
          $updateevent->end_date=$endDateTime;
          $updateevent->timezone=$request->time_zone;
          $updateevent->description=$request->description;
          $updateevent->update_user_id=auth()->user()->id;
          $updateevent->update();

        //add new guest eventuser 
          if(isset($request->newguestemail)){
          $newguestcount=count($request->newguestemail);
          for($i=0;$i<$newguestcount;$i++){
            $newguestuser=new Eventuser;
            $newguestuser->attendess_email=$request->newguestemail[$i];
            $newguestuser->event_id=$updateevent->id;
            $newguestuser->type="Guest";
            $newguestuser->c_id=$request->c_id[$i];
            $newguestuser->c_type=$request->c_type[$i];
            //$newguestuser->responsestatus="Pending";
            $newguestuser->save();

            // Configuration
            $smtpAddress = 'smtp.zoho.com';
            $port = 465;
            $encryption = 'ssl';
            $yourEmail = $usermaildata->email;
            $yourPassword = $usermaildata->calendarpassword;
               // Prepare transport
            $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                    ->setUsername($yourEmail)
                    ->setPassword($yourPassword);
            $mailer = new \Swift_Mailer($transport);
                // Send email
            $message = (new \Swift_Message('Invitation:'.$request->title.''))
                 ->setFrom([ $yourEmail => $yourEmail])
                 ->setTo([$request->newguestemail[$i] => $request->newguestemail[$i]])
                 // If you want plain text instead, remove the second paramter of setBody
                 ->setBody("Meeting with patterns atDate: ".$dateofevent."Time: ".$startshow." to ".$endshow."", 'text/html');
            $mailer->send($message);
          }
         }
        //update guest eventuser  
        if(isset($request->guestemail)){
          $guesteventids=Eventuser::where([['event_id',$request->id],['type','Guest']])->get(); 
          $guestidarray=[];
          foreach($guesteventids as $guesteventid){
                $guestidarray[]=$guesteventid->id;
          }
          $guestcount=count($request->guestemail);
          for($i=0;$i<$guestcount;$i++){
            $updateguestemail=Eventuser::find($guestidarray[$i]);
            $updateguestemail->attendess_email=$request->guestemail[$i];
            //$updateguestemail->responsestatus="Pending";
            $updateguestemail->update();
          }
        }
        //add new user in eventuser
        if(isset($request->newuseremail)){
          $newusercount=count($request->newuseremail);
          for($i=0;$i<$newusercount;$i++){
            $newuser=new Eventuser;
            $newuser->attendess_email=$request->newuseremail[$i];
            $newuser->event_id=$updateevent->id;
            $newuser->type="User";
            $newuser->responsestatus="Pending";
            $newuser->save();
            // Configuration
            $smtpAddress = 'smtp.zoho.com';
            $port = 465;
            $encryption = 'ssl';
            $yourEmail = $usermaildata->email;
            $yourPassword = $usermaildata->calendarpassword;
               // Prepare transport
            $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                    ->setUsername($yourEmail)
                    ->setPassword($yourPassword);
            $mailer = new \Swift_Mailer($transport);
                // Send email
            $message = (new \Swift_Message('Invitation:'.$request->title.''))
                 ->setFrom([ $yourEmail => $yourEmail])
                 ->setTo([$request->newuseremail[$i] => $request->newuseremail[$i]])
                 // If you want plain text instead, remove the second paramter of setBody
                 ->setBody("Meeting with patterns atDate: ".$dateofevent."Time: ".$startshow." to ".$endshow."", 'text/html');
            $mailer->send($message);
          }
        }
        //update user  eventuser 
        if(isset($request->useremail)){
          $usereventids=Eventuser::where([['event_id',$request->id],['type','User']])->get(); 
          $useridarray=[];
          foreach($usereventids as $usereventid){
                $useridarray[]=$usereventid->id;
          }
          $usercount=count($request->useremail);
          for($i=0;$i<$usercount;$i++){
            $updateuseremail=Eventuser::find($useridarray[$i]);
            $updateuseremail->attendess_email=$request->useremail[$i];
            $updateuseremail->responsestatus="Pending";
            $updateuseremail->update();
          }
      }
        return redirect()->route('events1');

    }

    public function pStore(Request $request) {
                   //  dd($request->all());
                       //date_format($request->start, 'Y-m-d H:i:s')

                  $start_date =  $request->start_date ;
                 // dd($start_date);


           $data = array( 'title' =>$request->title , 'start_date' => 
             $start_date,     'end_date'=>  $start_date );

          if ($request->id > 0) {
           // Event::Create($data); 

          }
          else {
               Event::Create($data); 
          }

           

           return view('calendars.calendar_types' , compact('data'));
    }


     public function Modify_Event(Request $request)
    {
        // dd('hello');
        dd($request->all());
        return view('calendars.calendar_types');
    }

    public function  CallMethod(Request $request)
    {
        //dd($request->all());
        $start_date =  $request->start_date ;
        $scope   =   $request->scope;

        $data = array( 'title' => $request->title , 'start_date' => 
             $start_date,     'end_date'=>  $start_date , 'scope' => $request->scope );
        
        if ( $scope == 'Meeting')
                return view('meetings.addmeeting.view', compact('data'));
        else
               return view('tasks.create', compact('data'));
           
    }

    public function Event_Collect()
    {
        # code...
         $events = Event::all();
         $events_array =  $events->toArray();
         // dd($events_array);
          foreach ($events_array as $key) {
                

                //title: title,      start: start,   end: end,   allDay: allDay
                 $data[]  = [  'id' =>  $key['id'] ,  'title' => $key['title'] , 'allDay' => false, 'start' => $key['start_date'] , 'end' => $key['end_date'],
                                 ] ;
                 //        $data[] = [ 'id' => $key->id];
          }
          
          //dd($data);
          //  FROM HERE LEFT  WORKING IN  PATTERNS CRM AS NEW WORK CAME OF OSMV3.COM ON 02-08-19
                            // new \DateTime($value->start_date),
         return response()->json($data);
    }

    public function gototaskcontact($id){
      
       $whichtask = explode(',', $id);

       if ($whichtask[0] == 'Company' && strlen($whichtask[1]) != 10) {

           return redirect()->route('company.show', ['id' => $whichtask[1],'backto'=>"calendar".$whichtask[2]]);
       }
       elseif(strlen($whichtask[1]) == 10 ){
         //dd($whichtask[1]);
           
         return redirect()->action('ClickClientController@index', ['newid'=>$whichtask[1]]);
           // return redirect()->route('lead.show', ['id' => $leadid->lead_id,'backto'=>"calendar".$whichtask[2]]);
       }
       elseif($whichtask[0] == 'Lead'){
            $leadid=Company_Master::findorfail($whichtask[1]);

           return redirect()->route('lead.show', ['id' => $leadid->lead_id,'backto'=>"calendar".$whichtask[2]]);
       }
       else{
          return redirect()->route('client.show', ['id' => $whichtask[1],'backto'=>"calendar".$whichtask[2]]);
       }

    }
    public function notificationmessage(Request $request){

             $sendmessages=Event::where([['create_user_id',$request->userid],['flag',0]])->whereDate('start_date',Carbon::today('Asia/Kolkata'))->get();
             $b=0; 

            $min=10000000;
            $title="no task";
            $type="no type";
             foreach($sendmessages as $sendmessage){
                    $mytime=Carbon::now();
                     $datetime1 = strtotime($sendmessage->start_date);
                       $mytime = strtotime($mytime);
                     if($sendmessage->start_date > Carbon::now()){
                          $min=$datetime1 - $mytime;
                          if($min > $b){
                                $b=$min;
                          }
                          $title=$sendmessage->title;
                          $type=$sendmessage->type;
                     }            
             }
             return  response()->json(['min'=>$min,'title'=>$title,'type'=>$type]);
            
    }

}