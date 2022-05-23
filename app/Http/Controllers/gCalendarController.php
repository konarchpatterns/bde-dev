<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_EventAttendee;
use Redirect;
use Illuminate\Http\Request;
use App\Event;
use App\Eventuser;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Validator;
use Session;
class gCalendarController extends Controller
{
    protected $client;
    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->setAccessType("offline");
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
       
        
        
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        session_start();
   
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      
            $this->client->setAccessToken($_SESSION['access_token']);
    
            if($this->client->isAccessTokenExpired()){
          
                 session_destroy();
                 session_start();
             
            }
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            // $optParams = array(
            //   'maxResults' => 10,
            //   'orderBy' => 'startTime',
            //   'singleEvents' => true,
            //   'timeMin' => date('c'),
            // );
            // $results = $service->events->listEvents($calendarId, $optParams);
             $results = $service->events->listEvents($calendarId);

            $events=$results->getItems();
            $data=[];
            foreach($events as $event){
             $checkevents=Event::where('google_id',$event->id)->get();
             if(count($checkevents) == 0){
                $localevent = new Event;
                $localevent->google_id=$event->id;
                $localevent->title=$event->getSummary();
                if ( !empty ( $event->getStart()->getDateTime() ) ) {
                    $startdate=$event->getStart()->getDateTime();
                    $startdate = substr($startdate, 0, strpos($startdate, "+"));
                    $localevent->start_date=$startdate;
                }
                else{
                    $localevent->start_date=$event->getStart()->getDate();
                }
                if ( !empty ( $event->getStart()->getDateTime() ) ) {
                    $enddate=$event->getEnd()->getDateTime();
                    $enddate=substr($enddate, 0, strpos($enddate, "+"));
                    $localevent->end_date=$enddate;
                }
                else{
                      $localevent->end_date=$event->getEnd()->getDate();
                }
               // $event->timezone=$request->time_zone;
                $localevent->description=$event->description;
                $localevent->create_user_id=auth()->user()->id;
                $localevent->flag=0;
                $localevent->save();
                foreach($event->attendees as $attend){
                    $attenduser=new Eventuser;
                    $attenduser->attendess_email=$attend->email;
                    $result = Str::endsWith($attend->email, 'patterns247.net');
                    if($result == true ){
                         $attenduser->type="User";
                    }
                    else{
                         $attenduser->type="Guest";
                    }
                    $attenduser->event_id= $localevent->id;
                    $attenduser->responsestatus=$attend->responseStatus;
                    $attenduser->save();

                }
               }
               else{
                  foreach ($checkevents as $checkevent) {
                    
                  }
                   $ulocalevent =Event::find($checkevent->id); 

                   $ulocalevent->title=$event->getSummary();
                   if ( !empty ( $event->getStart()->getDateTime() ) ) {
                    $startdate=$event->getStart()->getDateTime();
                    $startdate = substr($startdate, 0, strpos($startdate, "+"));
                    $startdate = Str::replaceFirst('T', ' ',$startdate );
                       if($startdate != $checkevent->start_date){
                        dd($checkevent->start_date ." ". $startdate);
                       $ulocalevent->start_date=$startdate;
                       }
                    }
                    else{
                         $storestartdate = substr($checkevent->start_date, 0, strpos($checkevent->start_date, " "));
                        if($storestartdate != $event->getStart()->getDate()){
                            $ulocalevent->start_date=$event->getStart()->getDate();
                        }
                    }
                    if ( !empty ( $event->getStart()->getDateTime() ) ) {
                        $enddate=$event->getEnd()->getDateTime();
                        $enddate=substr($enddate, 0, strpos($enddate, "+"));
                        $enddate = Str::replaceFirst('T', ' ',$enddate );
                        if($enddate != $checkevent->end_date){
                            $ulocalevent->end_date=$enddate;
                        }
                    }
                    else{
                        $storeenddate = substr($checkevent->end_date, 0, strpos($checkevent->end_date, " "));
                        if($storeenddate != $event->getEnd()->getDate()){
                          $ulocalevent->end_date=$event->getEnd()->getDate();
                       }
                    }
                    $ulocalevent->description=$event->description;
                    $ulocalevent->update();

                    if(count($event->attendees) > 0){ 

                        foreach($event->attendees as $attend){
                          $findeventuser=Eventuser::where([['event_id',$ulocalevent->id],['attendess_email',$attend->email]])->pluck('id');
                          if(count($findeventuser)>0){
                             $updateeventuser=Eventuser::find($findeventuser[0]);
                             $updateeventuser->attendess_email=$attend->email;
                             $result = Str::endsWith($attend->email, 'patterns247.net');
                             if($result == true ){
                                 $updateeventuser->type="User";
                             }
                             else{
                                 $updateeventuser->type="Guest";
                             }
                            $updateeventuser->responsestatus=$attend->responseStatus;
                            $updateeventuser->update();

                          }
                          else{
                                $attenduser=new Eventuser;
                                $attenduser->attendess_email=$attend->email;
                                $result = Str::endsWith($attend->email, 'patterns247.net');
                                if($result == true ){
                                     $attenduser->type="User";
                                }
                                else{
                                     $attenduser->type="Guest";
                                }
                                $attenduser->event_id= $ulocalevent->id;
                                $attenduser->responsestatus=$attend->responseStatus;
                                $attenduser->save();

                          }
                        }
                    }
              
                    
                }
                // $subarray=[
                //     'id'=>$event->id,
                //     'de'=>$event->description,
                //     'title'=>$event->getSummary(),
                //     'stratdate'=>$event->getStart()->getDate(),
                //     'enddate'=>$event->getEnd()->getDate(),
                //     'attendis'=>$event->attendees,
                //     'start_date'=>$event->getStart()->getDateTime(),
                //     'end_date'=>$event->getEnd()->getDateTime()
                // ];
               
                 
                // array_push($data,$subarray);
            }
            // dd($data);
             return redirect()->route('events1');
                


        } else {

            return redirect()->route('oauthCallback');
        }
    }
    public function oauth()
    {
      
        session_start();
        $rurl = action('gCalendarController@oauth');

        $this->client->setRedirectUri($rurl);
     
        if (!isset($_GET['code'])) {
             
            $auth_url = $this->client->createAuthUrl();
            
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);

            $connected = @fsockopen("www.gmail.com", 80); 
            if($connected){
                
                    return redirect($filtered_url);         
            }
            else{
                 return view('error.nointernet');
                
            }
           
         

        } else {
         
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
             return redirect()->route('gcalendar.index');
              // return redirect()->route('events1');
            // return view('meeting.addmeeting.view');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar.createEvent');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $v = Validator::make($request->all(), [
             'guestname.*'=>'email',
             'username.*'=>'email',
            'start_date'=>'date'
    ]);
    if( $v->fails()){
      
           return Redirect::back()->withErrors($v);
    }
 
    $ab[]=array('email' => auth()->user()->email,'comment'=>'Organiser','responseStatus'=>'accepted');

    if(isset($request->username)) {
          foreach($request->username as $key => $input) {
                    $ab[]=array('email' => $request->username[$key]);                       
                 }
    }

    if(isset($request->guestname)){
          foreach($request->guestname as $key => $input) {
                       $ab[]= array('email' => $request->guestname[$key]);
                 }
    }
   
        session_start();      
        // $startDateTime1 = str_replace(':', '-',$request->start_date);
        // $startDateTime1 = str_replace('/', '-',$startDateTime1);
        // $startDateTime1 = str_replace(' ', '-', $startDateTime1);
        // $startDateTime2 = explode('-', $startDateTime1);

        // $EndDateTime1 = str_replace(':', '-',$request->start_date);
        // $EndDateTime1 = str_replace('/', '-',$EndDateTime1);
        // $EndDateTime1 = str_replace(' ', '-', $EndDateTime1);
        // $EndDateTime2 = explode('-', $EndDateTime1);
       
        //  $startDateTime= Carbon::create($startDateTime2[0], $startDateTime2[1], $startDateTime2[2], $startDateTime2[3], $startDateTime2[4], 00, 'GMT');
        //  $endDateTime= Carbon::create($EndDateTime2[0], $EndDateTime2[1], $EndDateTime2[2], $EndDateTime2[3], $EndDateTime2[4], 00, 'GMT');
         $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();
         $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
         $timezone=$request->time_zone;
      
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
             
            $this->client->setAccessToken($_SESSION['access_token']);
             if($this->client->isAccessTokenExpired()){
         
                 session_destroy();
                 session_start();
             
            }
            $service = new Google_Service_Calendar($this->client);
            $calendarId = 'primary';
            $event = new Google_Service_Calendar_Event([
                'summary' => $request->title,
             
                'description' => $request->description,
                'start' => ['dateTime' => $startDateTime,'timeZone' => $timezone],
                'end' => ['dateTime' => $endDateTime,'timeZone' => $timezone],
                'reminders' => ['useDefault' => true],
                'attendees' => $ab,
                 'overrides' => array(
                          array('method' => 'email', 'minutes' => 24 * 60),
                          array('method' => 'popup', 'minutes' => 10),
                        ),
                // 'alwaysIncludeEmail'=>'true',
            
                // 'sendUpdates'=>'all',
                // "guestsCanInviteOthers" => false,
                 "guestsCanModify" => true,
                "guestsCanSeeOtherGuests" => false,
            ]);
            $sendNotifications = array('sendNotifications' => true);
            $results = $service->events->insert($calendarId,$event,$sendNotifications);
            if (!$results) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
           return redirect()->route('gcalendar.index');
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        session_start();

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);
            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, $eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();
            // dd($startDateTime);
            $eventDuration = 30; //minutes
            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }
            // retrieve the event from the API.
            $event = $service->events->get('primary', $eventId);
            $event->setSummary($request->title);
            $event->setDescription($request->description);
            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);
            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

          
            $updatedEvent = $service->events->update('primary', $event->getId(), $event);

            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $updatedEvent]);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
            $service->events->delete('primary', $eventId);
        } else {
            return redirect()->route('oauthCallback');
        }
    }
     public function update1(Request $request)
    {
    $v = Validator::make($request->all(), [
            'guestname.*'=>'required|email',
            'username.*'=>'required|email',
            'newuseremail.*'=>'required|email',
            'newguestemail.*'=>'required|email'
    ]);
    if( $v->fails()){
           return Redirect::back()->withErrors($v);
    }
        session_start();
        $checkflag=Event::find($request->id);
         if($checkflag->flag == 1){
                
                 return redirect()->route('events1');
            }
        $ab=[];
        if(isset($request->useremail)){
            foreach($request->useremail as $key => $input) {
                 $ab[]=array('email' => $request->useremail[$key],'responseStatus'=>$request->userresponsestatus);
                   
             }
        }
         if(isset($request->guestemail)){
            foreach($request->guestemail as $key => $input) {
                 $ab[]=array('email' => $request->guestemail[$key],'responseStatus'=>$request->guestresponsestatus);
             }
        }
        if(isset($request->newuseremail)){
            foreach($request->newuseremail as $key => $input) {
                 $ab[]=array('email' => $request->newuseremail[$key]);
                   
             }
        }
       
        if(isset($request->newguestemail)){
            foreach($request->newguestemail as $key => $input) {
                 $ab[]=array('email' => $request->newguestemail[$key]);
             }
        } 


        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
             $service1 = new Google_Service_Calendar($this->client);
            $startDateTime = Carbon::parse($request->start_date)->toRfc3339String();
            //dd($request->google_id);
            $eventDuration = 30; //minutes
            if ($request->has('end_date')) {
                $endDateTime = Carbon::parse($request->end_date)->toRfc3339String();
            } else {
                $endDateTime = Carbon::parse($request->start_date)->addMinutes($eventDuration)->toRfc3339String();
            }
           // retrieve the event from the API.
            $event = $service->events->get('primary', $request->google_id);
            //dd($event);
            $event->setSummary($request->title);
            $event->setDescription($request->description);
            //start time
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($startDateTime);
            $event->setStart($start);
            //end time
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime($endDateTime);
            $event->setEnd($end);

          //   if(($event->attendees)>0){
          //   foreach($event->attendees as $att){
          //        // $attendee1 = new Google_Service_Calendar_EventAttendee();
          //        // $attendee1->setEmail($att->email);
          //        // $attendees = array($attendee1);
          //        $ab[]=array('email' => $att->email);
                 
          //    }
          // }  
           
          $event->attendees = $ab; 

               // dd($event->attendees);
 


    
      
            //  $event = new Google_Service_Calendar_Event([
            //     'summary' => $request->title,
             
            //     'description' => $request->description,
            //     'start' => ['dateTime' => $startDateTime,'timeZone' => 'Asia/Kolkata'],
            //     'end' => ['dateTime' => $endDateTime,'timeZone' => 'Asia/Kolkata'],
            //     'reminders' => ['useDefault' => true],

            //     'attendees' => $ab,
            //      'overrides' => array(
            //               array('method' => 'email', 'minutes' => 24 * 60),
            //               array('method' => 'popup', 'minutes' => 10),
            //             ),
            //     // 'alwaysIncludeEmail'=>'true',
            
            //     // 'sendUpdates'=>'all',
            //     "guestsCanInviteOthers" => false,
            //     "guestsCanModify" => false,
            //     "guestsCanSeeOtherGuests" => false,
            // ]);
            $sendNotifications = array('sendNotifications' => true);
            $updatedEvent = $service->events->update('primary', $event->getId(), $event,$sendNotifications);
              
            if (!$updatedEvent) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return redirect()->route('gcalendar.index');
        } else {
            return redirect()->route('oauthCallback');
        }
    }
    public function delete(Request $request){
         session_start();
         if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

            $deleteevent=Event::find($request->id);
            if($deleteevent->flag == 1){
                
                 return redirect()->route('events1');
            }
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);
             $sendNotifications = array('sendNotifications' => true);
            $service->events->delete('primary', $deleteevent->google_id,$sendNotifications);
            $deleteevent->flag=1;
            $deleteevent->update();
            $activity = Activity::all()->last();
            $activity->update(['description'=>'Delete','attributes1'=> $deleteevent->titel .' Deleted.']);
            $deleteeventusers=Eventuser::where('event_id',$request->id)->get();
            foreach ($deleteeventusers as $deleteeventuser) {
               $deluser=Eventuser::find($deleteeventuser->id);
               $deluser->flag=1;
               $deluser->update();
               $activity = Activity::all()->last();
               $activity->update(['description'=>'Delete','attributes1'=>  $deluser->attendess_email . ' Deleted.']);

            }
            
            return redirect()->route('events1');
         } else {
            return redirect()->route('oauthCallback');
         }
    
  }
    public function zoho(Request $request){
      
            foreach($request->all() as $scode){

            }
             // dd($request->code);
            

            $data1 = [
                // 'code' => $request->code,
                // 'grant_type' => 'authorization_code',
                // 'client_id'=>'1000.PGPSL854HVZ9KLF23IZGL1T99VLHRH',
                // 'client_secret'=>'d9c70f8292126be0a1f7c1a38a69b1e4ca2a24ba09',
                // 'redirect_uri'=>'http://localhost/patternscrm/public/oauth2callback',
                // 'scope'=>'ZohoCalendar.event.CREATE',
            ];
// "https://accounts.zoho.com/oauth/v2/token?code=".$request->code."&grant_type=authorization_code&client_id=1000.PGPSL854HVZ9KLF23IZGL1T99VLHRH&client_secret=d9c70f8292126be0a1f7c1a38a69b1e4ca2a24ba09&redirect_uri=http://localhost/patternscrm/public/oauth2callback&scope=ZohoCalendar.event.CREATE"
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://accounts.zoho.com/oauth/v2/token?code=".$request->code."&grant_type=authorization_code&client_id=1000.PGPSL854HVZ9KLF23IZGL1T99VLHRH&client_secret=d9c70f8292126be0a1f7c1a38a69b1e4ca2a24ba09&redirect_uri=http://localhost/patternscrm/public/oauth2callback&scope=ZohoCalendar.event.CREATE,ZohoCalendar.event.READ",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data1),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            //return redirect('inserteventzoho');
            
            //curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                print_r(json_decode($response));
            }
  


          
                 

           //  $url="http://calendar.zoho.com/api/v1/calendars/w9QSuARmSjO1sEmv91zOaw==/".$encodedSku."";
           //  return Redirect::to($url);
                       // dd($encodedSku);
    }
    public function zoho1(Request $request){

            $curl = curl_init();

                curl_setopt_array($curl, array(
    CURLOPT_URL => "https://calendar.zoho.com/api/v1/calendars/694545925/events",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "post",
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                dd($response);
                // curl_close($response);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    print_r(json_decode($response));
                }

            $events= [
                        "title"  =>"my friend birthday",
                        "uid"  => "694545925",
                        'enable_eventmanagement'  => "false",
                        "etag"  =>1476715187436,
                        "location" => "Chennai",
                        "caluid" => "ea1e997e2ffcb3b53883b6fad29478f8b3c148e2d9bbf6fedbf303700bd39feaffbec27981ff963e541476b31f40fbf6",
                        "multiday" => "false",
                        "createdby" => "divyaraj@patterns247.net",
                        "organizer"  =>"divyaraj@patterns247.net",
                        "modifiedby"  =>"divyaraj@patterns247.net",
                        "type"  =>0,
                        "lastmodifiedtime"  =>"20161017T143947Z",
                        "isprivate"  =>"false",
                        "duration" => "3600000",
                        "eurlid" => "4594000004684005",
                        "estatus"  =>"added",
                        "color"  =>"3",
                        "createdtime"  =>"20161017T14Z",
                        "multiday" =>"false",
                        "calid" =>2000000000093,
                        "start"  => "20191117T163000",
                        "end"  => "20191117T195500",
                        "calendar_alarm" => "false",
                        ];

            //             $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://calendar.zoho.com/api/v1/calendars/694545925/events",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($events),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));

            // $response = curl_exec($curl);
            // $err = curl_error($curl);
            //    curl_close($curl);
    }
}