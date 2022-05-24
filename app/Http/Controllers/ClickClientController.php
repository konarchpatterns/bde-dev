<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Client_disposition;
use App\Company_disposition;
use Auth;
use Carbon\Carbon;
use App\Event;
use Spatie\Activitylog\Models\Activity;
use App\Assignuser;
use jeremykenedy\LaravelRoles\Models\Role;
// use Illuminate\Support\Facades\Http;
class ClickClientController extends Controller
{
  public function index(Request $request)
  {

    return view('cickclient.index');
  }
  public function clickshowassigncompany(Request $request)
  {

    return view('cickclient.assigned');
  }
  public function clickshowunassigncompany(Request $request)
  {

    return view('cickclient.unassigned');
  }


  public function anydata($id)
  {
    $rolelevel = Role::where('slug', 'bde')->pluck('level');
    if (Auth::user()->level() >= $rolelevel[0]) {
      $userrole = 'bde';
      $username = Auth::user()->name;
    } else {
      $userrole = 'salse';
      $username = Auth::user()->name;
    }

    $postRequest1 = array(
      'id' =>  $id,
      'userrole' => $userrole,
      'username' => $username
    );

    $cURLConnection1 = curl_init('http://192.168.0.31/api/ddddregister');
   // $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/ddddregister');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);
    $someArray = json_decode($response, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }



/**
 *      testing functions start
 * 
 */



public function inactiveDataList($id)
{

  
  $rolelevel = Role::where('slug', 'bde')->pluck('level');
  if (Auth::user()->level() >= $rolelevel[0]) {
    $userrole = 'bde';
    $username = Auth::user()->name;
  } else {
    $userrole = 'salse';
    $username = Auth::user()->name;
  }

  $postRequest1 = array(
    'id' =>  $id,
    'userrole' => $userrole,
    'username' => $username,
    'status' => 'ALL'
  );
/*
 // $cURLConnection1 = curl_init('http://192.168.0.31/api/ddddregister');
  $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clientdata');
  curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
  curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($cURLConnection1);
  curl_close($cURLConnection1);
  $someArray = json_decode($response, true);
  */

  
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://192.168.0.31/api/clientdatadetail",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => json_encode($postRequest1),
    CURLOPT_HTTPHEADER => array(
    	// Set here requred headers
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$someArray=json_decode($response, true);
  return Datatables::of($someArray)
    ->addColumn('checkbox', function ($data) {
      // $checkboxvalue=$data->id;
      $btn = "";
      return $btn;
    })
    ->make(true);
}
public function inactiveApiData($id,$status)
{

  
  $rolelevel = Role::where('slug', 'bde')->pluck('level');
  if (Auth::user()->level() >= $rolelevel[0]) {
    $userrole = 'bde';
    $username = Auth::user()->name;
  } else {
    $userrole = 'salse';
    $username = Auth::user()->name;
  }

  $postRequest1 = array(
    'id' =>  $id,
    'userrole' => $userrole,
    'username' => $username,
   'status' => $status
  );
/*
 // $cURLConnection1 = curl_init('http://192.168.0.31/api/ddddregister');
  $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clientdata');
  curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
  curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($cURLConnection1);
  curl_close($cURLConnection1);
  $someArray = json_decode($response, true);
  */

  $curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://192.168.0.31/api/clientdatadetail",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30000,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => json_encode($postRequest1),
    CURLOPT_HTTPHEADER => array(
    	// Set here requred headers
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$someArray=json_decode($response, true);

  return Datatables::of($someArray)
    ->addColumn('checkbox', function ($data) {
      // $checkboxvalue=$data->id;
      $btn = "";
      return $btn;
    })
    ->make(true);
}


 /**
  *   testing function ends
  */

  public function assignedanydata($id)
  {
    $rolelevel = Role::where('slug', 'bde')->pluck('level');
    if (Auth::user()->level() >= $rolelevel[0]) {
      $userrole = 'bde';
      $username = Auth::user()->name;
    } else {
      $userrole = 'salse';
      $username = Auth::user()->name;
    }

    $postRequest1 = array(
      'id' =>  $id,
      'userrole' => $userrole,
      'username' => $username
    );

   // $cURLConnection1 = curl_init('http://192.168.0.31/api/userassignapi');
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/userassignapi');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);
    $someArray = json_decode($response, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }

  public function unassignedanydata($id)
  {

    $rolelevel = Role::where('slug', 'bde')->pluck('level');
    if (Auth::user()->level() >= $rolelevel[0]) {
      $userrole = 'bde';
      $username = Auth::user()->name;
    } else {
      $userrole = 'salse';
      $username = Auth::user()->name;
    }

    $postRequest1 = array(
      'id' =>  $id,
      'userrole' => $userrole,
      'username' => $username
    );

    $cURLConnection1 = curl_init('http://192.168.0.31/api/userunassignapi');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);
    $someArray = json_decode($response, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }

  public function predispositionentryclickcompany(Request $request)
  {

    $company_master_id = filter_var($request->company_id, FILTER_SANITIZE_NUMBER_INT);
    $comdisposition = new Company_disposition;
    $comdisposition->company_id = $company_master_id;
    $comdisposition->user_id = auth()->user()->id;
    $comdisposition->phonenumber = $request->companycallingnumber;
    $comdisposition->phonenumbertype = "no";
    $comdisposition->created_atus = Carbon::now('America/New_York');
    $comdisposition->save();
    activity()->disableLogging();
    $adddammy = Company_disposition::find($comdisposition->id);
    $adddammy->status = "Closed Window";
    $adddammy->update();

    activity()->enableLogging();
    return Response($comdisposition->id);
  }
  public function companyclickdispositionstore(Request $request)
  {
    $comdisposition = Company_disposition::find($request->id);

    $comdisposition->status = $request->status;

    $comdisposition->follow_up_date = $request->follow_up;
    $comdisposition->description = $request->description;
    $comdisposition->update();

    $lastdisposition = $comdisposition->created_at . "<br>" . $request->status;


    $postRequest1 = array(
      'company_id' =>  $comdisposition->company_id,
      'lastdisposition' => $lastdisposition
    );

  //  $cURLConnection1 = curl_init('http://192.168.0.31/api/clientlastdisposition');
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clientlastdisposition');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $apiResponse1 = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);


    if ($request->status == 'Follow Up' || $request->status == 'Call Back' || $request->status == 'Interested') {

      activity()->disableLogging();
      $storereminder = new Event;


      $storereminder->title = $request->status . ' to ' . " Company : " . $apiResponse1;
      $storereminder->timezone = "Company," . $comdisposition->company_id;


      $storereminder->description = $request->description;
      $storereminder->start_date = $request->follow_up;
      $storereminder->end_date = date('Y-m-d H:i', strtotime('+00 hour +30 minutes', strtotime($request->follow_up)));
      $storereminder->type = "task";
      $storereminder->flag = 0;
      $storereminder->create_user_id = auth()->user()->id;
      $storereminder->save();
      activity()->enableLogging();

      $description = 'title is ' . $request->status . ' to Company: ' . $apiResponse1 . ',start date is ' . $request->follow_up . ',end date is ' . date('Y-m-d H:i', strtotime('+00 hour +30 minutes', strtotime($request->follow_up))) . ',create user id is ' . auth()->user()->id;

      $data = array('log_name' => 'Company Task', 'causer_id' => auth()->user()->id, 'causer_type' => 'App\User', 'subject_type' => 'App\Event', 'subject_id' => $storereminder->id, 'description' => 'created', 'attributes1' => $description, 'attributes2' => $apiResponse1, 'attributes3' => $comdisposition->company_id, 'attributes4' => $comdisposition->company_id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now());
      $clientids = DB::table('activity_log')->insert($data);
    }
  }
  public function orderdetail(Request $request)
  {

    if (isset($request->frommodal)) {
      $request->company_id = DB::table('company_dispositions')->where('id', '=', $request->company_id)->value('company_id');
    }
    $postRequest1 = array(
      'id' =>  $request->company_id,
      'lastdisposition' => "no",
    );

//    $cURLConnection1 = curl_init('http://192.168.0.31/api/orderdetailapi');
      $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/orderdetailapi');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $apiResponse1 = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);
    $data = $apiResponse1;
    return $data;
  }
  public function assignuserfromtable(Request $request)
  {

    $companyids = $request->companyid;
    $selectedcompnyid = array_map('intval', explode(',', $request->companyid));
    $companyidlegnth = count($selectedcompnyid);

    for ($i = 0; $i < $companyidlegnth; $i++) {


      $checkassignuser = Assignuser::where([['company_id', '=', $selectedcompnyid[$i]], ['unassign', '=', 'assign']])->get();

      $countassignuser = count($checkassignuser);
      if ($countassignuser > 0) {
        foreach ($checkassignuser as $assignuser) {
          if ($assignuser->user_id == $request->userid) {
            $assignusernameapi = DB::table('users')->where('id', '=', $request->userid)->value('name');
            $assignbyusernameapi = DB::table('users')->where('id', '=', auth()->user()->id)->value('name');

            $postRequest1 = array(
              'assignuser' =>  $assignusernameapi,
              'assignby' => $assignbyusernameapi,
              'company_id' => $selectedcompnyid[$i],

            );

//            $cURLConnection1 = curl_init('http://192.168.0.31/api/clickassignuser');
            $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clickassignuser');
            curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
            curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

            $apiResponse1 = curl_exec($cURLConnection1);
            curl_close($cURLConnection1);
          } else {
            $assignusernameapi = null;
            $assignbyusernameapi = null;

            $postRequest1 = array(
              'assignuser' =>  $assignusernameapi,
              'assignby' => $assignbyusernameapi,
              'company_id' => $selectedcompnyid[$i],

            );

          //  $cURLConnection1 = curl_init('http://192.168.0.31/api/clickassignuser');
            $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clickassignuser');
            curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
            curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

            $apiResponse1 = curl_exec($cURLConnection1);
            curl_close($cURLConnection1);
            $changetounassun = Assignuser::find($assignuser->id);
            $changetounassun->unassign = "unassign";
            $changetounassun->unassign_by = auth()->user()->id;
            $changetounassun->update();
          }
        }
      }
      if (isset($assignuser->user_id)) {
        $matchid = $assignuser->user_id;
      } else {
        $matchid = 6;
      }
      if ($request->userid == 6 || $request->userid == $matchid) {
      } else {
        $assignusernameapi = DB::table('users')->where('id', '=', $request->userid)->value('name');
        $assignbyusernameapi = DB::table('users')->where('id', '=', auth()->user()->id)->value('name');

        $postRequest1 = array(
          'assignuser' =>  $assignusernameapi,
          'assignby' => $assignbyusernameapi,
          'company_id' => $selectedcompnyid[$i],

        );

      //  $cURLConnection1 = curl_init('http://192.168.0.31/api/clickassignuser');
        $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clickassignuser');
        curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
        curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

        $apiResponse1 = curl_exec($cURLConnection1);
        curl_close($cURLConnection1);

        $assignuserentry = new Assignuser;
        $assignuserentry->company_id = $selectedcompnyid[$i];
        $assignuserentry->user_id = $request->userid;
        $assignuserentry->assign_by = auth()->user()->id;
        $assignuserentry->save();
      }


      //  $user1=User::where('id',$request->userid)->get();

      // $details = [
      // 'data' =>"{$companyidlegnth} leads has been assigned to you by ".auth()->user()->name.".",  
      //  ];
      // Notification::send($user1, new AssignuserNotification($details)); 






    }
  }
  public function dispositiondetail(Request $request)
  {

    if ($request->frommodal == 'simple') {

      $infos = DB::table('company_dispositions')->where('company_id', '=', $request->company_id)->orderBy('created_at', 'desc')->limit(1)->get();

      if (count($infos) > 0) {
        foreach ($infos as $info) {
        }
        $data = "<h5>status : " . $info->status . "</h5><h5>Date : " . $info->created_at . "</h5><h5>Follow Up Date : " . $info->follow_up_date . "</h5></h5><h5>Description : " . $info->description . "</h5>";
        return $data;
      } else {
        return "No Dispositon";
      }
    } else {
      $companyid = DB::table('company_dispositions')->where('id', '=', $request->company_id)->value('company_id');
      $infos = DB::table('company_dispositions')->where('company_id', '=', $companyid)->orderBy('created_at', 'desc')->skip(1)->take(1)->get();
      if (count($infos) > 0) {
        foreach ($infos as $info) {
        }
        $data = "<h5>status : " . $info->status . "</h5><h5>Date : " . $info->created_at . "</h5><h5>Follow Up Date : " . $info->follow_up_date . "</h5></h5><h5>Description : " . $info->description . "</h5>";
        return $data;
      } else {
        return "No Dispositon";
      }
    }
  }
  public function showcompany()
  {

    return "No Data";
  }
  public function clicknewcompany(Request $request)
  {



    return view('clicknewcompany.viewnewcompany.view');
  }

  public function clicknewcompanyanydata($id)
  {
    $newvalue = explode('^', $id);
    if (isset($newvalue[2])) {

      $newvsalue2 = $newvalue[2];
    } else {

      $newvsalue2 = "";
    }

    $postRequest1 = array(
      'filteroption' => $newvalue[0],
      'selectedoption' => $newvalue[1],
      'newvsalue2' => $newvsalue2,
    );

  //  $cURLConnection1 = curl_init('http://192.168.0.31/api/clicknewcompany');
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clicknewcompany');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $apiResponse1 = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);

    $someArray = json_decode($apiResponse1, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }



  public function assignclicknewcompany(Request $request)
  {

    return view('clicknewcompany.viewassignnewcompany.view');
  }

  public function assignclicknewcompanyanydata($id)
  {
    $newvalue = explode('^', $id);
    if (isset($newvalue[2])) {

      $newvsalue2 = $newvalue[2];
    } else {

      $newvsalue2 = "";
    }

    $postRequest1 = array(
      'filteroption' => $newvalue[0],
      'selectedoption' => $newvalue[1],
      'newvsalue2' => $newvsalue2,
    );

  //  $cURLConnection1 = curl_init('http://192.168.0.31/api/assignclicknewcompany');
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/assignclicknewcompany');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $apiResponse1 = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);

    $someArray = json_decode($apiResponse1, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }


  public function unassignclicknewcompany(Request $request)
  {

    return view('clicknewcompany.viewunassignnewcompany.view');
  }
  public function unassignclicknewcompanyanydata($id)
  {
    $newvalue = explode('^', $id);
    if (isset($newvalue[2])) {

      $newvsalue2 = $newvalue[2];
    } else {

      $newvsalue2 = "";
    }

    $postRequest1 = array(
      'filteroption' => $newvalue[0],
      'selectedoption' => $newvalue[1],
      'newvsalue2' => $newvsalue2,
    );

//    $cURLConnection1 = curl_init('http://192.168.0.31/api/unassignclicknewcompany');
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/unassignclicknewcompany');
    curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $apiResponse1 = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);

    $someArray = json_decode($apiResponse1, true);
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
  }
  public function viewInactiveData(Request $request)
  {
    $cURLConnection1 = curl_init('http://127.0.0.1:8000/api/clientdata');
   // curl_setopt($cURLConnection1, CURLOPT_POSTFIELDS, $postRequest1);
    curl_setopt($cURLConnection1, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($cURLConnection1);
    curl_close($cURLConnection1);
    $someArray = json_decode($response, true);
    /*
    return Datatables::of($someArray)
      ->addColumn('checkbox', function ($data) {
        // $checkboxvalue=$data->id;
        $btn = "";
        return $btn;
      })
      ->make(true);
      */
    return view('cickclient.dataTest',array("apiData"=>$someArray));
  }
}
