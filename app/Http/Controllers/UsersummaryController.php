<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Assignuser;
use App\Client_Master;
use App\Company_Master;
use App\Company_disposition;
use App\Client_disposition;
use Carbon\Carbon;
use DataTables;
use Auth;
use Redirect;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersummaryController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }
   public function index()
   {
      if (Auth::user()->hasRole('data.entry.manager')) {
         return view('usersummaryinfo.dataentrysummary.view');
      } elseif (Auth::user()->hasPermission('view.users')) {
         return view('usersummaryinfo.viewusersummary.view');
      } else {
         return view('error.403');
      }
   }
   public function anydata()
   {

      $q1 = DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'assign') as currnetlyallocated");
      // $q2=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id ) as totalallocatedd");
      // $q3=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'unassign') as unallocated");

      $rolelevel = Role::where('slug', 'bde')->pluck('level');
      if (Auth::user()->level() == $rolelevel[0]) {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', 'users.flag', DB::raw('count(assignusers.id) AS totalallocatedd'), $q1)->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.team_leader_id', '=', Auth::user()->id], ['users.designation', '=', 'Sales Executives']])
            ->distinct()->groupBy('users.id', 'users.name', 'users.flag');
      } else if (Auth::user()->level() > $rolelevel[0] || Auth::user()->name === 'nirav mandli' || Auth::user()->name === 'Amit Thakur') {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', 'users.flag', $q1, DB::raw('count(assignusers.id) AS totalallocatedd'))->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.designation', '=', 'Sales Executives']])
            ->distinct()->groupBy('users.id', 'users.name', 'users.flag');
      }


      return Datatables::of($data)
         ->editColumn('name', function ($data) {
            $show = route('user.usersummaryshow', ['id' => $data->id]);
            $username = $data->name;
            $btn = "<a href='{$show}'>{$username}</a>";
            return $btn;
         })
         ->addColumn('unallocated', function ($data) {

            return "nodata";
         })
         ->addColumn('todaycountdisposition', function ($data) {
            $date = Carbon::now('America/New_York');
            $todaycountdisposition = DB::table('company_dispositions')->where('user_id', $data->id)->whereDate('created_atus',  $date->toDateString())->count();
            //dd($todaycountdisposition);
            return $todaycountdisposition;
         })
         ->escapeColumns([])
         ->make(true);
   }
   //

   public function anydatai()
   {

      $q1 = DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'assign') as currnetlyallocated");
      // $q2=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id ) as totalallocatedd");
      // $q3=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'unassign') as unallocated");

      $rolelevel = Role::where('slug', 'bde')->pluck('level');
      if (Auth::user()->level() == $rolelevel[0]) {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', 'users.flag', DB::raw('count(assignusers.id) AS totalallocatedd'), $q1)->where([['users.flag', '=', '1'], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.team_leader_id', '=', Auth::user()->id], ['users.designation', '=', 'Sales Executives']])
            ->distinct()->groupBy('users.id', 'users.name', 'users.flag');
      } else if (Auth::user()->level() > $rolelevel[0] || Auth::user()->name === 'nirav mandli' || Auth::user()->name === 'Amit Thakur') {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', 'users.flag', $q1, DB::raw('count(assignusers.id) AS totalallocatedd'))->where([['users.flag', '=', '1'], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.designation', '=', 'Sales Executives']])
            ->distinct()->groupBy('users.id', 'users.name', 'users.flag');
      }


      return Datatables::of($data)
         ->editColumn('name', function ($data) {
            $show = route('user.usersummaryshow', ['id' => $data->id]);
            $username = $data->name;
            $btn = "<a href='{$show}'>{$username}</a>";
            return $btn;
         })
         ->addColumn('unallocated', function ($data) {

            return "nodata";
         })
         ->addColumn('todaycountdisposition', function ($data) {
            $date = Carbon::now('America/New_York');
            $todaycountdisposition = DB::table('company_dispositions')->where('user_id', $data->id)->whereDate('created_atus',  $date->toDateString())->count();
            //dd($todaycountdisposition);
            return $todaycountdisposition;
         })
         ->escapeColumns([])
         ->make(true);
   }
   //bde user summary
   public function bdeanydata()
   {
      $q1 = DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'assign') as currnetlyallocated");
      // $q2=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id ) as totalallocatedd");
      // $q3=DB::raw("(SELECT COUNT('assignusers.id') FROM assignusers WHERE assignusers.user_id = users.id and assignusers.unassign= 'unassign') as unallocated");

      $rolelevel = Role::where('slug', 'bde')->pluck('level');
      if (Auth::user()->level() == $rolelevel[0]) {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', DB::raw('count(assignusers.id) AS totalallocatedd'), $q1)->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.id', '=', Auth::user()->id], ['users.designation', '=', 'Business Development Manager']])
            ->distinct()->groupBy('users.id', 'users.name');
      } else if (Auth::user()->level() > $rolelevel[0] || Auth::user()->name === 'nirav mandli' || Auth::user()->name === 'Amit Thakur') {
         $data = DB::table('users')
            ->leftJoin('assignusers', 'users.id', '=', 'assignusers.user_id')
            ->select('users.id', 'users.name', $q1, DB::raw('count(assignusers.id) AS totalallocatedd'))->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '!=', 'Admin'], ['users.designation', '=', 'Business Development Manager']])
            ->distinct()->groupBy('users.id', 'users.name');
      }


      return Datatables::of($data)
         ->addColumn('uname', function ($data) {
            $show = route('user.usersummaryshow', ['id' => $data->id]);
            $username = $data->name;
            $btn = "<a href='{$show}'>{$username}</a>";
            return $btn;
         })
         ->addColumn('unallocated', function ($data) {

            return "nodata";
         })
         ->escapeColumns([])
         ->make(true);
   }
   public function anydataentery()
   {
      $rolelevel = Role::where('slug', 'bde')->pluck('level');
      if (Auth::user()->level() == $rolelevel[0]) {
         $data = DB::table('users')
            ->leftJoin('company_masters', 'users.id', '=', 'company_masters.created_user_id')
            ->select('users.id', 'users.name', DB::raw('count(company_masters.id) AS totalcreated'))->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '=', 'Data Entry'], ['users.team_leader_id', '=', Auth::user()->id]])
            ->distinct()->groupBy('users.id', 'users.name');
      } else if (Auth::user()->level() == 10) {
         $data = DB::table('users')
            ->leftJoin('company_masters', 'users.id', '=', 'company_masters.created_user_id')
            ->select('users.id', 'users.name', DB::raw('count(company_masters.id) AS totalcreated'))->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '=', 'Data Entry'], ['users.team_leader_id', '=', Auth::user()->id]])
            ->distinct()->groupBy('users.id', 'users.name');
      } else if (Auth::user()->level() > $rolelevel[0] || Auth::user()->name === 'nirav mandli' || Auth::user()->name === 'Amit Thakur') {
         $data = DB::table('users')
            ->leftJoin('company_masters', 'users.id', '=', 'company_masters.created_user_id')
            ->select('users.id', 'users.name', DB::raw('count(company_masters.id) AS totalcreated'))
            ->where([['users.flag', '=', 0], ['users.id', '!=', 6], ['users.designation', '=', 'Data Entry']])
            ->distinct()
            ->groupBy('users.id', 'users.name');
      }


      return Datatables::of($data)
         ->addColumn('udataentryname', function ($data) {
            $show = route('user.userdataentrysummaryshow', ['id' => $data->id]);
            $username = $data->name;
            $btn = "<a href='{$show}'>{$username}</a>";
            return $btn;
         })

         ->escapeColumns([])
         ->make(true);
   }
   public function usersummaryshow($id)
   {
      $user = User::find($id);
      $currentlyassigncompanydata = Assignuser::where([['user_id', '=', $user->id], ['unassign', '=', 'assign']])->count();
      $unassigncompanydata = Assignuser::where([['user_id', '=', $user->id], ['unassign', '=', 'unassign']])->count();
      $totalassigncompanydata = Assignuser::where('user_id', '=', $user->id)->count();
      $totalcall = Company_disposition::where('user_id', '=', $user->id)->count();
      $totaldisposition = Company_disposition::where('user_id', '=', $user->id)->count();


      //today disposition count 
      $date = Carbon::now('America/New_York');
      $typedetail = 'Today (' . $date->toDateString() . ')';
      $todaycountdisposition = DB::table('company_dispositions')->where('user_id', $user->id)->whereDate('created_atus',  $date->toDateString())->count();
      $comdispositionreports = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->where('user_id', $user->id)->groupBy('company_dispositions.status')->get();

      $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
      if (count($comdispositionreports) > 0) {
         $alldisposition = "";
         $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
         $dispositionlistarray = explode(',', $dispositionlist);

         foreach ($comdispositionreports as $comdispositionreport) {

            $alldisposition .= "<tr><td>" . $comdispositionreport->status . "</td><td>" . $comdispositionreport->count . "</td></tr>";
         }
      }
      //today company that called count
      $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->where('user_id', $user->id)->distinct('company_dispositions.company_id')->get();

      $companycalled = count($companycalled);

      return view('usersummaryinfo.showusersummary.view', compact('currentlyassigncompanydata', 'unassigncompanydata', 'totalassigncompanydata', 'totalcall', 'totaldisposition', 'user', 'alldisposition', 'todaycountdisposition', 'typedetail', 'companycalled'));
   }
   public function userdataentrysummaryshow($id)
   {
      if (Auth::user()->hasRole('data.entry.manager')) {
      } elseif (Auth::user()->hasPermission('view.users')) {
      } else {
         return view('error.403');
      }
      $user = User::find($id);
      $todayus = Carbon::now('America/New_York');
      $numberofcompany = Company_Master::where('created_user_id', '=', $user->id)->pluck('id');
      $numberofcompanycount = count($numberofcompany);
      $todaycompnycount = DB::table('company_masters')->where('created_user_id', '=', $user->id)->whereDate('created_atus', $todayus)->count();
      //current month company count
      $yearcount = Carbon::now('America/New_York')->format('Y');
      $monthcount = Carbon::now('America/New_York')->format('m');

      $companycounttabledatewise = "";
      //        $yearcount30days =Carbon::now('America/New_York');

      for ($i = 1; $i <= 31; $i++) {
         $companycountdate = $yearcount . "-" . $monthcount . "-" . $i;
         $companycounttabledatewise .= "<tr><td>" . $companycountdate . "</td><td>" . DB::table('company_masters')->where('created_user_id', '=', $user->id)->whereDate('created_atus', $companycountdate)->count() . "</td></tr>";
      }

      //inserted company count monthwise
      $companycounttable = "";
      $yearcount = Carbon::now('America/New_York')->format('Y');
      $monthtitle = ['1' => 'Jan.', '2' => 'Feb.', '3' => 'Mar.', '4' => 'Apr.', '5' => 'May', '6' => 'Jun.', '7' => 'Jul.', '8' => 'Aug.', '9' => 'Sep.', '10' => 'Oct.', '11' => 'Nov.', '12' => 'Dec.'];
      for ($i = 1; $i <= 12; $i++) {
         $companycounttable .= "<tr><td>" . $monthtitle[$i] . "</td><td>" . DB::table('company_masters')->where('created_user_id', '=', $user->id)->whereMonth('created_atus', $i)->whereYear('created_atus', $yearcount)->count() . "</td></tr>";
      }

      $comdispositionreports = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereIn('company_id', [$numberofcompany])->groupBy('company_dispositions.status')->get();
      $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";

      if (count($comdispositionreports) > 0) {
         $alldisposition = "";
         $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
         $dispositionlistarray = explode(',', $dispositionlist);

         foreach ($comdispositionreports as $comdispositionreport) {

            $alldisposition .= "<tr><td>" . $comdispositionreport->status . "</td><td>" . $comdispositionreport->count . "</td></tr>";
         }
      }

      return view('usersummaryinfo.showdataentryusersummary.view', compact('alldisposition', 'user', 'numberofcompany', 'numberofcompanycount', 'todaycompnycount', 'companycounttable', 'todayus', 'companycounttabledatewise', 'monthtitle', 'yearcount', 'monthcount'));
   }
   public function currnetlyallocated(Request $request)
   {

      $username = User::where('id', $request->user_id)->pluck('name');
      $datas = DB::table('assignusers')
         ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
         ->where([['user_id', $request->user_id], ['unassign', 'assign']])
         ->groupBy('date')
         ->get();
      $uid = $request->user_id;
      $createddate = '';
      $output =  '';
      $i = 1;
      $username1 = "Currently assigned company of " . $username[0] . "";
      foreach ($datas as $data) {
         // $createddate=date_format($data->created_at, 'Y-m-d');

         $output .= '<tr>' . '<td>' . $i . '</td>' . '<td>' . $username[0] . '</td>' . '<td value="' . $data->date . '" class="selectdate">' . $data->date . '</td>' .
            '<td>' . $data->views . '</td>'
            . '</tr>';

         $i++;
      }
      return Response([[$output], [$uid], [$username1]]);
      //return  response()->json(['data'=>$data]);
   }
   public function unallocated(Request $request)
   {

      $username = User::where('id', $request->user_id)->pluck('name');
      $datas = DB::table('assignusers')
         ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'), DB::raw('DATE(updated_at) as updateaaa'))
         ->where([['user_id', $request->user_id], ['unassign', 'unassign']])
         ->groupBy('date', 'updateaaa')
         ->get();
      $uid = $request->user_id;
      $createddate = '';
      $output =  '';
      $i = 1;
      $username1 = "Unassigned company of " . $username[0] . "";
      foreach ($datas as $data) {
         // $createddate=date_format($data->created_at, 'Y-m-d');

         $output .= '<tr>' . '<td>' . $i . '</td>' . '<td>' . $username[0] . '</td>' . '<td value="' . $data->date . '" class="unassignselectdate">' . $data->date . '</td>' . '<td>' . $data->updateaaa . '</td>' . '<td>' . $data->views . '</td>' . '</tr>';

         $i++;
      }
      return Response([[$output], [$uid], [$username1]]);
      //return  response()->json(['data'=>$data]);
   }

   public function totalallocated(Request $request)
   {
      $username = User::where('id', $request->user_id)->pluck('name');
      $datas = DB::table('assignusers')
         ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'), DB::raw('DATE(updated_at) as updateaa'), 'unassign')
         ->where('user_id', $request->user_id)
         ->groupBy('date', 'updateaa', 'unassign')
         ->get();
      $uid = $request->user_id;
      $createddate = '';
      $output =  '';
      $username1 = "Total assigned company of " . $username[0] . "";
      $i = 1;
      foreach ($datas as $data) {
         // $createddate=date_format($data->created_at, 'Y-m-d');
         if ($data->unassign == 'unassign') {
            $updatetedat = $data->updateaa;
         } else {
            $updatetedat = '-';
         }


         $output .= '<tr>' . '<td>' . $i . '</td>' . '<td>' . $username[0] . '</td>' . '<td class="totalselectdate">' . $data->date . '</td>' .
            '<td>' . $updatetedat . '</td>' .
            '<td>' . $data->views . '</td>'
            . '</tr>';
         $i++;
      }
      return Response([[$output], [$uid], [$username1]]);
   }

   public function currentlyallcatedcompanyname(Request $request)
   {
      // $assigncompanynames=Assignuser::where([['created_at','=',$request->cdate],['user_id','=',$request->user_id]])->get();
      $assigncompanynames = DB::table('assignusers')->join('company_masters', 'assignusers.company_id', '=', 'company_masters.id')->select('company_masters.company_name', 'company_masters.id')
         ->whereDate('assignusers.created_at', $request->cdate)->Where([['assignusers.user_id', $request->user_id], ['assignusers.unassign', '=', 'assign']])->get();
      $output =  '';
      $i = 1;
      $username = $username = User::where('id', $request->user_id)->pluck('name');
      $username1 = 'Currenly assign to ' . $username[0] . ' at date ' . $request->cdate . '';
      foreach ($assigncompanynames as $assigncompanyname) {

         $DoesntQualify = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();

         $clientDoesntQualify = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();
         $DoesntQualify1 = count($DoesntQualify) + count($clientDoesntQualify);

         $Sale = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $clientSale = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $Sale1 = count($Sale) + count($clientSale);

         $NoAnswer = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $clientNoAnswer = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $NoAnswer1 = count($NoAnswer) + count($clientNoAnswer);

         $AnsweringMachine = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $clientAnsweringMachine = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $AnsweringMachine1 = count($AnsweringMachine) + count($clientAnsweringMachine);

         $HangUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $clientHangUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $HangUp1 = count($HangUp) + count($clientHangUp);

         $NotInterested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $clientNotInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $NotInterested1 = count($NotInterested) + count($clientNotInterested);

         $NumberNotInService = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $clientNumberNotInService = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $NumberNotInService1 = count($NumberNotInService) + count($clientNumberNotInService);

         $Interested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $clientInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $Interested1 = count($Interested) + count($clientInterested);

         $FollowUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $clientFollowUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $FollowUp1 = count($FollowUp) + count($clientFollowUp);

         $BusyNumber = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $clientBusyNumber = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $BusyNumber1 = count($BusyNumber) + count($clientBusyNumber);

         $CallBack = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $clientCallBack = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $CallBack1 = count($CallBack) + count($clientCallBack);

         $Cancel = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();

         $clientCancel = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();

         $Cancel1 = count($Cancel) + count($clientCancel);

         $inhouse = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();

         $clientinhouse = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();
         $inhouse1 = count($inhouse) + count($clientinhouse);

         $closedwindow = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();

         $clientclosedwindow = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();
         $closedwindow1 = count($closedwindow) + count($clientclosedwindow);



         $output .= '<tr>' . '<td>' . $i . '</td>' . "<td class='coid'><b style='color:#0B2E47'>" . $assigncompanyname->id . "</b></td>" .
            "<td ><b style='color:#0B2E47'>" . $assigncompanyname->company_name . "</b></td>" . "<td class='statusinfo' id='1'><b style='color:#0B2E47'  >" . $DoesntQualify1 . "</b></td>" . "<td id='Sale' class='statusinfo'><b style='color:#0B2E47' >" . $Sale1 . "</b></td>" . "<td id='No Answer' class='statusinfo'><b style='color:#0B2E47'>" . $NoAnswer1 . "</b></td>" . "<td  id='Answering Machine' class='statusinfo'><b style='color:#0B2E47'>" . $AnsweringMachine1 . "</b></td>" . "<td id='Hang Up' class='statusinfo'><b style='color:#0B2E47'>" . $HangUp1 . "</b></td>" . "<td  id='Not Interested' class='statusinfo'><b style='color:#0B2E47'>" . $NotInterested1 . "</b></td>" . "<td id='Number Not In Service' class='statusinfo'><b style='color:#0B2E47' >" . $NumberNotInService1 . "</b></td>" . "<td id='Interested' class='statusinfo'><b style='color:#0B2E47'>" . $Interested1 . "</b></td>" . "<td id='Follow Up' class='statusinfo'><b style='color:#0B2E47' >" . $FollowUp1 . "</b></td>" . "<td id='Busy Number' class='statusinfo'><b style='color:#0B2E47'>" . $BusyNumber1 . "</b></td>" . "<td id='Call Back' class='statusinfo'><b style='color:#0B2E47' >" . $CallBack1 . "</b></td>" . "<td id='Cancel' class='statusinfo'><b style='color:#0B2E47' >" . $Cancel1 . "</b></td>" . "<td id='In House' class='statusinfo'><b style='color:#0B2E47' >" . $inhouse1 . "</b></td>" . "<td id='Closed Window' class='statusinfo'><b style='color:#0B2E47' >" . $closedwindow1 . "</b></td>" . "</tr>";
         $i++;
      }
      return Response([[$output], [$username1], [$request->user_id]]);
   }
   public function unallcatedcompanyname(Request $request)
   {
      // $assigncompanynames=Assignuser::where([['created_at','=',$request->cdate],['user_id','=',$request->user_id]])->get();
      $assigncompanynames = DB::table('assignusers')->join('company_masters', 'assignusers.company_id', '=', 'company_masters.id')->select('company_masters.company_name', 'company_masters.id')
         ->whereDate('assignusers.created_at', $request->cdate)->Where([['assignusers.user_id', $request->user_id], ['assignusers.unassign', '=', 'unassign']])->get();
      $output =  '';
      $i = 1;
      $username = $username = User::where('id', $request->user_id)->pluck('name');
      $username1 = 'Currenly assign to ' . $username[0] . ' at date ' . $request->cdate . '';
      foreach ($assigncompanynames as $assigncompanyname) {

         $DoesntQualify = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();

         $clientDoesntQualify = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();
         $DoesntQualify1 = count($DoesntQualify) + count($clientDoesntQualify);

         $Sale = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $clientSale = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $Sale1 = count($Sale) + count($clientSale);

         $NoAnswer = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $clientNoAnswer = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $NoAnswer1 = count($NoAnswer) + count($clientNoAnswer);

         $AnsweringMachine = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $clientAnsweringMachine = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $AnsweringMachine1 = count($AnsweringMachine) + count($clientAnsweringMachine);

         $HangUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $clientHangUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $HangUp1 = count($HangUp) + count($clientHangUp);

         $NotInterested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $clientNotInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $NotInterested1 = count($NotInterested) + count($clientNotInterested);

         $NumberNotInService = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $clientNumberNotInService = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $NumberNotInService1 = count($NumberNotInService) + count($clientNumberNotInService);

         $Interested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $clientInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $Interested1 = count($Interested) + count($clientInterested);

         $FollowUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $clientFollowUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $FollowUp1 = count($FollowUp) + count($clientFollowUp);

         $BusyNumber = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $clientBusyNumber = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $BusyNumber1 = count($BusyNumber) + count($clientBusyNumber);

         $CallBack = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $clientCallBack = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $CallBack1 = count($CallBack) + count($clientCallBack);

         $Cancel = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();

         $clientCancel = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();

         $Cancel1 = count($Cancel) + count($clientCancel);

         $inhouse = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();

         $clientinhouse = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();
         $inhouse1 = count($inhouse) + count($clientinhouse);

         $closedwindow = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();

         $clientclosedwindow = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();
         $closedwindow1 = count($closedwindow) + count($clientclosedwindow);



         $output .= '<tr>' . '<td>' . $i . '</td>' . "<td class='coid'><b style='color:#0B2E47'>" . $assigncompanyname->id . "</b></td>" .
            "<td ><b style='color:#0B2E47'>" . $assigncompanyname->company_name . "</b></td>" . "<td class='statusinfo' id='1'><b style='color:#0B2E47'  >" . $DoesntQualify1 . "</b></td>" . "<td id='Sale' class='statusinfo'><b style='color:#0B2E47' >" . $Sale1 . "</b></td>" . "<td id='No Answer' class='statusinfo'><b style='color:#0B2E47'>" . $NoAnswer1 . "</b></td>" . "<td  id='Answering Machine' class='statusinfo'><b style='color:#0B2E47'>" . $AnsweringMachine1 . "</b></td>" . "<td id='Hang Up' class='statusinfo'><b style='color:#0B2E47'>" . $HangUp1 . "</b></td>" . "<td  id='Not Interested' class='statusinfo'><b style='color:#0B2E47'>" . $NotInterested1 . "</b></td>" . "<td id='Number Not In Service' class='statusinfo'><b style='color:#0B2E47' >" . $NumberNotInService1 . "</b></td>" . "<td id='Interested' class='statusinfo'><b style='color:#0B2E47'>" . $Interested1 . "</b></td>" . "<td id='Follow Up' class='statusinfo'><b style='color:#0B2E47' >" . $FollowUp1 . "</b></td>" . "<td id='Busy Number' class='statusinfo'><b style='color:#0B2E47'>" . $BusyNumber1 . "</b></td>" . "<td id='Call Back' class='statusinfo'><b style='color:#0B2E47' >" . $CallBack1 . "</b></td>" . "<td id='Cancel' class='statusinfo'><b style='color:#0B2E47' >" . $Cancel1 . "</b></td>" . "<td id='In House' class='statusinfo'><b style='color:#0B2E47' >" . $inhouse1 . "</b></td>" . "<td id='Closed Window' class='statusinfo'><b style='color:#0B2E47' >" . $closedwindow1 . "</b></td>" . "</tr>";
         $i++;
      }
      return Response([[$output], [$username1], [$request->user_id]]);
   }


   public function totalallcatedcompanyname(Request $request)
   {
      // dd($request->all());
      $assigncompanynames = DB::table('assignusers')->join('company_masters', 'assignusers.company_id', '=', 'company_masters.id')->select('company_masters.company_name', 'company_masters.id')
         ->whereDate('assignusers.created_at', $request->cdate)->Where('assignusers.user_id', $request->user_id)->get();
      $username = $username = User::where('id', $request->user_id)->pluck('name');
      $username1 = 'total assign to ' . $username[0] . ' at date ' . $request->cdate . '';
      $output =  '';
      $i = 1;

      foreach ($assigncompanynames as $assigncompanyname) {
         $DoesntQualify = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();

         $clientDoesntQualify = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Doesn't Qualify"]])->get();
         $DoesntQualify1 = count($DoesntQualify) + count($clientDoesntQualify);

         $Sale = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $clientSale = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Sale"]])->get();

         $Sale1 = count($Sale) + count($clientSale);

         $NoAnswer = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $clientNoAnswer = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "No Answer"]])->get();

         $NoAnswer1 = count($NoAnswer) + count($clientNoAnswer);

         $AnsweringMachine = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $clientAnsweringMachine = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Answering Machine"]])->get();

         $AnsweringMachine1 = count($AnsweringMachine) + count($clientAnsweringMachine);

         $HangUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $clientHangUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Hang Up"]])->get();

         $HangUp1 = count($HangUp) + count($clientHangUp);

         $NotInterested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $clientNotInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Not Interested"]])->get();

         $NotInterested1 = count($NotInterested) + count($clientNotInterested);

         $NumberNotInService = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $clientNumberNotInService = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Number Not In Service"]])->get();

         $NumberNotInService1 = count($NumberNotInService) + count($clientNumberNotInService);

         $Interested = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $clientInterested = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Interested"]])->get();

         $Interested1 = count($Interested) + count($clientInterested);

         $FollowUp = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $clientFollowUp = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Follow Up"]])->get();

         $FollowUp1 = count($FollowUp) + count($clientFollowUp);

         $BusyNumber = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $clientBusyNumber = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Busy Number"]])->get();

         $BusyNumber1 = count($BusyNumber) + count($clientBusyNumber);

         $CallBack = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $clientCallBack = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Call Back"]])->get();

         $CallBack1 = count($CallBack) + count($clientCallBack);

         $Cancel = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();

         $clientCancel = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', "Cancel"]])->get();
         $Cancel1 = count($Cancel) + count($clientCancel);

         $inhouse = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();

         $clientinhouse = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'In House']])->get();
         $inhouse1 = count($inhouse) + count($clientinhouse);

         $closedwindow = Company_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();

         $clientclosedwindow = Client_disposition::where([['company_id', '=', $assigncompanyname->id], ['user_id', '=', $request->user_id], ['status', '=', 'Closed Window']])->get();
         $closedwindow1 = count($closedwindow) + count($clientclosedwindow);



         $output .= '<tr>' . '<td>' . $i . '</td>' . "<td class='coid'><b style='color:#0B2E47'>" . $assigncompanyname->id . "</b></td>" .
            "<td ><b style='color:#0B2E47'>" . $assigncompanyname->company_name . "</b></td>" . "<td class='statusinfo' id='1'><b style='color:#0B2E47'  >" . $DoesntQualify1 . "</b></td>" . "<td id='Sale' class='statusinfo'><b style='color:#0B2E47' >" . $Sale1 . "</b></td>" . "<td id='No Answer' class='statusinfo'><b style='color:#0B2E47'>" . $NoAnswer1 . "</b></td>" . "<td  id='Answering Machine' class='statusinfo'><b style='color:#0B2E47'>" . $AnsweringMachine1 . "</b></td>" . "<td id='Hang Up' class='statusinfo'><b style='color:#0B2E47'>" . $HangUp1 . "</b></td>" . "<td  id='Not Interested' class='statusinfo'><b style='color:#0B2E47'>" . $NotInterested1 . "</b></td>" . "<td id='Number Not In Service' class='statusinfo'><b style='color:#0B2E47' >" . $NumberNotInService1 . "</b></td>" . "<td id='Interested' class='statusinfo'><b style='color:#0B2E47'>" . $Interested1 . "</b></td>" . "<td id='Follow Up' class='statusinfo'><b style='color:#0B2E47' >" . $FollowUp1 . "</b></td>" . "<td id='Busy Number' class='statusinfo'><b style='color:#0B2E47'>" . $BusyNumber1 . "</b></td>" . "<td id='Call Back' class='statusinfo'><b style='color:#0B2E47' >" . $CallBack1 . "</b></td>" . "<td id='Cancel' class='statusinfo'><b style='color:#0B2E47' >" . $Cancel1 . "</b></td>" . "<td id='In House' class='statusinfo'><b style='color:#0B2E47' >" . $inhouse1 . "</b></td>" . "<td id='Closed Window' class='statusinfo'><b style='color:#0B2E47' >" . $closedwindow1 . "</b></td>" . "</tr>";
         $i++;
      }
      return Response([[$output], [$username1], [$request->user_id]]);
   }

   public function currentlyassigndisposition(Request $request)
   {

      if ($request->statusid == 1) {
         $statusname = "Doesn't Qualify";
      } else {
         $statusname = $request->statusid;
      }

      $output = '';
      $output1 = '';
      $i = 1;
      $j = 1;
      $usercompanydispositions = Company_disposition::where([['user_id', '=', $request->user_id], ['company_id', '=', $request->coid], ['status', '=', $statusname]])->get();
      $userclientdispositions = Client_disposition::where([['user_id', '=', $request->user_id], ['company_id', '=', $request->coid], ['status', '=', $statusname]])->get();

      foreach ($usercompanydispositions as $usercompanydisposition) {
         $companyname = Company_Master::where('id', $request->coid)->pluck('company_name');

         $output .= '<tr>' . '<td>' . $i . '</td>' .
            "<td><b style='color:#0B2E47'>" . $companyname[0] . "</b></td>" . "<td><b style='color:#0B2E47'>" . $usercompanydisposition->status . "</b></td>" . "<td><b style='color:#0B2E47'>" . $usercompanydisposition->created_at . "</b></td>" . "</tr>";
         $i++;
      }
      foreach ($userclientdispositions as $userclientdisposition) {
         $clientname = Client_Master::where('id', $userclientdisposition->client_id)->pluck('client_name');
         $output1 .= '<tr>' . '<td>' . $j . '</td>' .
            "<td><b style='color:#0B2E47'>" . $clientname[0] . "</b></td>" . "<td><b style='color:#0B2E47'>" . $userclientdisposition->status . "</b></td>" . "<td><b style='color:#0B2E47'>" . $userclientdisposition->created_at . "</b></td>" . "</tr>";
         $i++;
      }


      return Response([[$output], [$output1]]);
      // dd($usercompanydispositions);

   }
   public function usercompanyinfo(Request $request)
   {

      $companycount = Company_Master::where('created_user_id', $request->userid)->whereDate('created_atus', $request->date1)->count();

      return $companycount;
   }
   public function userdispositiondayinfo(Request $request)
   {

      if ($request->selecttype == 'Life Time') {
         $typedetail = $request->selecttype;
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->where('user_id', '=', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //Life Time company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Today') {
         $date = Carbon::now('America/New_York');
         $typedetail = $request->selecttype . ' (' . $date->toDateString() . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus',  $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //today company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Yesterday') {
         $date = Carbon::yesterday('America/New_York');
         $typedetail = $request->selecttype . ' (' . $date->toDateString() . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus',  $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //yesterday company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Last 7 Days') {
         $date = Carbon::today('America/New_York')->subDays(7);
         $todaydate = Carbon::today('America/New_York');
         $typedetail = $request->selecttype . ' ( ' . $date->toDateString() . ' To ' . $todaydate->toDateString() . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //Last 7 Days company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus', '>=', $date->toDateString())->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Last 30 Days') {
         $date = Carbon::today('America/New_York')->subDays(30);
         $todaydate = Carbon::today('America/New_York');
         $typedetail = $request->selecttype . ' ( ' . $date->toDateString() . ' To ' . $todaydate->toDateString() . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //Last 30 Days company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus', '>=', $date->toDateString())->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Custom') {
         $from = date($request->date1);
         $to = date($request->date2);
         $typedetail = $request->selecttype . ' ( ' . $from . ' To ' . $to . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $from)->whereDate('created_atus', '<=', $to)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=', $from)->whereDate('created_atus', '<=', $to)->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //Custome company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus', '>=', $from)->whereDate('created_atus', '<=', $to)->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }
      if ($request->selecttype == 'Select Date') {
         $date = date($request->date1);
         $typedetail = $request->selecttype . ' (' . $date . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '=', $date)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '=', $date)->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = "<tr><td colspan='2'>No Calls</td></tr>";
         if (count($outputs) > 0) {
            $alldisposition = "";
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {

               $alldisposition .= "<tr><td>" . $output->status . "</td><td>" . $output->count . "</td></tr>";
            }
         }
         //Custome company that called count
         $companycalled = DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus', '=', $date)->where('user_id', $request->userid)->distinct('company_dispositions.company_id')->get();
         $companycalled = count($companycalled);
      }

      return Response([[$alldisposition], [$typedetail], [$countdisposition], [$companycalled]]);
   }
   public function userdispositionchartinfo(Request $request)
   {
      if ($request->type == 'Life Time') {
         $typedetail = $request->type;
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->where('user_id', '=', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            $dispositionlist = "Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
            $dispositionlistarray = explode(',', $dispositionlist);

            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Today") {

         $date = Carbon::now('America/New_York');
         $typedetail = $request->type . ' (' . $date->toDateString() . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus',  $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Yesterday") {

         $date = Carbon::yesterday('America/New_York');
         $typedetail = $request->type . ' (' . $date->toDateString() . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus',  $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Last 7 Days") {
         $date = Carbon::today('America/New_York')->subDays(7);
         $todaydate = Carbon::today('America/New_York');
         $typedetail = $request->type . ' ( ' . $date->toDateString() . ' To ' . $todaydate->toDateString() . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Last 30 Days") {
         $date = Carbon::today('America/New_York')->subDays(30);
         $todaydate = Carbon::today('America/New_York');
         $typedetail = $request->type . ' ( ' . $date->toDateString() . ' To ' . $todaydate->toDateString() . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $date->toDateString())->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=',  $date->toDateString())->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Custom") {
         $date = Carbon::today('America/New_York')->subDays(30);
         $from = date($request->date1);
         $to = date($request->date2);
         $typedetail = $request->type . ' ( ' . $from . ' To ' . $to . ' )';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '>=', $from)->whereDate('created_atus', '<=', $to)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '>=', $from)->whereDate('created_atus', '<=', $to)->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      if ($request->type == "Select Date") {

         $date = date($request->date3);
         $typedetail = $request->type . ' ( ' . $date . ')';
         $countdisposition = DB::table('company_dispositions')->where('user_id', $request->userid)->whereDate('created_atus', '=', $date)->count();
         $outputs = DB::table('company_dispositions')->select('company_dispositions.status', DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus', '=', $date)->where('user_id', $request->userid)->groupBy('company_dispositions.status')->get();
         $alldisposition = '[["Task","Hours per Day"]';
         if (count($outputs) > 0) {
            $alldisposition = '[["Task","Hours per Day"],';
            foreach ($outputs as $output) {
               if ($outputs->last() == $output) {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . ']';
               } else {
                  $alldisposition .= '["' . $output->status . '",' . $output->count . '],';
               }
            }
         }
      }
      $alldisposition .= ']';
      return Response([[$alldisposition], [$typedetail], [$countdisposition]]);
   }
   public function monthcompnycount(Request $request)
   {


      $myDate = '12/' . $request->month . '/' . $request->year;
      $date = Carbon::createFromFormat('d/m/Y', $myDate)
         ->firstOfMonth()
         ->format('Y-m-d');



      // $todaycompnycount=DB::table('company_masters')->where('created_user_id','=',$user->id)->whereDate('created_atus',$todayus)->count();
      //       //insert last 30 days count
      $companycounttabledatewise = "";
      //        $yearcount30days =Carbon::now('America/New_York');

      for ($i = 1; $i <= 31; $i++) {

         $comppanycountdate = $request->year . "-" . $request->month . "-" . $i;
         $companycounttabledatewise .= "<tr><td>" . $comppanycountdate . "</td><td>" . DB::table('company_masters')->where('created_user_id', '=', $request->userid)->whereDate('created_atus', $comppanycountdate)->count() . "</td></tr>";
      }
      return Response($companycounttabledatewise);
   }
}
