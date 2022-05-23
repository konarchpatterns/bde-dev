<?php

namespace App\Http\Controllers;
use Session;
use App\Company_Master;
use App\Company_address;
use App\Company_email_address;
use App\Company_phone_number;
use App\Client_Master;
use App\Client_email_address;
use App\Client_phone_number;
use App\User;
use App\Uploadseatdetail;
use App\Assignuser;
use App\Company_disposition;
use Auth;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
use DataTables;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Notification;
use App\Notifications\MyEventNotification;
use App\Notifications\AssignuserNotification;
use jeremykenedy\LaravelRoles\Models\Role;
class CompanyMasterController extends Controller
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
      
        return view('company.viewcompany.view');
    }
    public function showassigncompany()
    {
      
        return view('company.viewassigncompany.view');
    }
    public function showunassigncompany()
    {
        return view('company.viewunassigncompany.view');
    }
    public function anydata($id)
    {
                  

          $rolelevel=Role::where('slug','bde')->pluck('level');
         
         
    if (Auth::user()->level() >= $rolelevel[0]){
      if($id == "All"){

         //$data =DB::table('company_masters')
         //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
         //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          
         //->join('company_addresses','company_addresses.company_id','=','company_masters.id')
         // ->leftJoin('users','users.id','=','company_masters.user_assign_id')
         //->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by','company_masters.user_assign_id')->where('converted','converted')
           //  ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by','company_masters.user_assign_id')
             // ;


          $data = Company_Master::with('CompanyAddress' )->where('converted','converted');

         // dd($q1);

          // $data =  Company_Master::query()->whereHas('CompanyAddress', function($query){

          //            $query->where('converted', 'converted');
          // });

          

          //dd($data);
           }
           if($id == "NA"){
              
            //    $data =DB::table('company_masters')
          //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          
         // ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
         // ->leftJoin('users','users.id','=','company_masters.user_assign_id')
        //  ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by' ,'company_masters.user_assign_id')->where([['company_masters.converted','=','converted'],['company_masters.last_disposition','=',null]])
        
             // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by','company_masters.user_assign_id');
                      
               //  $data =  Company_Master::query()->where(function  ($query){
                //          $query->where('converted', 'converted');
                //          $query->where('last_disposition', null);
                //     });

                  $data = Company_Master::with('CompanyAddress' )->where('converted','converted')
                               ->where('last_disposition', null);

           }
           if($id=="DA"){
         
          // $data =DB::table('comany_masters')
          //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          
          //->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
         // ->leftJoin('users','users.id','=','company_masters.user_assign_id')
         // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by','company_masters.user_assign_id')->where([['company_masters.converted','=','converted'],['company_masters.last_disposition','<>',null]]);

            // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.assign_by','company_masters.user_assign_id');

                  // $data =  Company_Master::query()->where(function  ($query){
                  //         $query->where('converted', 'converted');
                  //         $query->where('last_disposition','<>', null);
                  //        });

                   $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('last_disposition', '<>', null);
          
              } 
           }
           else{
            if($id == "All"){
              //$data =DB::table('company_masters')
             // ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
              //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
              //->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
             // ->leftJoin('users','users.id','=','company_masters.user_assign_id')
             // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition','company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id]])
             // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id');

                      // $data =  Company_Master::query()->where(function  ($query){
                      //     $query->where('converted', 'converted');
                      //     $query->where('user_assign_id','=', auth()->user()->id);
                      //    });

                      $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id);
            }
            if($id == "NA"){
                //$data =DB::table('company_masters')
              //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
              //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
             // ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
             // ->leftJoin('users','users.id','=','company_masters.user_assign_id')
              //->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition' ,'company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id],['company_masters.last_disposition','=',null]])
              //->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition' ,'company_masters.user_assign_id');

                         //  $data =  Company_Master::query()->where(function  ($query){
                         //  $query->where('converted', 'converted');
                         //  $query->where('user_assign_id','=', auth()->user()->id);
                         //   $query->where('last_disposition','=', null);
                         // });

                           $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','=', null);


            }
            if($id == "DA"){
              //$data =DB::table('company_masters')
              //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
             //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
            // ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
           //  ->leftJoin('users','users.id','=','company_masters.user_assign_id')
            // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition' , 'company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id],['company_masters.last_disposition','!=',null]])
            // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id');
                

                 // $data =  Company_Master::query()->where(function  ($query){
                 //          $query->where('converted', 'converted');
                 //          $query->where('user_assign_id','=', auth()->user()->id);
                 //           $query->where('last_disposition','!=', null);
                 //         });

                   $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','!=', null);


            }  
            
           }

         return Datatables::of($data)
         ->addColumn('checkbox',function($user){
                $checkboxvalue=$user->id;
                $btn="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='{$checkboxvalue}'>";
                     return $btn;
           }) 

         ->addColumn('cname',function($user){
                 $edit= route('company.show',['id'=> $user->id,'backto'=>"index"]);
                 $companyname=$user->company_name;
                       $btn="<span data-toggle='tooltip' title='{$companyname}'><a href='{$edit}'>{$companyname}</a></span>";
                     return $btn;
           })
         ->addColumn('state', function(Company_Master $user){
                        $country = '';
                       // $cntry =  DB::table('company_addresses')->select('state')->where('company_id', $user->id)->get();
                        
                        //foreach ($cntry as $key ) {
                       //         $country .= $key->state;
                       // }
                  

                       $country= $user->CompanyAddress->state;

                   return  $country;
         })
           ->addColumn('Country', function($user){
                        
                        $country = '';
                        // $cntry =  DB::table('company_addresses')->select('country')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->country;
                        // }
                         $country= $user->CompanyAddress->Country;

                   return  $country;
         })
           ->addColumn('time_zone', function($user){
                       $country = '';
                        // $cntry =  DB::table('company_addresses')->select('time_zone')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->time_zone;
                        // }

                        $country= $user->CompanyAddress->time_zone;

                   return  $country;
         })
             ->addColumn('company_phone_no' , function($user){
                     //dd($data->id);

                $result  =  DB::table('company_phone_numbers')->select('company_phone_numbers.company_phone',
                  'company_phone_numbers.phone_type')->where('company_id','=', $user->id)->where('deleted' ,'=',0)->get()->toArray();

                //dd($result);

                $company_phone_no='';

                 foreach ($result as $key ) {
                         // dd($value);
                        $company_phone_no .=  $key->company_phone .'(' . $key->phone_type .')' .',';
                 }
                   
              return substr($company_phone_no,0, -1);

              
           })
            ->addColumn('company_email_add' , function($user){
                  $company_email_add= '';
                           //dd($company_email_add);
                   $result  =  DB::table('company_email_addresses')->select('company_email',
                  'email_type')->where('company_id','=', $user->id)->where('deleted' ,'=',0)->get()->toArray();
                      

                 foreach ($result as $key ) {
                        $company_email_add.=  $key->company_email .'(' . $key->email_type .')' .',';
                 }
                   //dd($company_email_add);
                      return substr($company_email_add,0, -1);
           }) 
            // ->addColumn('name', function($data){
                       
            //             return  $data->user->name;

            // })
            
                ->filterColumn('company_phone_no', function ($query, $keyword) {
                $query->whereRaw("phone_no like ?", ["%{$keyword}%"]);
            })
                   ->filterColumn('company_email_add', function ($query, $keyword) {
                $query->whereRaw("company_email like ?", ["%{$keyword}%"]);
            })
            // ->filterColumn('company_phone_no', function($query, $keyword){
            //            $query->whereRaw('company_masters.phone_no like ?', ['%keyword%'] );
            // })
            //    ->filterColumn('users.name', function ($data, $keyword) {
            //             // $id = $data->id;

            //             $data->whereRaw("select name from users where users.id=company_masters.user_assign_id
            // and name like ?", ["%{$keyword}%"]);

            // })
            //     ->filterColumn('company_phone_no', function ($user, $keyword) {
            //             // $id = $data->id;

            //             $user->whereRaw("select company_phone_numbers.company_phone from company_phone_numbers limit(1) where company_phone_numbers.company_id=company_masters.id and company_phone like ?", ["%{$keyword}%"]);

            // })
            //        ->filterColumn('company_email_add', function ($user, $keyword) {
            //             // $id = $data->id;

            //             $user->whereRaw("select company_email_addresses.company_email from company_email_addresses limit(1) where company_email_addresses.company_id=company_masters.id and company_email like ?", ["%{$keyword}%"]);

            // })
                    
         ->escapeColumns([])  
         ->make(true);

       
    }

    public function asssignanydata($id)
    {
         
          // $q1=DB::raw("(SELECT GROUP_CONCAT(company_phone_numbers.company_phone,'(',company_phone_numbers.phone_type,')') FROM company_phone_numbers WHERE company_phone_numbers.company_id = company_masters.id and company_phone_numbers.deleted=0 GROUP BY company_masters.id ) as company_phone_no");
          // $q2=DB::raw("(SELECT GROUP_CONCAT(company_email_addresses.company_email,'(',company_email_addresses.email_type,')') FROM company_email_addresses WHERE company_email_addresses.company_id = company_masters.id and company_email_addresses.deleted=0  GROUP BY company_masters.id ) as company_email_add");
          
           $rolelevel=Role::where('slug','bde')->pluck('level');
         
         
    if (Auth::user()->level() >= $rolelevel[0]){
        if($id == 'All'){
         //   $data =DB::table('company_masters')
         // ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
         // ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
         //  ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
         //  ->leftJoin('users','users.id','=','company_masters.user_assign_id')
         // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition',
         //  'company_masters.user_assign_id' )->where('converted','converted')->where([['converted','=','converted'],['user_assign_id','!=',6]])

           
          //   ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id');

                     // $data =  Company_Master::query()->where(function  ($query){
                     //      $query->where('converted', 'converted');
                     //      $query->where('user_assign_id','!=',6);
                     //       // $query->where('last_disposition','!=', null);
                     //     });

                       $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','!=',6);

                       //dd($data);

           }
        if($id == 'NA'){

         //  $data =DB::table('company_masters')
         // ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
         // ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
         //  ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
         //  ->leftJoin('users','users.id','=','company_masters.user_assign_id')
         //  ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id')->where('converted','converted')->where([['converted','=','converted'],['user_assign_id','!=',6],['company_masters.last_disposition','=',null]])
           //  ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id');

              // $data =  Company_Master::query()->where(function  ($query){
              //             $query->where('converted', 'converted');
              //             $query->where('user_assign_id','!=',6);
              //            $query->where('last_disposition','=', null);
              //            });

               $data = Company_Master::with('CompanyAddress' )->where('converted','converted')->where('user_assign_id','!=',6)->where('last_disposition','=', null);

        }
      if($id == 'DA'){
          // $data =DB::table('company_masters')
          //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          //->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
          //->leftJoin('users','users.id','=','company_masters.user_assign_id')
         // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address', 'company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition', 'company_masters.user_assign_id')->where('converted','converted')->where([['converted','=','converted'],['user_assign_id','!=',6],['company_masters.last_disposition','!=',null]])
           //   ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.assign_by','company_masters.last_disposition' , 'company_masters.user_assign_id');


                     // $data =  Company_Master::query()->where(function  ($query){
                     //      $query->where('converted', 'converted');
                     //      $query->where('user_assign_id','!=',6);
                     //     $query->where('last_disposition','!=', null);
                     //     });

                      $data = Company_Master::with('CompanyAddress' )->where('converted','converted')->where('user_assign_id','!=',6)->where('last_disposition','!=', null);
           }
           }
          else{
          if($id == 'All'){
            // $data =DB::table('company_masters')
           // ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
           // ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
           //->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
           //->leftJoin('users','users.id','=','company_masters.user_assign_id')
           //->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition', 'company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id]])
          // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry', 'company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition' , 'company_masters.user_assign_id');

                         //   $data =  Company_Master::query()->where(function  ($query){
                         //         $query->where('converted', 'converted');
                         //        $query->where('user_assign_id','=', auth()->user()->id);
                         
                         // });


                            $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id);

          }
          if($id == 'NA'){
             //$data =DB::table('company_masters')
             //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
             //->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
             //->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
             //->leftJoin('users','users.id','=','company_masters.user_assign_id')
             //->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address', 'company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition', 'company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id],['company_masters.last_disposition','=',null]])
             //->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry' ,'company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition', 'company_masters.user_assign_id');

                         //  $data =  Company_Master::query()->where(function  ($query){
                         //         $query->where('converted', 'converted');
                         //        $query->where('user_assign_id','=', auth()->user()->id);
                         //        $query->where('last_disposition','=', null);
                         
                         // });

                             $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','=', null);

          }
          if($id == 'DA'){
            //  $data =DB::table('company_masters')
             //->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
            // ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
           //  ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
           //  ->leftJoin('users','users.id','=','company_masters.user_assign_id')
            // ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition', 'company_masters.user_assign_id')->where([['converted','converted'],['company_masters.user_assign_id',auth()->user()->id],['company_masters.last_disposition','!=',null]])
            // ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry' ,'company_masters.type_business','company_addresses.state','company_addresses.Country','company_masters.assign_by','company_addresses.time_zone','company_masters.last_disposition' , 'company_masters.user_assign_id');    
                          
                            $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','!=', null);
          }  
          }

         return Datatables::of($data)
         ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                $btn="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='{$checkboxvalue}'>";
                     return $btn;
           }) 
         ->addColumn('cname',function($data){
                 $edit= route('company.show',['id'=> $data->id,'backto'=>"index"]);
                 $companyname=$data->company_name;
                      $btn="<span data-toggle='tooltip' title='{$companyname}'><a href='{$edit}'>{$companyname}</a></span>";
                     return $btn;
           }) 
            ->addColumn('company_phone_no' , function($data){
                     //dd($data->id);

                $result  =  DB::table('company_phone_numbers')->select('company_phone', 'phone_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($;

                $company_phone_no='';

                 foreach ($result as $key => $value) {
                        $company_phone_no .=  $value->company_phone .'(' . $value->phone_type .')' .',';
                 }

                  return substr($company_phone_no , 0 , -1);

                //  dd($client_phone_no);

                 // return $client_phone_no;
           })
            ->addColumn('company_email_add' , function($data){
                    
                   $result  =  DB::table('company_email_addresses')->select('company_email', 'email_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($q1);
                $company_email_add = '';

                 foreach ($result as $key => $value) {
                        $company_email_add.=  $value->company_email .'(' . $value->email_type .')' . ',';
                 }
                      

                    return  substr($company_email_add,0, -1);
           }) 
            // ->addColumn('name', function($data){
            //             //$udata =  User::find($data->user_assign_id);
                          
            //             //dd($data->user_assign_id);
            //             return  $data->user->name;

            // })
            
           
            ->addColumn('state', function(Company_Master $user){
                        $country = '';
                       // $cntry =  DB::table('company_addresses')->select('state')->where('company_id', $user->id)->get();
                        
                        //foreach ($cntry as $key ) {
                       //         $country .= $key->state;
                       // }
                  

                       $country= $user->CompanyAddress->state;

                   return  $country;
         })
           ->addColumn('Country', function($user){
                        
                        $country = '';
                        // $cntry =  DB::table('company_addresses')->select('country')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->country;
                        // }
                         $country= $user->CompanyAddress->Country;

                   return  $country;
         })
           ->addColumn('time_zone', function($user){
                       $country = '';
                        // $cntry =  DB::table('company_addresses')->select('time_zone')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->time_zone;
                        // }

                        $country= $user->CompanyAddress->time_zone;

                   return  $country;
         })
           // ->addColumn('name', function($user){

           //         return $user->user->name ;
           // })
          
                ->filterColumn('company_phone_no', function ($query, $keyword) {
                $query->whereRaw("phone_no like ?", ["%{$keyword}%"]);
            })
                   ->filterColumn('company_email_add', function ($query, $keyword) {
                $query->whereRaw("company_email like ?", ["%{$keyword}%"]);
            })
        
            //    ->filterColumn('name', function ($data, $keyword) {
                       

            //             $data->whereRaw("select distinct name from users where users.id=company_masters.user_assign_id and name like ?", ["%{$keyword}%"]);

            // })
            //        ->filterColumn('company_phone_no', function ($data, $keyword) {
                        

            //             $data->whereRaw("select distinct company_phone_numbers.company_phone from company_phone_numbers where company_phone_numbers.company_id=company_masters.id and company_phone like ?", ["%{$keyword}%"]);

            // })
            //        ->filterColumn('company_email_add', function ($data, $keyword) {
                       

            //             $data->whereRaw("select distinct company_email_addresses.company_email from company_email_addresses where company_email_addresses.company_id=company_masters.id and company_email like ?", ["%{$keyword}%"]);

            // })
        
         ->escapeColumns([])  
         ->make(true);

       
    }

////  CODE ADDED AND CORRECTED ON 22-10-21 BY PRASHANT

 public function unasssignanydata($id)
{



        $rolelevel=Role::where('slug','bde')->pluck('level');
         
    if (Auth::user()->level() >= $rolelevel[0]){
               if($id == 'All'){
                     $data = Company_Master::with('CompanyAddress' )->where('converted','converted')->where('user_assign_id','=', 6);
                  }
                if($id == 'NA'){
         

                     $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', 6)->where('last_disposition','=',null);
                      }

            if($id == 'DA'){
                     $data = Company_Master::with('CompanyAddress' )->where('converted','converted')->where('user_assign_id','=', 6)->where('last_disposition','!=',null);

              }
          
           }

        else {

            if($id == 'All'){
           
                $data = Company_Master::with('CompanyAddress')->where('converted','converted')
                ->where('user_assign_id','=', auth()->user()->id);
            }


            if($id == 'NA'){
              
               $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','=',null);

            }

            if($id == 'DA'){
           
               $data = Company_Master::with('CompanyAddress')->where('converted','converted')
               ->where('user_assign_id','=', auth()->user()->id)->where('last_disposition','=',null);

            }
          
           }

           // $data = Company_Master::with('CompanyAddress')->where('converted','converted')->where('user_assign_id','=', 6);    

          return Datatables::of($data)
         ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                $btn="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='{$checkboxvalue}'>";
                     return $btn;
           }) 
         ->addColumn('cname',function($data){
                 $edit= route('company.show',['id'=> $data->id,'backto'=>"index"]);
                 $companyname=$data->company_name;
                      $btn="<a href='{$edit}'>{$companyname}</a>";
                     return $btn;
           }) 
          ->addColumn('company_phone_no' , function($data){
                     //dd($data->id);

                $result  =  DB::table('company_phone_numbers')->select('company_phone', 'phone_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

    //             //dd($;

                $company_phone_no='';

                 foreach ($result as $key => $value) {
                        $company_phone_no .=  $value->company_phone .'(' . $value->phone_type .')' .',';
                 }

                  return substr($company_phone_no, 0,-1);

             
           })
            ->addColumn('company_email_add' , function($data){
                    
                   $result  =  DB::table('company_email_addresses')->select('company_email', 'email_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($q1);
                $company_email_add = '';

                 foreach ($result as $key => $value) {
                        $company_email_add.=  $value->company_email .'(' . $value->email_type .')' .',';
                 }

                    return  substr($company_email_add, 0,-1);
           }) 
                 ->filterColumn('company_phone_no', function ($query, $keyword) {
                $query->whereRaw("phone_no like ?", ["%{$keyword}%"]);
            })
                   ->filterColumn('company_email_add', function ($query, $keyword) {
                $query->whereRaw("company_email like ?", ["%{$keyword}%"]);
            })
             ->addColumn('state', function(Company_Master $user){
                        $country = '';
                                         

                       $country= $user->CompanyAddress->state;

                   return  $country;
         })
           ->addColumn('Country', function($user){
                        
                        $country = '';
                       
                         $country= $user->CompanyAddress->Country;

                   return  $country;
         })
           ->addColumn('time_zone', function($user){
                       $country = '';
                      
                        $country= $user->CompanyAddress->time_zone;

                   return  $country;
         })
                                  
         ->escapeColumns([])  
         ->make(true);

       
    }


    //  CODE ADDED AND CORRECTED ON 22-10-21 BY PRASHANT
   

    public function list(){
        
        $data =Company_Master::query();
        return Datatables::of($data)
        
         ->escapeColumns([])  
         ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('company.addcompany.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request){

      if ($request->file('file') != null ){

      $file=$request->file('file');
      //dd($file);
      // File Details 
      $filename = $file->getClientOriginalName();
      $extension = $file->getClientOriginalExtension();
      $tempPath = $file->getRealPath();
      $fileSize = $file->getSize();
      $mimeType = $file->getMimeType();

      // Valid File Extensions
      $valid_extension = array("csv");

      // 2MB in Bytes
      $maxFileSize = 500000000; 
       //2097152
      // Check file extension
      if(in_array(strtolower($extension),$valid_extension)){

        // Check file size
        if($fileSize <= $maxFileSize){

          // File upload location
          $location = 'uploads';

          // Upload file
          $file->move($location,$filename);

          // Import CSV to Database
          $filepath = public_path($location."/".$filename);

          // Reading file
          $file = fopen($filepath,"r");

          $importData_arr = array();
          $i = 0;

          while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
             $num = count($filedata );
             
             // Skip first row (Remove below comment if you want to skip the first row)
             if($i == 0){
                $i++;
                continue; 
             }
             for ($c=0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata [$c];
             }
             $i++;
          }   
          fclose($file);
          $errors=[];
          foreach($importData_arr as $importData){
            if($importData[1] == null || $importData[1] == ""){
              $error="line no ".$importData[0]." Company Name is empty";
               $errors[]=$error;
            }
            // if($importData[12] == null || $importData[12] == ""){
            //      $error="line no ".$importData[0]." Client First Name is empty";
            //      $errors[]=$error;
            //   }
            //phone and email required validation
            // if($importData[11] == null || $importData[11] == ""){
            //    $error="line no ".$importData[0]." Client_Phone required";
            //     $errors[]=$error;
            // }
           //  if($importData[13] == null || $importData[13] == ""){
           //     $error="line no ".$importData[0]." email required";
           //      $errors[]=$error;
           //  }
           //  else{
           //    $email=explode(';',$importData[7]);
           //    $emailcount=count($email);
             
           //      for($i=0; $i < $emailcount; $i++){
           //         if(!filter_var($email[$i], FILTER_VALIDATE_EMAIL)){
           //         $error="line no ".$importData[0]." email not proper";
           //         $errors[]=$error;
           //       }
           //  }
           // }
              //company phone validation if type requuired
               // $companyphone=explode(';',$importData[3]);
               // $companyphonecount=count($companyphone);
               // $companyphonetype=explode(';',$importData[4]);
               // $companyphonetypecount=count($companyphonetype);

               // if( $companyphonecount != $companyphonetypecount)
               // {
               //  $error="line no ".$importData[0]." Companynumber and Companyphone_Type not match";
               //    $errors[]=$error;
                  
               // } 

              //company email validation
               $companyemail=explode(';',$importData[5]);
               $companyemailcount=count($companyemail);
               $companyemailtype=explode(';',$importData[6]);
               $companyemailtypecount=count($companyemailtype);
           
               if($companyemailcount != $companyemailtypecount){
                 
                   $error="line no ".$importData[0]." Company Email and Company Email Type not match";
                   $errors[]=$error;
               }
               
               for($i=0; $i < $companyemailcount; $i++){
                   if(!filter_var($companyemail[$i], FILTER_VALIDATE_EMAIL) && !empty($companyemail[$i])){
                   $error="line no ".$importData[0]." Company Email not valid";
                   $errors[]=$error;
                 }
                }
      //company email type name match validation
                foreach($companyemailtype as $string)
                {
                  if($string != ""){
                    if("Work" == $string || "Other" == $string) 
                    {

                     
                    }
                    else{

                       $error="line no ".$importData[0]." Company Email Type Name not match";
                       $errors[]=$error;
                    }
                   }
                }
              //company phone validation
               $companyphone=explode(';',$importData[3]);
               $companyphonecount=count($companyphone);
               $companyphonetype=explode(';',$importData[4]);
               $companyphonetypecount=count($companyphonetype);

               if( $companyphonecount != $companyphonetypecount)
               {

                  $error="line no ".$importData[0]." Company Phone and Company Phone Type not match";
                  $errors[]=$error;
                  
               }
    //company phone type name match validation
              foreach($companyphonetype as $string)
               {
                  if($string != ""){
                    if("Mobile" == $string || "Landline" == $string) 
                    {

                     
                    }
                    else{

                       $error="line no ".$importData[0]." Company Phone Type Name not match";
                       $errors[]=$error;
                    }
                   }
                }
               
    //client phone validation
               $phone=explode(';',$importData[16]);
               $phonecount=count($phone);
               $phonetype=explode(';',$importData[17]);
               $phonetypecount=count($phonetype);

               if( $phonecount != $phonetypecount)
               {
                $error="line no ".$importData[0]." Client Phone and Client Phone Type not match";
                  $errors[]=$error;
                  
               }
      //client phone type name match validation
              foreach($phonetype as $string)
               {
                  if($string != ""){
                    if("Mobile" == $string || "Landline" == $string) 
                    {

                     
                    }
                    else{

                       $error="line no ".$importData[0]." Client Phone Type Name not match";
                       $errors[]=$error;
                    }
                   }
                }
               
        //client email validation
               $email=explode(';',$importData[18]);
               $emailcount=count($email);
               $emailtype=explode(';',$importData[19]);
               $emailtypecount=count($emailtype);
           
               if($emailcount != $emailtypecount){
                 
                   $error="line no ".$importData[0]." Client Email and Client Email Type not match";
                   $errors[]=$error;
               }
               
               for($i=0; $i < $emailcount; $i++){
                   if(!filter_var($email[$i], FILTER_VALIDATE_EMAIL) && !empty($email[$i])){
                   $error="line no ".$importData[0]." Client Email not valid";
                   $errors[]=$error;
                 }
               }
      //client email type name match validation
              foreach($emailtype as $string)
              {
                  if($string != ""){
                    if("Work" == $string || "Home" == $string) 
                    {

                     
                    }
                    else{

                       $error="line no ".$importData[0]." Client Email Type Name not match";
                       $errors[]=$error;
                    }
                   }
              }
          }
      
        if(count($errors)>0){
         //return view('company.viewcompany.view',['errors'=>$errors]);
         return  redirect()->back()->with('errors',$errors);
       }
     
      // Insert to MySQL database
         $test=[];
          foreach($importData_arr as $importData){
                 // dd($importData[0]);
              //company detail
            $importData1 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[1]);
            $companynamedd=trim($importData1);
            // dd($companynamedd);
            $companynames=Company_Master::where('company_name',$companynamedd)->get();
            if(count($companynames)>0){
                foreach($companynames as $companyname){}
                $companyobject=Company_Master::find($companyname->id);
               
            //clientdata
               $importData11 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[11]);
               $importData12 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[12]);
               $importData13 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[13]);

              $checkname=trim($importData11)." ".trim($importData12)." ".trim($importData13);
              $clientnames=Client_Master::where([['client_name','=',$checkname],['company_id','=',$companyname->id]])->get();
              if(count($clientnames)>0){

              }
              else{
              if($importData12 != ""){
              
               

                $clientdata=new Client_Master;
               
                $clientdata->salutation_name=trim($importData11);
              
                $clientdata->client_first_name=trim($importData12);
               
                $clientdata->client_name=trim($importData11)." ".trim($importData12)." ".trim($importData13);
                $clientdata->client_last_name=trim($importData13);
                $importData14 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[14]);
                $clientdata->linkedin_url=trim($importData14);
                $importData15 = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[15]);
                $clientdata->client_designation=trim($importData15);
                $clientdata->company_id= $companyname->id;
                $clientdata->user_assign_id=6;
                $clientdata->created_user_id=Auth()->user()->id;
                $clientdata->clientconverted="converted";
                $clientdata->save();

              
                //add client mobile
                $phone=explode(';',$importData[16]);
                $type=explode(';',$importData[17]); 
                $phonecount=count($phone);
                $mp=0;
                $ml=0;
                for($i=0; $i < $phonecount; $i++){
                 if($phone[$i] != ""){
                    $phone[$i]= trim($phone[$i]);
                    $checkclientphone=Client_phone_number::where('client_phone',$phone[$i])->get();
                  if(count($checkclientphone)>0){
                  }
                  else{
                    $clientnumber=new Client_phone_number;
                    $clientnumber->client_phone=$phone[$i];
                       if($type[$i] == 'Mobile'){
                          $mp++;
                          $clientnumber->phone_type=$type[$i].$mp;
                       }
                       else{
                         $ml++;
                         $clientnumber->phone_type=$type[$i].$ml;
                       }
                    $clientnumber->client_id=$clientdata->id;
                    $clientnumber->save();
                  }
                 }
                 
                }
                //add client email
                $email=explode(';',$importData[18]);
                $email_type=explode(';',$importData[19]); 
                $emailcount=count($email);
                 $ew=0;
                 $eh=0;
                for($i=0; $i < $emailcount; $i++){
                  if($email[$i] != ""){
                    $email[$i]= trim($email[$i]);
                    $checkclientemail=Client_email_address::where('client_email',$email[$i])->get();
                   if(count($checkclientemail)>0){
                   }
                   else{
                     $clientemail=new Client_email_address;
                     $clientemail->client_email=$email[$i];
                     if($email_type[$i] == "Work"){
                        $ew++;
                        $clientemail->email_type=$email_type[$i].$ew;
                     }
                     else
                     {
                         $eh++;
                         $clientemail->email_type=$email_type[$i].$eh;
                     }
                     $clientemail->client_id=$clientdata->id;
                     $clientemail->save();
                   }
                  }
                }
              }
            }
            }
            else{
              //search seat data
          $seatshowdata=Uploadseatdetail::where('seatname',$filename)->value('id');  
              if($seatshowdata == null){
              //insert seat data
                  $seatdata=new Uploadseatdetail;
                  $seatdata->seatname=$filename;
                  $seatdata->save();
                  $seatshowdata=$seatdata->id;
              }
          $lastcomdata=DB::table('company_masters')->latest('id')->first();

                 //company data
                 $companydata= new Company_Master;

                 $importData1= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[1]);
                 $companydata->company_name=trim($importData1);
                 $importData2= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[2]);
                 $companydata->website_address=trim($importData2);
                 $importData8= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[8]);
                 $companydata->vendor_type=trim($importData8);
                 $importData9= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[9]);
                 $companydata->type_business=trim($importData9);
                  $importData10= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[10]);
                 $companydata->source=trim($importData10);
                  
                 $companydata->created_user_id=Auth()->user()->id;
                 $companydata->user_assign_id=6;
                 $companydata->converted='converted';
                 $companydata->seat_id=$seatshowdata;
                 $companydata->coid=$lastcomdata->coid+1;
                 $companydata->save();
                 
                //company phone number
                 $importDataph=preg_replace('/[\x00-\x1F\x80-\xFF]/', "'", $importData[3]);
                 $companyphone=explode(';',$importDataph);
                 $companyphonetype=explode(';',$importData[4]); 
                 $companyphonecount=count($companyphone);
                  $mcp=0;
                  $mcl=0;
                 for($i=0; $i < $companyphonecount; $i++){
                  if($companyphone[$i] != ""){
                      $companyphone[$i]= trim($companyphone[$i]);
                      $checkcompanyphone=Company_phone_number::where('company_phone',$companyphone[$i])->get();
                    if(count($checkcompanyphone)>0){
                       }
                    else{
                    $phonenumber=new Company_phone_number;
                    $phonenumber->company_phone=$companyphone[$i];
                    if($companyphonetype[$i] == 'Mobile'){
                      $mcp++;
                      $phonenumber->phone_type=$companyphonetype[$i].$mcp;
                    }
                    else{
                      $mcl++;
                      $phonenumber->phone_type=$companyphonetype[$i].$mcl;
                    }
                    $phonenumber->company_id=$companydata->id;
                    $phonenumber->save();
                    } 
                  }
                 }
                //company email
                 $companyemail=explode(';',$importData[5]);
                 $companyemailtype=explode(';',$importData[6]); 
                 $companyemailcount=count($companyemail);
                  $ecw=0;
                  $ech=0;
                 for($i=0; $i < $companyemailcount; $i++){
                  if($companyemail[$i] != ""){
                     $companyemail[$i]= trim($companyemail[$i]);
                      $checkcompanyemail=Company_email_address::where('company_email',$companyemail[$i])->get();
                    if(count($checkcompanyemail)>0){
                       }
                    else{
                      $companyemailaddress=new Company_email_address;
                      $companyemailaddress->company_email=$companyemail[$i];
                    if($companyemailtype[$i] == "Work"){
                      $ecw++;
                      $companyemailaddress->email_type=$companyemailtype[$i].$ecw;
                     }
                     else{
                        $ech++;
                        $companyemailaddress->email_type=$companyemailtype[$i].$ech;
                     } 
                      $companyemailaddress->company_id=$companydata->id;
                      $companyemailaddress->save(); 
                    }
                  } 
                 }

               //company address
                $companyaddress=new Company_address;
                $importData20= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[20]);
                $companyaddress->house_no=trim($importData20);
                $importData21= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[21]);
                $companyaddress->street_name=trim($importData21);
                $importData22= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[22]);
                $companyaddress->address_line_2=trim($importData22);
                $importData23= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[23]);
                $companyaddress->County=trim($importData23);
                 $importData24= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[24]);
                $companyaddress->state=trim($importData24);
                 $importData25= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[25]);
                $companyaddress->Country=trim($importData25);
                 $importData26= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[26]);
                $companyaddress->zip_code=trim($importData26);
                 $importData27= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[27]);
                $companyaddress->time_zone=trim($importData27);
                 $importData7= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[7]);
                $companyaddress->fax_no=trim($importData7);
                $companyaddress->company_id=$companydata->id;
                $companyaddress->save();

               //clientdata
                $importData12= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[12]);
              if($importData12 != "")
              {
                $clientdata=new Client_Master;
                $importData11= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[11]);
                $clientdata->salutation_name=trim($importData11);
                $importData12= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[12]);
                $clientdata->client_first_name=trim($importData12);
                $importData13= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[13]);
                $clientdata->client_last_name=trim($importData13);
                $clientdata->client_name=trim($importData11)." ".trim($importData12)." ".trim($importData13);
                $importData14= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[14]);
                $clientdata->linkedin_url=trim($importData14);
                $importData15= preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $importData[15]);
                $clientdata->client_designation=trim($importData15);
                $clientdata->company_id= $companydata->id;
                 $clientdata->user_assign_id=6;
                $clientdata->created_user_id=Auth()->user()->id;
                $clientdata->clientconverted="converted";
              //  $clientdata->lead_description= $importData[5];
                $clientdata->save();
              
              //client phone
               $phone=explode(';',$importData[16]);
               $type=explode(';',$importData[17]); 
               $phonecount=count($phone);
                $mp=0;
                $ml=0;
                for($i=0; $i < $phonecount; $i++){
                 if($phone[$i] != ""){
                   $phone[$i]= trim($phone[$i]);
                  $checkclientphone=Client_phone_number::where('client_phone',$phone[$i])->get();
                  if(count($checkclientphone)>0){
                  }
                  else{
                    $clientnumber=new Client_phone_number;
                    $clientnumber->client_phone=$phone[$i];
                    if($type[$i] == 'Mobile'){
                       $mp++;
                       $clientnumber->phone_type=$type[$i].$mp;
                    }
                    else{
                       $ml++;
                       $clientnumber->phone_type=$type[$i].$ml;
                    }   
                    $clientnumber->client_id=$clientdata->id;
                    $clientnumber->save();
                  }
                 } 
                }

                //client_email
               $email=explode(';',$importData[18]);
               $email_type=explode(';',$importData[19]); 
               $emailcount=count($email);
               $ew=0;
               $eh=0;
                for($i=0; $i < $emailcount; $i++){
                  if($email[$i] != ""){
                    $email[$i]= trim($email[$i]);
                    $checkclientemail=Client_email_address::where('client_email',$email[$i])->get();
                   if(count($checkclientemail)>0){
                   }
                   else{
                     $clientemail=new Client_email_address;
                     $clientemail->client_email=$email[$i];
                     if($email_type[$i] == "Work"){
                       $ew++;
                      
                       $clientemail->email_type=$email_type[$i].$ew;
                     }
                     else
                     {
                       $eh++;
                       $clientemail->email_type=$email_type[$i].$eh;
                     }
                     $clientemail->client_id=$clientdata->id;
                     $clientemail->save();
                    } 
                  }
                }
              
              } 
            }      
          }
       
                    $notification = array(
                    'message' => 'Data Uploaded Successfully!', 
                    'alert-type' => 'success'
                  );

            return  redirect()->back()->with($notification);

        }
        else{
          $notification = array(
                    'message' => 'File too large. File must be less than 2MB.', 
                    'alert-type' => 'error'
                  );
           return  redirect()->back()->with($notification);
         
        }
      }
      else{
        $notification = array(
                    'message' => 'Invalid File Extension.', 
                    'alert-type' => 'error'
                  );
         return  redirect()->back()->with($notification);

      }
    }
    else{
       $notification = array(
                    'message' => 'Please upload file.', 
                    'alert-type' => 'error'
                  );
       return  redirect()->back()->with($notification);
    }
  }


//to strore company and client data.
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
           return Redirect::back()->withErrors($v)->withInput();
      }

     // dd($request->client_phone);
      //dd(isset($request->client_phone));
      $companynames=Company_Master::where('company_name',$request->company_name)->get();
      if(count($companynames)>0){
         foreach($companynames as $companyname){}
          //company email and phone
          
          //client data
          $companydata1=$companyname->id;
         $clientcount=$request->lastvalue;
         for($i=0;$i<=$clientcount;$i++){
          if(isset($request->client_first_name[$i])){
           $clientdata=new Client_Master;
           $clientdata->salutation_name= $request->salutation_name[$i];
           $clientdata->client_first_name= $request->client_first_name[$i];
           $clientdata->client_last_name= $request->client_last_name[$i];
           $clientdata->linkedin_url= $request->linkedin_url[$i];
           $clientdata->client_designation= $request->client_designation[$i];
           $clientdata->clientconverted="converted";
           $clientdata->company_id=$companyname->id;
           $clientdata->save();
          

         
      //store phonenumber
          // $phonecount=count($request->client_phone);
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
                  $clientnumber->phone_type=$request->phone_type[$i][$j];
                  $clientnumber->client_id=$clientdata->id;
                  $clientnumber->save();           
          }
        }
        
    //store client email
          // $emailcount=count($request->email);
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
      
    //company detail
       $lastcomdata=DB::table('company_masters')->latest('id')->first();
    
        $companydata= new Company_Master;
        $companydata->company_name=$request->company_name;
        $companydata->website_address=$request->website_address;
        $companydata->vendor_type=$request->vendor_type;
        // $companydata->industry=$request->industry;
        $companydata->type_business=$request->type_business;
        $companydata->lead_description=$request->lead_description;
        $companydata->user_assign_id=6;
        $companydata->created_user_id=auth()->user()->id;
        $companydata->coid=$lastcomdata->coid+1;
        $companydata->created_atus=Carbon::now('America/New_York');
        $companydata->converted='converted';
        $companydata->save();
         $companydata1=$companydata->id;

    //company address 
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

    //company phno
      $companyphonecount=count($request->companyclient_phone);
      $mp=0;
      $ml=0;
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

      
    //add company email
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

    //add client data
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
         $clientdata->clientconverted="converted";
         $clientdata->company_id=$companydata->id;
         $clientdata->save();
        

       
    //store phonenumber
        // $phonecount=count($request->client_phone);
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
      
  //store email
        // $emailcount=count($request->email);
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
           $link= route('company.show',['id'=> $companydata1,'backto'=>"index"]);
             $details = [
               'data' =>"<a href='{$link}'>{$companydata->company_name}</a> company has been created by ".auth()->user()->name.".",  
              ];
            Notification::send($user1, new MyEventNotification($details)); 
       }
       elseif(auth()->user()->designation == "Sales Executives"){

           $user = User::find(auth()->user()->team_leader_id);
           $user1=User::where('id',auth()->user()->id)->get();
           $link= route('company.show',['id'=> $companydata1,'backto'=>"index"]);
           $details = [
                  'data' =>"<a href='{$link}'>{$companydata->company_name}</a> company has been created by ".auth()->user()->name.".",  
            ];
          Notification::send($user, new MyEventNotification($details));
          Notification::send($user1, new MyEventNotification($details));  
       }

   } 
      Session::flash('flash_message', 'Company Added Successfully');        
      return Redirect::back();
         //return redirect()->route('company.show', ['id' => $companydata1,'backto'=>'index']);  
}
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Company_Master  $company_Master
     * @return \Illuminate\Http\Response
     */
    public function show($id,$backto)
    {
         $companydata=Company_Master::findorfail($id);
         $rolelevel=Role::where('slug','bde')->pluck('level');
        if(Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companydata->user_assign_id  || auth()->user()->id == $companydata->created_user_id){
       // $companydata=Company_Master::find($id);
        $companyaddresses=Company_address::where('company_id',$companydata->id)->get();
         
        foreach($companyaddresses as  $companyaddress){}

        $companyphones=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();
       
        $companyemails=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();

        $users=User::where('id',$companydata->user_assign_id)->get();
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

        return view('company.showcompany.view',['companydata'=>$companydata,'companyaddress'=>$companyaddress,'user_name'=>$user_name,'user_id'=>$user_id,'companyemails'=>$companyemails,'companyphones'=>$companyphones,'backto'=>$backto]); 
      }
       else{
          return view('error.403');
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company_Master  $company_Master
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$backto)
    {


      $companydata=Company_Master::findorfail($id);
      $rolelevel=Role::where('slug','bde')->pluck('level');
    
       if( Auth::user()->level() >= $rolelevel[0] || auth()->user()->id ==  $companydata->user_assign_id ||  auth()->user()->id == $companydata->created_user_id || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasPermission('edit.company'))
       {

          $companyaddress=$companydata->CompanyAddress;
          // $companyphones=$companydata->CompanyPhone;
          // $companyemails=$companydata->CompanyEmail; 
           $companyphones=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();
          $companyemails=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();


          $users=User::where('id',$companydata->user_assign_id)->get();
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
             if(Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
               return view('companydataoperator.editcompany.view',['companydata'=>$companydata,'companyaddress'=>$companyaddress,'companyphones'=>$companyphones,'companyemails'=>$companyemails,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]); 
             }
             else{
              return view('company.editcompany.view',['companydata'=>$companydata,'companyaddress'=>$companyaddress,'companyphones'=>$companyphones,'companyemails'=>$companyemails,'user_name'=>$user_name,'user_id'=>$user_id,'backto'=>$backto]); 
            }
        }
        else{
             return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company_Master  $company_Master
     * @return \Illuminate\Http\Response
     */
    //use to update only company data
    public function update(Request $request)
    {

      //dd($request->all());
 
      // dd($request->company_email_type);
        $companydata=Company_Master::find($request->id);
      if (auth()->user()->hasPermission('edit.company.name') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){  
        $companydata->company_name=$request->company_name;
      }  
      if (auth()->user()->hasPermission('edit.company.website') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){  
        $companydata->website_address=$request->website_address;
      }  
      if (auth()->user()->hasPermission('edit.company.vendor.type') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
        $companydata->vendor_type=$request->vendor_type;
      }
     
      //$companydata->industry=$request->industry;
      if (auth()->user()->hasPermission('edit.company.bussiness.type') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
        $companydata->type_business=$request->type_business;
      }
      if (auth()->user()->hasPermission('edit.company.description') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
        $companydata->lead_description=$request->lead_description;
      }
        // $companydata->user_assign_id=$request->user_id;
        $companydata->update();

    //update company data this method is not work for activity log
        
        //$update_company_data=Company_Master::where('id',$request->id)->update(['company_name' => $request->company_name,'website_address' => $request->website_address,'vendor_type' => $request->vendor_type,'industry'=>$request->industry,'lead_description'=>$request->lead_description,'user_assign_id'=>$request->user_id]);

    //update address data
    if (auth()->user()->hasPermission('edit.company.address') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
        $companyaddresses=$companydata->CompanyAddress;
      
         $update_company_address=Company_address::find($companyaddresses->id);
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
         $update_company_address->fax_no=$request->fax_no;
         $update_company_address->update();
    }
        
          // $update_company_address->update(['house_no'=>$request->house_no,'street_name'=>$request->street_name,'address_line_2'=>$request->address_line_2,'County'=>$request->County,'State'=>$request->State,'Country'=>$request->Country,'zip_code'=>$request->zip_code,'time_zone'=>$request->time_zone,'fax_no'=>$request->fax_no]);  


    //update company phno
    if (auth()->user()->hasPermission('edit.company.phone') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
         $phonearray=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();
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
                $id=$phoneidarray[$i];
                $update_phone=Company_phone_number::find($id);
                $update_phone->company_phone=$request->companyclient_phone[$i];
                $update_phone->phone_type=$request->company_phone_type[$i];
                $update_phone->update();

               //$update_phone=Company_phone_number::where('id',$id)->update(['company_phone'=>$request->companyclient_phone[$i]]);   
           }  
    
    //add new company number
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

       $newphonecount=count($request->companyclient_phone);
        for($i=$phonecount; $i < $newphonecount; $i++){
          if(isset($request->companyclient_phone[$i])){
            $companynumber=new Company_phone_number;
                $companynumber->company_phone=$request->companyclient_phone[$i];
              if($request->company_phone_type[$i] == 'Mobile'){
                 $pm++;
                 $companynumber->phone_type=$request->company_phone_type[$i].$pm;
              }
              else{
                 $pl++;
                 $companynumber->phone_type=$request->company_phone_type[$i].$pl;
              }
                $companynumber->company_id=$request->id;
                $companynumber->save();
        } 
       }
    }
    //update comapany email
      //$emailarray=$companydata->CompanyEmail;
        // $emailarray=Company_email_address::where([['company_id',$request->id],['deleted',0]]);
    if (auth()->user()->hasPermission('edit.company.email') || Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
       $emailarray=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();
        // dd($emailarray);
        $emailidarray=[];
        $emailtype_w=[];
        $emailtype_o=[];
        foreach($emailarray as $email_data)
        {
              $email_id=$email_data->id;
             if(strpos($email_data ,"Work")){
                $emailtype_w[]=$email_data->email_type;
             }
             else{
                $emailtype_o[]=$email_data->email_type;
             }
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
        $emailtype_w=end($emailtype_w);   
        $emailtype_w=substr($emailtype_w, -1);
        $emailtype_o=end($emailtype_o);   
        $emailtype_o=substr($emailtype_o, -1); 
        if( $emailtype_w != ""){
          $ew= $emailtype_w;
        }
        else{
          $ew=0;
        }
        if( $emailtype_o != ""){
          $eo= $emailtype_o;
        }
        else{
          $eo=0;
        }
        if(isset($request->companyemail)){
            $newemailcount=count($request->companyemail);
            for($i=$emailcount; $i < $newemailcount; $i++){
               if(isset($request->companyemail[$i])){
                $comemail=new Company_email_address;
                    $comemail->company_email=$request->companyemail[$i];
                   if($request->company_email_type[$i] == "Work"){
                       $ew++;
                       $comemail->email_type=$request->company_email_type[$i].$ew; 
                   }
                   else{
                       $eo++;
                       $comemail->email_type=$request->company_email_type[$i].$eo; 
                   }
                    $comemail->company_id=$request->id;
                    $comemail->save();  
                }           
            }    
        }
    }
    if(Auth::user()->hasRole('data.entry.manager') || Auth::user()->hasRole('data.entry')){
       return redirect()->route('company.dataentryshow', ['id' => $companydata->id,'backto'=>$request->backto]);
    }
    else{
         return redirect()->route('company.show', ['id' => $companydata->id,'backto'=>$request->backto]);
       }
    }

   
    public function destroy(Company_Master $company_Master)
    {
        //
    }

    public function phonedelete($id){  
            $info=Company_phone_number::find($id);
            $deletephone=Company_phone_number::find($id);
            $companyinfo=Company_Master::find($deletephone->company_id);
            $deletephone->update(['deleted'=>1]);
            $activity = Activity::all()->last();

            $activity->update(['description'=>'Delete','attributes1'=>$deletephone->company_phone. ' Deleted','attributes2'=>$companyinfo->company_name,'attributes3'=>$companyinfo->id,'attributes4'=>$companyinfo->id]);
           // return  response()->json(['data'=>$deletephone]);
    }

    public function emaildelete($id){

            $deleteemail=Company_email_address::find($id);
            $companyinfo=Company_Master::find($deleteemail->company_id);
            $deleteemail->update(['deleted'=>1]);
            $activity = Activity::all()->last();
            $activity->update(['description'=>'Delete','attributes1'=>$deleteemail->company_email. ' Deleted','attributes2'=>$companyinfo->company_name,'attributes3'=>$companyinfo->id,'attributes4'=>$companyinfo->id]);
            // return  response()->json(['data'=>$deleteemail]);
    }


   public function relatedclients($id){

      $q1=DB::raw("(SELECT GROUP_CONCAT(client_phone_numbers.client_phone,'(',client_phone_numbers.phone_type,')') FROM client_phone_numbers WHERE client_phone_numbers.client_id = client_masters.id and client_phone_numbers.deleted=0 GROUP BY client_masters.id ) as client_phone_no");
      $q2=DB::raw("(SELECT GROUP_CONCAT(client_email_addresses.client_email,'(',client_email_addresses.email_type,')') FROM client_email_addresses WHERE client_email_addresses.client_id = client_masters.id and client_email_addresses.deleted=0 GROUP BY client_masters.id ) as client_email_add");

         //    $q3=DB::raw("(SELECT GROUP_CONCAT(company_phone_numbers.company_phone_number) FROM company_phone_numbers WHERE  company_phone_company_master.company_phone_id = company_phone_numbers.id GROUP BY company_phone_company_master.company_id ) as company_phone_numbers1");

         $data =DB::table('client_masters')
        ->leftJoin('client_email_addresses','client_masters.id','=','client_email_addresses.client_id')
         //  // ->select('company_address_company_master.*')
         ->leftJoin('client_phone_numbers','client_masters.id','=','client_phone_numbers.client_id')
         //   ->join('email_company_master','email_company_master.company_id','=','company_masters.id')
         //   //->select('email_company_master.*')
         //   ->join('email_addresses','email_addresses.id','=','email_company_master.email_id')
         //   ->join('company_phone_company_master','company_phone_company_master.company_id','=','company_masters.id')
         //   // ->select('company_phone_company_master.*')
         //     ->join('company_phone_numbers','company_phone_numbers.id','=','company_phone_company_master.company_phone_id')
         //   //  ->select('company_phone_numbers.*')
         ->select('client_masters.id','client_masters.client_name','client_masters.client_designation',$q1,$q2)
         ->distinct()->groupBy('client_masters.id','client_masters.client_name','client_masters.client_designation','client_phone_numbers.client_phone','client_phone_numbers.phone_type','client_email_addresses.client_email','client_email_addresses.email_type')->where([["company_id",$id],['client_masters.deleted',0]]);

         // return Datatables::of($data)




        //$data =Client_Master::query()->where("company_id",$id);
         return Datatables::of($data)
          // ->addColumn('name2',function($data){
          //       $show= route('client.show',['id'=> $data->id]);
          //       $first=$data->client_first_name;
          //            $btn="<a href='{$show}'>sda</a>";
          //            return $btn;
          //  })
          //  ->addColumn('email',function($data){
          //            // $clientdata=Client_Master::find($data->id);
          //           $emailarray=$data->ClientEmail;
          //           foreach ($emailarray as $emailarra) {}
          //           $btn=$emailarra->client_email;
          //           return $btn;
          //  })
          //  ->addColumn('phone',function($data){
          //            // $clientdata=Client_Master::find($data->id);
          //           $phonearray=$data->ClientPhone;
          //           foreach ($phonearray as $phonearra) {}
          //           $btn=$phonearra->client_phone;
          //           return $btn;
          //  })
           ->addColumn('delete',function($data){
            
                    return "<button class='deletedata btn btn-sm btn-fill btn-danger' value='{$data->id}'>Delete</button>";
           })
           ->addColumn('edit',function($data){
                $name=$data->id;
                $show= route('client.show',['id'=> $data->id,'backto'=>'company']);
                    return "<a href='{$show}' class='btn btn-sm btn-fill btn-info'>Show</a>";
           })
          
         ->escapeColumns([])  
         ->make(true);
   
    }
    public function getnamewebsite(Request $request){
       $comapnynames=Company_Master::where('website_address','=',$request->websiteval)->get();
       if(count($comapnynames) > 0){
            $data="yes";
       }
       else{
          $data="";
       }
       return $data;
    }
    public function getname(Request $request){

     //  if($request->get('companyname'))
     // {
     //  $query = $request->get('companyname');
     //  $data =Company_Master::where('company_name', 'LIKE', "%{$query}%")->get();
     //  $output = '<ul class="dropdown-menu inner" style="display:block; position:relative">';
     //  foreach($data as $row)
     //  {
     //   $output .= '
     //   <li>'.$row->company_name.'</li>
     //   ';
     //  }
     //  $output .= '</ul>';
     //  echo $output;
   
     // }
      
         $comapnynames=0;
         $comapnynames=Company_Master::where('company_name','=',$request->companyname)->get();
         $output="";
         foreach($comapnynames as $comapnyname){
                $output=$comapnyname->company_name;
                 
            }
       
            return $output;
    }
    public function nameexist(Request $request){
      $exist=Company_Master::where('company_name',$request->comp)->get();
      $countexist=count($exist);
       return  response()->json(['countexist'=>$countexist]);
    }

    public function statename(Request $request){
          
              $name=$request->countryname;

              $countries=DB::table('countrylists')->where('country_name',$name)->get();
              foreach($countries as $country){}
              $states=DB::table('statelist')->where('countryid',$country->id)->OrderBy('statename')->get();
              $state=[];
               foreach($states as $state1){
                   $state2=$state1->statename;
                   $state[]=$state2;

               }
              return  response()->json($state);

  } 

    public function cityname(Request $request){
          
              $state_name=$request->statename;
              $states=DB::table('statelist')->where('statename',$state_name)->get();
               foreach ($states as $timezones) {
                 $time=$timezones->timezone;
               }
              $cities=DB::table('citylists')->where('state_name',$state_name)->get();
              $city=[];
               foreach($cities as $cities1){
                   $cities2=$cities1->city;
                   $city[]=$cities2;

               }
              return  response()->json(['city'=>$city,'time'=>$time]);

  } 

   public function anydataactivity()
    {



        $data =DB::table('activity_log')
        ->join('users','activity_log.causer_id','=','users.id')
        ->select('activity_log.id','activity_log.log_name','activity_log.attributes2','activity_log.attributes1','users.name','activity_log.description','activity_log.created_at');

        // ->distinct()->groupBy('activity_log.id','activity_log.log_name','activity_log.subject_id','activity_log.subject_type','activity_log.properties','users.name','activity_log.description');

         return Datatables::of($data)
          
          
         ->escapeColumns([])  
         ->make(true);

    }

    public function relatedclientdelete(Request $request)
    {
          // dd($request->clientid);
          $clientdata=Client_Master::find($request->clientid);
          $companyname=Company_Master::find($clientdata->company_id);
          $id=$request->clientid;
          $deleteclient=Client_Master::find($id);
          $deleteclient->update(['deleted'=>1]);
        
          $activity = Activity::all()->last();
           $activity->update(['log_name'=>'Company Client','attributes1'=>$clientdata->client_first_name. ' Deleted','attributes2'=>$companyname->company_name,'attributes3'=>$clientdata->company_id,'description'=>'Delete','subject_type'=>'App\Company_Master']);
             return  response()->json(['data'=>$request->clientid]);

          // $activity->update(['log_name'=>$clientdata->client_first_name. 'Deleted','subject_id'=>$clientdata->company_id,'subject_type'=>'App\Company_Master']);
    }

    public function assignuserfromtable(Request $request){
        
          $companyids=$request->companyid;
          $selectedcompnyid = array_map('intval', explode(',', $request->companyid));
          $companyidlegnth=count($selectedcompnyid);
  
          for($i=0;$i< $companyidlegnth;$i++){
              $comapnydata=Company_Master::find($selectedcompnyid[$i]);
              $comapnydataconvert=$comapnydata->converted;
              $comapnydata->user_assign_id=$request->userid;
              $comapnydata->user_assign_name=User::find($request->userid)->name;
              $comapnydata->assign_by=auth()->user()->name;
              if($request->userid == 6){
                 $comapnydata->assignstatus="Not Assign";
              }
              else{
                 $comapnydata->assignstatus="Assign";
              }
              $comapnydata->update();

              $checkassignuser=Assignuser::where([['company_id','=',$comapnydata->id],['unassign','=','assign']])->get();
              $countassignuser=count($checkassignuser);
              if($countassignuser > 0){
                 foreach ($checkassignuser as $assignuser){
                   if($assignuser->user_id == $request->userid){

                   }
                   else{
                        $changetounassun=Assignuser::find($assignuser->id);
                        $changetounassun->unassign="unassign";
                        $changetounassun->unassign_by=auth()->user()->id;
                        $changetounassun->update();
                   }
                    
                 }
              }
              if(isset($assignuser->user_id)){
                 $matchid= $assignuser->user_id;
              }
              else
              {
                 $matchid=6;
              }
              if($request->userid == 6 || $request->userid == $matchid){

              }
              else{
                $assignuserentry=new Assignuser;
                $assignuserentry->company_id=$comapnydata->id;
                $assignuserentry->user_id=$request->userid;
                $assignuserentry->assign_by=auth()->user()->id;
                $assignuserentry->save();
              }
              
          if($companyidlegnth < 6){
           if($comapnydata->converted == 'converted')  
           { 
              $user1=User::where('id',$request->userid)->get();
              $link= route('company.show',['id'=>$selectedcompnyid[$i],'backto'=>"normal"]);
              $details = [
              'data' =>"<a href='{$link}'>{$comapnydata->company_name}</a> company has been assigned to you by ".auth()->user()->name.".",  
               ];
              Notification::send($user1, new AssignuserNotification($details)); 
           }
           else{
               $user1=User::where('id',$request->userid)->get();
              $link= route('company.show',['id'=>$selectedcompnyid[$i],'backto'=>"normal"]);
              $details = [
              'data' =>"<a href='{$link}'>{$comapnydata->company_name}</a> lead has been assigned to you by ".auth()->user()->name.".",  
               ];
              Notification::send($user1, new AssignuserNotification($details)); 

           }
          }
        }
     if($companyidlegnth > 6){
           if($comapnydataconvert == 'converted')  
           { 
              $user1=User::where('id',$request->userid)->get();
              
              $details = [
              'data' =>"{$companyidlegnth} companies has been assigned to you by ".auth()->user()->name.".",  
               ];
              Notification::send($user1, new AssignuserNotification($details)); 
           }
           else{
               $user1=User::where('id',$request->userid)->get();
              
              $details = [
              'data' =>"{$companyidlegnth} leads has been assigned to you by ".auth()->user()->name.".",  
               ];
              Notification::send($user1, new AssignuserNotification($details)); 

           }
          }



    }
public function isexist(Request $request){
 
  if(is_numeric($request->id) && isset($request->email)){
      $match=Company_email_address::where([['company_email',$request->email],['id',$request->id],['deleted',0]])->get();
       if(count($match) == 1 ){
       
       } 
       else{
         $match=Company_email_address::where([['company_email',$request->email],['deleted',0]])->get();
            if(count($match) != 0){
                 return  response()->json("Already Exist");
            } 
       }
   }
   elseif(isset($request->email)){
      $match=Company_email_address::where([['company_email',$request->email],['deleted',0]])->get();
       if(count($match) != 0){
        return  response()->json("Already Exist");
       } 
   }
  if(is_numeric($request->id) && isset($request->phone)){
    
      $match=Company_phone_number::where([['company_phone',$request->phone],['id',$request->id],['deleted',0]])->get();
       if(count($match) == 1 ){
       
       } 
       else{
         $match=Company_phone_number::where([['company_phone',$request->phone],['deleted',0]])->get();
            if(count($match) != 0){
                 return  response()->json("Already Exist");
            } 
       }
   }
   elseif(isset($request->phone)){

      $match=Company_phone_number::where([['company_phone',$request->phone],['deleted',0]])->get();
       if(count($match) != 0){
        return  response()->json("Already Exist");
       } 
   }
       
 } 
 
 public function showemail(Request $request){
  
      $companyinfos=Company_email_address::where('company_id',$request->companyid)->pluck('company_email');
      $clientinfo=Client_Master::where([['company_id',$request->companyid],['deleted',0]])->pluck('id');
      $clientemail=Client_email_address::whereIn('client_id',$clientinfo)->pluck('client_email');
        $q2=DB::raw("(SELECT GROUP_CONCAT(client_email_addresses.client_email) FROM client_email_addresses WHERE client_email_addresses.client_id = client_masters.id  and client_email_addresses.deleted= 0 GROUP BY client_masters.id ) as client_email_add");
      $clientemails=DB::table('client_masters')
            ->leftJoin('client_email_addresses', 'client_masters.id', '=', 'client_email_addresses.client_id')
            ->select('client_masters.id','client_masters.client_name',$q2)
            ->whereIn('client_id',$clientinfo)
            ->distinct()->groupBy('client_masters.id','client_masters.client_name','client_email_addresses.client_email')
            ->get();
      // foreach ($clientemails as $clientemail) {
      //   # code...
      // }

        return  response()->json([$clientemails,$companyinfos]);
 }
 public function csvnameindex(Request $request){
    if ($request->ajax()) {
       $data=Uploadseatdetail::all();
       return Datatables::of($data)
       ->addColumn('nocompany',function($data){
                      $btn=Company_Master::where('seat_id',$data->id)->count();
                     return $btn;
           }) 
       ->addColumn('useatname',function($data){
                    $show= route('seat.seatsummaryshow',['id'=> $data->id]);
                    $seatname=$data->seatname;
                    $btn="<a href='{$show}'>{$seatname}</a>";
                  
                     return $btn;
           }) 
        ->addColumn('edit',function($data){
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-primary'>Edit</a>" ;
                     return $btn;
           }) 
          ->addColumn('show',function($data){
                      $btn="<a href='#' class='btn btn-sm btn-fill btn-info'>Show</a>";
                     return $btn;
           }) 
           ->escapeColumns([])  
           ->make(true);
    }  
    
    return view('uploadseats.viewuploadseat.view');      

 }  

 public function seatsummaryshow($id){
   $seat=Uploadseatdetail::find($id);
   $companyseatid=Company_Master::where('seat_id',$id)->pluck('id');
 
    $currentlyassigncompanydata=Assignuser::whereIn('company_id',$companyseatid)->where('unassign','=','assign')->count();
    $unassigncompanydata=Assignuser::whereIn('company_id',$companyseatid)->where('unassign','=','unassign')->count();
  
    $totalseatcompanydata=Company_Master::where('seat_id',$id)->count();
    
    $totalcall=Company_disposition::whereIn('company_id',$companyseatid)->count();
     $totaldisposition=Company_disposition::whereIn('company_id',$companyseatid)->count();
    //today disposition count 
        $date=Carbon::now('America/New_York');
         $typedetail='Today ('.$date->toDateString().')';
         $todaycountdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus',  $date->toDateString())->count();
        $comdispositionreports=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
         $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($comdispositionreports) > 0){
           $alldisposition="";
        $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($comdispositionreports as $comdispositionreport) {
             
                $alldisposition.="<tr><td>".$comdispositionreport->status."</td><td>".$comdispositionreport->count."</td></tr>";
               
           }
        }
        //today company that called count
        $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->whereIN('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
 
        $companycalled=count($companycalled);
     return view('uploadseats.seatsummary.view',compact('currentlyassigncompanydata','unassigncompanydata','totalseatcompanydata','totalcall','totaldisposition','seat','alldisposition','todaycountdisposition','typedetail','companycalled'));
 }

  public function csvupdate(Request $request){
      $updatecsvdata=Uploadseatdetail::find($request->id);
      $updatecsvdata->seatname=$request->name;
      $updatecsvdata->seatdeatails=$request->detail;
      $updatecsvdata->update();


  }
  public function seatdispositiondayinfo(Request $request){
    $companyseatid=Company_Master::where('seat_id',$request->seatid)->pluck('id');
    if($request->selecttype == 'Life Time') { 
      $typedetail=$request->selecttype;
      $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->count();

       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();

       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }

        //Life Time company that called count
       $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
        $companycalled=count($companycalled);
       
      }  
      if($request->selecttype == 'Today') { 
         $date=Carbon::now('America/New_York');
         $typedetail=$request->selecttype.' ('.$date->toDateString().')';
         $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus',  $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }
        //today company that called count
        $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
        $companycalled=count($companycalled);
      } 
      if($request->selecttype == 'Yesterday') { 
         $date=Carbon::yesterday('America/New_York');
         $typedetail=$request->selecttype.' ('.$date->toDateString().')';
         $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus',  $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }
       //yesterday company that called count
       $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
        $companycalled=count($companycalled);
      }
      if($request->selecttype == 'Last 7 Days') { 
         $date=Carbon::today('America/New_York')->subDays(7);
         $todaydate=Carbon::today('America/New_York');
       $typedetail=$request->selecttype.' ( '.$date->toDateString().' To '.$todaydate->toDateString().' )';
       $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=', $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }
        //Last 7 Days company that called count
        $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus','>=', $date->toDateString())->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
        $companycalled=count($companycalled);
      }
      if($request->selecttype == 'Last 30 Days') { 
         $date=Carbon::today('America/New_York')->subDays(30);
        $todaydate=Carbon::today('America/New_York');
        $typedetail=$request->selecttype.' ( '.$date->toDateString().' To '.$todaydate->toDateString().' )';
        $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=', $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }
         //Last 30 Days company that called count
        $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus','>=', $date->toDateString())->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
        $companycalled=count($companycalled);
      }
    if($request->selecttype == 'Custom') { 
        $from = date($request->date1);
        $to = date($request->date2);
        $typedetail=$request->selecttype.' ( '.$from.' To '.$to.' )';
      $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=',$from)->whereDate('created_atus','<=',$to)->count();
        
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',$from)->whereDate('created_atus','<=',$to)->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       
       $alldisposition="<tr><td colspan='2'>No Calls</td></tr>";
        if(count($outputs) > 0){
           $alldisposition="";
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);

           foreach($outputs as $output) {
             
                $alldisposition.="<tr><td>".$output->status."</td><td>".$output->count."</td></tr>";
               
           }
        }
      //Custome company that called count
      $companycalled=DB::table('company_dispositions')->select('company_dispositions.company_id')->whereDate('created_atus','>=',$from)->whereDate('created_atus','<=',$to)->whereIn('company_id',$companyseatid)->distinct('company_dispositions.company_id')->get();
      $companycalled=count($companycalled);
      }

        return Response([[$alldisposition],[$typedetail],[$countdisposition],[$companycalled]]);
    }
  public function seatdispositiondaychartinfo(Request $request){
   $companyseatid=Company_Master::where('seat_id',$request->seatid)->pluck('id'); 
  if($request->type == 'Life Time'){
    $typedetail=$request->type;
    $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->count();
    $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereIn('company_id','=',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
         $alldisposition='[["Task","Hours per Day"],';
       $dispositionlist="Answering Machine,Call Back,Cancel,Closed Window,Disconnected Number,Doesn't Qualify,Follow Up,Hang Up,Interested,No Answer,Not Interested,Number Not In Service,Wrong Number";
        $dispositionlistarray=explode(',', $dispositionlist);
              
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
        
        }
    }
  if($request->type == "Today"){

      $date=Carbon::now('America/New_York');
      $typedetail=$request->type.' ('.$date->toDateString().')';
      $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus',  $date->toDateString())->count();
      $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
           $alldisposition='[["Task","Hours per Day"],';
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
          
        }
    }
    if($request->type == "Yesterday"){

      $date=Carbon::yesterday('America/New_York');
      $typedetail=$request->type.' ('.$date->toDateString().')';
      $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus',  $date->toDateString())->count();
      $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
           $alldisposition='[["Task","Hours per Day"],';
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
          
        }

    }
    if($request->type == "Last 7 Days"){
     $date=Carbon::today('America/New_York')->subDays(7);
         $todaydate=Carbon::today('America/New_York');
       $typedetail=$request->type.' ( '.$date->toDateString().' To '.$todaydate->toDateString().' )';
       $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=', $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
           $alldisposition='[["Task","Hours per Day"],';
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
          
        }
    }
    if($request->type == "Last 30 Days"){
     $date=Carbon::today('America/New_York')->subDays(30);
        $todaydate=Carbon::today('America/New_York');
        $typedetail=$request->type.' ( '.$date->toDateString().' To '.$todaydate->toDateString().' )';
        $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=', $date->toDateString())->count();
       $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',  $date->toDateString())->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
       $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
           $alldisposition='[["Task","Hours per Day"],';
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
          
        }
    }
    if($request->type == "Custom"){
        $from = date($request->date1);
        $to = date($request->date2);
        $typedetail=$request->type.' ( '.$from.' To '.$to.' )';
        $countdisposition=DB::table('company_dispositions')->whereIn('company_id',$companyseatid)->whereDate('created_atus','>=',$from)->whereDate('created_atus','<=',$to)->count();

        $outputs=DB::table('company_dispositions')->select('company_dispositions.status',DB::raw("count(company_dispositions.status) as count"))->whereDate('created_atus','>=',$from)->whereDate('created_atus','<=',$to)->whereIn('company_id',$companyseatid)->groupBy('company_dispositions.status')->get();
        $alldisposition='[["Task","Hours per Day"]';
        if(count($outputs) > 0){
           $alldisposition='[["Task","Hours per Day"],';
           foreach($outputs as $output) {
                if($outputs->last() == $output) {
                   $alldisposition.='["'.$output->status.'",'.$output->count.']'; 
                }
                else{
                  $alldisposition.='["'.$output->status.'",'.$output->count.'],'; 
                }
                
               
           }
          
        }

    }
    $alldisposition.=']';
      return Response([[$alldisposition],[$typedetail],[$countdisposition]]);  
  }
public function tempindex(){
  return view('company.tempviewcompany.view');
}
public function tempanydata(){
  
          $rolelevel=Role::where('slug','bde')->pluck('level');
    
    if (Auth::user()->level() >= $rolelevel[0]){
        
               $data = Company_Master::with('CompanyAddress' )->where('converted','converted')
               ->where('company_masters.seat_id','=',4);
    }
    else{
            
                  $data = Company_Master::with('CompanyAddress' )->where('converted','converted')
                  ->where('company_masters.seat_id','=',4)->where('company_masters.user_assign_id',auth()->user()->id);
            }


               return Datatables::of($data)
         ->addColumn('checkbox',function($data){
                $checkboxvalue=$data->id;
                $btn="<input type='checkbox' name='checkbox1[]' class='checkboxid' value='{$checkboxvalue}'>";
                     return $btn;
           }) 
         ->addColumn('cname',function($data){
                 $edit= route('company.show',['id'=> $data->id,'backto'=>"index"]);
                 $companyname=$data->company_name;
                      $btn="<a href='{$edit}'>{$companyname}</a>";
                     return $btn;
           }) 
            ->addColumn('company_phone_no' , function($data){
                     //dd($data->id);

                $result  =  DB::table('company_phone_numbers')->select('company_phone', 'phone_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($;

                $company_phone_no='';

                 foreach ($result as $key => $value) {
                        $company_phone_no .=  $value->company_phone .'(' . $value->phone_type .')' .',';
                 }

                  return substr($company_phone_no,0, -1);

                //  dd($client_phone_no);

                 // return $client_phone_no;
           })
            ->addColumn('company_email_add' , function($data){
                    
                   $result  =  DB::table('company_email_addresses')->select('company_email', 'email_type')
                ->where('company_id','=', $data->id)->where('deleted' ,'=',0)->get();

                //dd($q1);
                $company_email_add = '';

                 foreach ($result as $key => $value) {
                        $company_email_add.=  $value->company_email .'(' . $value->email_type .')' .',';
                 }

                    return  substr($company_email_add , 0,-1);
           })
             ->addColumn('state', function(Company_Master $user){
                        $country = '';
                       // $cntry =  DB::table('company_addresses')->select('state')->where('company_id', $user->id)->get();
                        
                        //foreach ($cntry as $key ) {
                       //         $country .= $key->state;
                       // }
                  

                       $country= $user->CompanyAddress->state;

                   return  $country;
         })
           ->addColumn('Country', function($user){
                        
                        $country = '';
                        // $cntry =  DB::table('company_addresses')->select('country')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->country;
                        // }
                         $country= $user->CompanyAddress->Country;

                   return  $country;
         })
           ->addColumn('time_zone', function($user){
                       $country = '';
                        // $cntry =  DB::table('company_addresses')->select('time_zone')->where('company_id', $user->id)->get();
                        
                        // foreach ($cntry as $key ) {
                        //         $country .= $key->time_zone;
                        // }

                        $country= $user->CompanyAddress->time_zone;

                   return  $country;
         })
         
               ->filterColumn('company_phone_no', function ($query, $keyword) {
                $query->whereRaw("phone_no like ?", ["%{$keyword}%"]);
            })
                   ->filterColumn('company_email_add', function ($query, $keyword) {
                $query->whereRaw("company_email like ?", ["%{$keyword}%"]);
            })
                
         ->escapeColumns([])  
         ->make(true);
  }


  public function dataoperatoranydata(Request $request){

       if($request->ajax()){
    $rolelevel=Role::where('slug','data.entry')->pluck('level');     
    if (Auth::user()->level() == $rolelevel[0]){

        $q1=DB::raw("(SELECT GROUP_CONCAT(company_phone_numbers.company_phone,'(',company_phone_numbers.phone_type,')') FROM company_phone_numbers WHERE company_phone_numbers.company_id = company_masters.id and company_phone_numbers.deleted=0 GROUP BY company_masters.id ) as company_phone_no");
        
        $q2=DB::raw("(SELECT GROUP_CONCAT(company_email_addresses.company_email,'(',company_email_addresses.email_type,')') FROM company_email_addresses WHERE company_email_addresses.company_id = company_masters.id and company_email_addresses.deleted=0  GROUP BY company_masters.id ) as company_email_add");
        $data =DB::table('company_masters')
          ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          
          ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
          ->leftJoin('users','users.id','=','company_masters.created_user_id')
          ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','users.name','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.created_user_id','company_masters.created_atus',$q1,$q2)->where('converted','converted')->where('users.id',auth()->user()->id)
            ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','users.name','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.created_user_id','company_masters.created_atus'); 
              return Datatables::of($data)
          
         ->addColumn('cname',function($data){
                 $edit= route('company.dataentryshow',['id'=> $data->id]);
                 $companyname=$data->company_name;
                       $btn="<span data-toggle='tooltip' title='{$companyname}'><a href='{$edit}'>{$companyname}</a></span>";
                     return $btn;
           }) 
        
         ->escapeColumns([])  
         ->make(true);
       }
       else{

        $q1=DB::raw("(SELECT GROUP_CONCAT(company_phone_numbers.company_phone,'(',company_phone_numbers.phone_type,')') FROM company_phone_numbers WHERE company_phone_numbers.company_id = company_masters.id and company_phone_numbers.deleted=0 GROUP BY company_masters.id ) as company_phone_no");
        
        $q2=DB::raw("(SELECT GROUP_CONCAT(company_email_addresses.company_email,'(',company_email_addresses.email_type,')') FROM company_email_addresses WHERE company_email_addresses.company_id = company_masters.id and company_email_addresses.deleted=0  GROUP BY company_masters.id ) as company_email_add");
        $data =DB::table('company_masters')
          ->leftJoin('company_phone_numbers','company_masters.id','=','company_phone_numbers.company_id')
          ->leftJoin('company_email_addresses','company_masters.id','=','company_email_addresses.company_id')
          
          ->leftJoin('company_addresses','company_addresses.company_id','=','company_masters.id')
          ->leftJoin('users','users.id','=','company_masters.created_user_id')
          ->select('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','users.name','company_masters.industry','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.created_user_id','company_masters.created_atus',$q1,$q2)->where('converted','converted')->where([['users.designation','=','Data Entry'],['users.team_leader_id','=',auth()->user()->id]])
            ->distinct()->groupBy('company_masters.id','company_masters.coid','company_masters.company_name','company_masters.website_address','company_masters.industry','users.name','company_masters.type_business','company_addresses.state','company_addresses.Country','company_addresses.time_zone','company_masters.last_disposition','company_masters.created_user_id','company_masters.created_atus'); 
              return Datatables::of($data)
          
         ->addColumn('cname',function($data){
                 $edit= route('company.dataentryshow',['id'=> $data->id]);
                 $companyname=$data->company_name;
                       $btn="<span data-toggle='tooltip' title='{$companyname}'><a href='{$edit}'>{$companyname}</a></span>";
                     return $btn;
           }) 
        
         ->escapeColumns([])  
         ->make(true);
       }
      }
      return view('companydataoperator.viewcompany.view');
  }


  public function dataentryshow($id)
    {
         $companydata=Company_Master::findorfail($id);
         
        if(Auth::user()->hasRole('data.entry.manager') || auth()->user()->id ==  $companydata->user_assign_id  || auth()->user()->id == $companydata->created_user_id){
       // $companydata=Company_Master::find($id);
        $companyaddresses=Company_address::where('company_id',$companydata->id)->get();
         
        foreach($companyaddresses as  $companyaddress){}

        $companyphones=Company_phone_number::where([['company_id',$companydata->id],['deleted',0]])->get();
       
        $companyemails=Company_email_address::where([['company_id',$companydata->id],['deleted',0]])->get();

        $users=User::where('id',$companydata->user_assign_id)->get();
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

        return view('companydataoperator.showcompany.view',['companydata'=>$companydata,'companyaddress'=>$companyaddress,'user_name'=>$user_name,'user_id'=>$user_id,'companyemails'=>$companyemails,'companyphones'=>$companyphones]); 
      }
       else{
          return view('error.403');
       }
    }
}
