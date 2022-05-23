<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use DataTables;
class NotificationController extends Controller
{
    public function readnotificationmessage(Request $request){

       $data =DB::table('notifications')->where('id',$request->notificationid)->update(['read_at'=>Carbon::now()]);
       $data= Auth::user()->unreadNotifications->count();
     
       return  response()->json($data);
    }

    public function morenotification()
    {
           return view('notifications.view');
    }
    public function anydata(){
     $data =DB::table('notifications')->where('notifiable_id',1);
    	   return Datatables::of($data)
         ->addColumn('message',function($data){

               
                     $btn=$data->data;
                     return $btn;
           }) 
    	   ->escapeColumns([])  
           ->make(true);
    }

}
