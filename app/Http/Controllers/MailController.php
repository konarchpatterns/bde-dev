<?php

namespace App\Http\Controllers;
use App\Mail1;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use Swift_Attachment;
use Swift_Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;
class MailController extends Controller
{
    public function index(){

        return view('mail.viewmail.view');
    }
    public function candi(){

        return view('candidateform.candidateform');
    }
    public function candidateform1(){

        return view('candidateform.candidateform1');
    }
    public function candidateformnew(){

        return view('candidateform.candidateformnew');
    }
    public function doubleboxform(){

        return view('candidateform.doubleboxform');
    }
    public function candidatestore(Request $request){

     $v = Validator::make($request->all(), [
        'first_name' => 'required',
        'middle_name'=>'required',
        'last_name'=>'required',
        'dob'=>'required|date',
        'age'=>'required|numeric',
        'mobile_no' => 'required|numeric|min:10',
        'residence_no'=>'nullable|numeric',
        'email'=>'nullable|email',
        'present_address'=>'required',
       
     ]);
   
         if( $v->fails()){
                  return Redirect::back()->withErrors($v)->withInput();

          }
          $startDateTime=date("Y/m/d");
          $timestamp = strtotime($request->dob);
          $dateofbirth= date('Y/m/d',$timestamp);
          DB::table('candidate_forms')->insert(
             [
                'date_of_interview'=>$startDateTime,
                'post_applied' =>$request->post_applied,
                'first_name' => $request->first_name,
                'last_name'=>$request->last_name,
                'middle_name'=>$request->middle_name,
                'family_occupation'=>$request->family_occupation,
                'school_name'=>$request->school_name,
                'school_medium' =>$request->school_medium,
                'college_name' => $request->college_name,
                'college_medium'=>$request->college_medium,
                'last_education'=>$request->last_education,
                'age'=>$request->age,
                'dob' =>$dateofbirth,
                'mobile_no' => $request->mobile_no,
                'email'=>$request->email,
                'residence_no'=>$request->residence_no,
                'present_address'=>$request->present_address,
                'previos_current_job' =>$request->previos_current_job,

                'total_work_exp' => $request->year." year, ". $request->month."month",
                'reason_to_leave'=>$request->reason_to_leave,
                'residence_no'=>$request->residence_no,
                'any_comment'=>$request->any_commitment,
            ]);
            $enteres="success";
            return view('candidateform.candidateform',compact('enteres'));
    }
    
    
    public function anydata(){
        $rolelevel=Role::where('slug','bde')->pluck('level');
        if (Auth::user()->hasRole('admin')){
            $data =Mail1::query()->where('flag',0);
        }
        else if(Auth::user()->level() == $rolelevel[0]){
           $data =Mail1::query()->where('flag',0);
        }
        else{
            $data =Mail1::query()->where([['created_user_id',auth::user()->id],['flag',0]]);
        }
         return Datatables::of($data) 
         ->addColumn('sendsubject',function($data){
                
                 if($data->send_by == ""){
                     $btn="<span style='color:#DCB26F'><b>".$data->subject."</b></span>";
                 }
                 else{
                      $btn=$data->subject;
                 }
                      
                     return $btn;
           }) 
          ->addColumn('edit',function($data){
                 $show= route('mail.show',['id'=> $data->id]);
                      $btn="<a href='{$show}' class='btn btn-sm btn-fill btn-info'>Show</a>";
                     return $btn;
           }) 
           ->addColumn('delete',function($data){
                      $delete=$data->id;
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-danger'>Delete</a>";
                     return $btn;
           }) 
         ->escapeColumns([])  
         ->make(true);
       
    }
    public function write($id){
    	
        return view('mail.sendmail.view',['id'=>$id]);
    }
    public function create()
    {
        return view('mail.sendmail.view');
    }
    public function store(Request $request){
       $v = Validator::make($request->all(), [
        'cocliname' => 'required',
        'to'=>'required|email',
        'emailusername'=>'required',
        'from'=>'required|email',
        'subject'=>'required',
        'body' => 'required',    
      ]);
   
         if( $v->fails()){
                  return Redirect::back()->withErrors($v)->withInput();

          }
     
    	$storemail=new Mail1;
    	$storemail->from=$request->from;
      $storemail->emailusername=$request->emailusername;
    	$storemail->to=$request->to;
      $storemail->cocliname=$request->cocliname;
    	$storemail->subject=$request->subject;
    	$storemail->body=$request->body;
      $storemail->created_user_id=auth()->user()->id;
    	$storemail->save();
      $sendmail=Mail1::find($storemail->id);
              $sendmail->send_by=auth()->user()->id;
              $smtpAddress = 'smtp.gmail.com';
              $port = 587;
              $encryption = 'tls';
              $yourEmail = 'hello@patterns247.com';
              $yourPassword = '+Haj5Dra3A+aduba';
                   // Prepare transport
                $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
                        ->setUsername($yourEmail)
                        ->setPassword($yourPassword);
                $mailer = new \Swift_Mailer($transport);
                    // Send email
                $message = (new \Swift_Message($sendmail->subject));
                   $message->setFrom([ $yourEmail => $yourEmail])
                     ->setTo([$sendmail->to => $sendmail->to])
                     // If you want plain text instead, remove the second paramter of setBody       
                ->setBody('<html>'.$sendmail->body.'<img src="' .
                  $message->embed(Swift_Image::fromPath(public_path('patternscrmdesign/assets/img/Signatures.jpg'))).'" alt="Image Missing" /></html>', 'text/html');
                $attach=Swift_Attachment::fromPath(public_path('patternscrmdesign/assets/img/Regular.png'));
                 $attach1=Swift_Attachment::fromPath(public_path('patternscrmdesign/assets/img/OneSource.png'))->setFilename('One Source.png');
                    $message->attach($attach);
                    $message->attach($attach1);
                $mailer->send($message);
                $sendmail->update();
                return redirect()->route('mail.index');
    }
    public function show($id){
        $mailinfo=Mail1::find($id);
        return view('mail.showmail.view',['mailinfo'=>$mailinfo]);

    }
    public function edit($id){

        $mailinfo=Mail1::find($id);
        return view('mail.editmail.view',['mailinfo'=>$mailinfo]);
    }
    public function update(Request $request){
        $v = Validator::make($request->all(), [
          'cocliname' => 'required',
          'to'=>'required|email',
          'emailusername'=>'required',
          'from'=>'required|email',
          'subject'=>'required',
          'body' => 'required',    
        ]);
   
         if( $v->fails()){
                  return Redirect::back()->withErrors($v)->withInput();

          }
        $updatemail=Mail1::find($request->id);
        $updatemail->from=$request->from;
        $updatemail->emailusername=$request->emailusername;
        $updatemail->to=$request->to;
        $updatemail->cocliname=$request->cocliname;
        $updatemail->subject=$request->subject;
        $updatemail->body=$request->body;
        $updatemail->updated_user_id=auth()->user()->id;
        $updatemail->update();
          return redirect()->route('mail.index');
    }
    
    public function delete(Request $request){

        $deleteemail=Mail1::find($request->email_id);
        $deleteemail->flag=1;
        $deleteemail->update();

    }

    public function send($id){
               // $sendmail=Mail1::find($id);
               // $sendmail->send_by=auth()->user()->id;
               //  $smtpAddress = 'smtp.gmail.com';
               //  $port = 587;
               //  $encryption = 'tls';
               //  $yourEmail = 'pdivyarajsinhvaghela88@gmail.com';
               //  $yourPassword = 'p@tternsb@pu123';
               //     // Prepare transport
               //  $transport = (new \Swift_SmtpTransport($smtpAddress, $port, $encryption))
               //          ->setUsername($yourEmail)
               //          ->setPassword($yourPassword);
               //  $mailer = new \Swift_Mailer($transport);
               //      // Send email
               //  $message = (new \Swift_Message($sendmail->subject))
               //       ->setFrom([ $yourEmail => $yourEmail])
               //       ->setTo([$sendmail->to => $sendmail->to])
               //       // If you want plain text instead, remove the second paramter of setBody
                     
               //       ->setBody("<html>".$sendmail->body."</html>", 'text/html');
               //  $attach=Swift_Attachment::fromPath(public_path('patternscrmdesign/assets/img/Regular.png'));
               //   $attach1=Swift_Attachment::fromPath(public_path('patternscrmdesign/assets/img/OneSource.png'))->setFilename('One Source.png');
               //      $message->attach($attach);
               //      $message->attach($attach1);


               //  $mailer->send($message);
        
               //  $sendmail->update();
               //  return redirect()->route('mail.index');

    }

    
}
