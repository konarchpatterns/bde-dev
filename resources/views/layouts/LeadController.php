<?php

namespace App\Http\Controllers;

use App\lead;
use App\Phone_no_client;
use App\Company_Master;
use App\Company_Address;
use App\Company_Phone_Number;
use App\Client_Master;
use App\Email_Address;
use App\Lead_Client_Detail;
use App\Company_Phone_Lead;
use App\Company_Phone_Company_Master;
use App\Email_Lead;
use App\Email_Client;
use App\Lead_Client_Phone;
use App\Client_Phone_Client;
use App\Company_Address_Lead;
use App\Company_Address_Company_Master;
use App\Company_Master_Lead;
use App\Client_Company_Address;
use App\Company_Master_Phone_Client;
use App\Email_Company_Master;
use App\Opportunity;
use DataTables;
use Illuminate\Http\Request;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('leads.viewleads.view');
    }

    public function anydata(){

        $data =lead::query();
         return Datatables::of($data)
         ->addColumn('edit',function($data){
                $edit= route('lead.show',['id'=> $data->id]);
                     $btn="<a href='{$edit}'><i class='fa fa-pencil-square-o'></i></a>";
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
        return view('leads.addlead.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //dd($request->filled('client_name'));
      
       
       //lead data 
       $leaddata = new Lead;
       $leaddata->salutation_name= $request->salutation_name;
       $leaddata->client_first_name= $request->client_first_name;
       $leaddata->client_last_name= $request->client_last_name;
       $leaddata->client_designation=$request->client_designation;
       $leaddata->company_name= $request->company_name;
       $leaddata->website_address = $request->website_address;
       $leaddata->lead_description= $request->lead_description;
       $leaddata->status_id= $request->status_id;
       $leaddata->lead_source= $request->lead_source;
       $leaddata->vendor_type= $request->vendor_type;
       $leaddata->opportunity_amount= $request->opportunity_amount;
       $leaddata->followup_date_time= $request->followup_date_time;
       $leaddata->industry= $request->industry;

       $leaddata->save();
       
       
     

       //company address data 
       $companyaddressdata=new Company_Address;
       $companyaddressdata->street_name=$request->street_name;
       $companyaddressdata->house_no=$request->house_no;
       $companyaddressdata->address_line_2=$request->address_line_2;
       $companyaddressdata->County=$request->County;
       $companyaddressdata->Country=$request->Country;
       $companyaddressdata->zip_code=$request->zip_code;
       $companyaddressdata->time_zone=$request->time_zone;
       $companyaddressdata->fax_no=$request->fax_no;
       $companyaddressdata->type_business=$request->type_business;
       //$companyaddressdata->link_address=$request->get('link_address');
       $companyaddressdata->save();
     
       //company phonenumber
        $comapnynumber=new Company_Phone_Number;
        $comapnynumber->company_phone_number=$request->company_phone_number;
        $comapnynumber->save();
       

      
      //client number
       $multiclientnumber=[];
       $phonearray=[];
       $phonetypearray=[];
       $phonecount=count($request->client_phone);
        for($i=0; $i < $phonecount; $i++){

            $clientnumber=new Phone_no_client;
                $clientnumber->mobile_number=$request->client_phone[$i];
                $clientnumber->phone_type=$request->phone_type[$i];
                $clientnumber->save();
                $phoneid=$clientnumber->id;
                $parray=$clientnumber->mobile_number;
                $ptypearray= $clientnumber->phone_type;
                $phonearray[]=$parray;
                $phonetypearray[]=$ptypearray;
                $multiclientnumber[]=$phoneid;          
           
        }
         
       //client email
        $multiclientemail=[];
        $emailarray=[];
        $emailtypearray=[];
        $emailcount=count($request->email);
        for($i=0; $i < $emailcount; $i++){
            $clientemail=new Email_Address;
                $clientemail->email=$request->email[$i];
                $clientemail->email_type=$request->email_type[$i];
                $clientemail->save(); 
                $emailid=$clientemail->id;
                $earray=$clientemail->email;
                $etypearray=$clientemail->email_type;
                $emailarray[]=$earray;
                $emailtypearray[]=$etypearray;
                $multiclientemail[]=$emailid;  
        }
       
         //company_phone_lead done
          $companyphonelead=new Company_Phone_Lead;

                $companyphonelead->lead_id=$leaddata->id;
                $companyphonelead->company_phone_id=$comapnynumber->id;;
                $companyphonelead->save();
    
         //email_lead done

              for($i=0; $i < $emailcount; $i++){
                  $emaillead=new Email_Lead;
                  $emaillead->lead_id=$leaddata->id;
                  $emaillead->email_id=$multiclientemail[$i];
                  $emaillead->save();
                }  
               
         //client_phone_lead  notdone
        
              for($i=0; $i < $phonecount; $i++){
                  $clientphonelead=new Lead_Client_Phone;
                  $clientphonelead->client_phone_id=$multiclientnumber[$i];
                  $clientphonelead->lead_id=$leaddata->id;
                  

                  $clientphonelead->save();
                }
                
          //company_address_lead
          $companyaddresslead=new Company_Address_Lead;

                 $companyaddresslead->lead_id=$leaddata->id;
                 $companyaddresslead->company_address_id= $companyaddressdata->id;
                 $companyaddresslead->save();

          
                 return redirect()->route('client.show', ['id' => $leaddata->id]);

            // return view('leads.showlead.view',['leaddata'=>$leaddata,'companyaddressdata'=>$companyaddressdata,'comapnynumber'=>$comapnynumber,'emailarray'=>$emailarray,'emailcount'=>$emailcount,'emailtypearray'=>$emailtypearray,'phonearray'=>$phonearray,'phonetypearray'=>$phonetypearray,'phonecount'=>$phonecount]);   
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $leaddatas = lead::find($id);
        foreach ($leaddatas->lead_company_address as $company_address_data) {
                  //dd($company_address_data->street_name);
              }
              //dd($company_address_data->street_name);
        foreach($leaddatas->lead_client_detail as $client_data){

        }

        $phonearray=$leaddatas->lead_client_phone;
        $emailarray=$leaddatas->lead_client_email;
        //dd(count($phonearray));
        //dd($phonearray[0]->mobile_number);
        foreach($leaddatas->company_master_lead as $company_data){

        }

     
        
        foreach($leaddatas->company_phone_lead as $company_number){

        }
      
      
        return view('leads.showlead.view',['leaddatas'=>$leaddatas,'company_address_data'=>$company_address_data,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'company_number'=>$company_number]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leaddatas = lead::find($id);
        foreach ($leaddatas->lead_company_address as $company_address_data) {
                  //dd($company_address_data->street_name);
              }
              //dd($company_address_data->street_name);
        foreach($leaddatas->lead_client_detail as $client_data){

        }


        $phonearray=$leaddatas->lead_client_phone;
        $emailarray=$leaddatas->lead_client_email;
        //dd(count($phonearray));
        //dd($phonearray[0]->mobile_number);
        foreach($leaddatas->company_master_lead as $company_data){

        }

     
        
        foreach($leaddatas->company_phone_lead as $company_number){

        }
      
      
        return view('leads.editlead.view',['leaddatas'=>$leaddatas,'company_address_data'=>$company_address_data,'phonearray'=>$phonearray,'emailarray'=>$emailarray,'company_number'=>$company_number]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      
        $leaddatas=lead::find($request->id);
  //update leads table data
        $leaddata=lead::where('id',$request->id)->update(['salutation_name' => $request->salutation_name,'client_first_name' => $request->client_first_name,'client_last_name' => $request->client_last_name,'company_name'=>$request->company_name,'lead_description'=>$request->lead_description,'status_id'=>$request->status_id,'lead_source'=>$request->lead_source,'vendor_type'=>$request->vendor_type,'opportunity_amount'=>$request->opportunity_amount,'followup_date_time'=>$request->followup_date_time,'industry'=>$request->industry,'client_designation'=>$request->client_designation,'website_address'=>$request->website_address]);

  //update company_addresses table data
        foreach ($leaddatas->lead_company_address as $company_address_data)
        {
                 $comapanyaddressid=$company_address_data->id;
        }

        $update_company_address=Company_Address::where('id', $comapanyaddressid)->update(['house_no'=>$request->house_no,'street_name'=>$request->street_name,'address_line_2'=>$request->address_line_2,'County'=>$request->County,'Country'=>$request->Country,'zip_code'=>$request->zip_code,'time_zone'=>$request->time_zone,'fax_no'=>$request->fax_no,'type_business'=>$request->type_business]);


  //update company_phone_number table data
        foreach($leaddatas->company_phone_lead as $company_number)
        {
                  $company_phone_id=$company_number->id;
        }
   
        $update_company_phone=Company_Phone_Number::where('id',$company_phone_id)->update(['company_phone_number'=>$request->company_phone_number]);   
            
  //update email_address table
        $emailarray=$leaddatas->lead_client_email;
        $emailidarray=[];
        foreach($leaddatas->lead_client_email as $email_data)
        {
              $email_id=$email_data->id;
              $ids=$email_id;
              $emailidarray[]=$ids;

        }

        $emailcount=count($leaddatas->lead_client_email);
        
        for($i=0; $i < $emailcount; $i++)
        {   
              $id= $emailidarray[$i];
              $update_email=Email_Address::where('id',$id)->update(['email'=>$request->email[$i],'email_type'=>$request->email_type[$i]]);   
        }

        //client email
        
        $newemailarray=[];
        $emailtypearray=[];
        $newemailcount=count($request->email);
        for($i=$emailcount; $i < $newemailcount; $i++){
            $clientemail=new Email_Address;
                $clientemail->email=$request->email[$i];
                $clientemail->email_type=$request->email_type[$i];
                $clientemail->save(); 
                $emailid=$clientemail->id;
            $emaillead=new Email_Lead;
                  $emaillead->lead_id=$request->id;
                  $emaillead->email_id=$emailid;    
                  $emaillead->save();
                $earray=$clientemail->email;
                $etypearray=$clientemail->email_type;
                $newemailarray[]=$earray;
                $emailtypearray[]=$etypearray;
                
        }

         //email_lead done

              // for($i=$emailcount; $i < $newemailcount; $i++){
              //     $emaillead=new Email_Lead;
              //     $emaillead->lead_id=$request->id;
              //     $emaillead->email_id=$multiclientemail[$i];
              //     $emaillead->save();
              //   } 



  //update phone number table
         $phoneidarray=[];
         foreach($leaddatas->lead_client_phone as $phone_data)
         {
                    $phone_id=$phone_data->id;
                    $ids=$phone_id;
                    $phoneidarray[]=$ids;
         }       
         $phonecount=count($leaddatas->lead_client_phone);       
         for($i=0; $i < $phonecount; $i++)
         {
              $id= $phoneidarray[$i];
              $update_email=Phone_no_client::where('id',$id)->update(['mobile_number'=>$request->client_phone[$i],'phone_type'=>$request->phone_type[$i]]);   
         }

         //client number
       
       $newphonecount=count($request->client_phone);
        for($i=$phonecount; $i < $newphonecount; $i++){
            $clientnumber=new Phone_no_client;
                $clientnumber->mobile_number=$request->client_phone[$i];
                $clientnumber->phone_type=$request->phone_type[$i];
                $clientnumber->save();
                $phoneid=$clientnumber->id;
                $clientphonelead=new Lead_Client_Phone;
                $clientphonelead->client_phone_id=$phoneid;
                $clientphonelead->lead_id=$request->id;
                

                $clientphonelead->save();   
        }
        //client_phone_lead  notdone
        
              // for($i=0; $i < $phonecount; $i++){
              //     $clientphonelead=new lead_client_phone;
              //     $clientphonelead->client_phone_id=$multiclientnumber[$i];
              //     $clientphonelead->lead_id=$request->id;
              //     $clientphonelead->save();
              //   }

         return view("leads.viewleads.view");

    }

    public function convert($id){
       $leadid=$id;
       return view('leads.convert.content',['leadid'=>$leadid]);    

    }

    public function convertinto(Request $request)
    {
       $leadid=$request->id;
       $contact=$request->contact;
       $account=$request->account;
       $opportunity=$request->opportunity;
       $leaddata=lead::find($request->id);

       
   

     
       if($account == 'Account'){
    
   //store data in comapany_master table        
           $companydata=new Company_Master;
           $companydata->company_name= $leaddata->company_name;
           $companydata->website_address = $leaddata->website_address;
           $companydata->lead_description= $leaddata->lead_description;
           $companydata->vendor_type= $leaddata->vendor_type;
           $companydata->industry= $leaddata->industry;
           $companydata->save();

//add company_id
           $addclientid=lead::where('id',$request->id)->update(['company_id'=>$companydata->id]);

  //company_address_company_master  
         foreach ($leaddata->lead_company_address as $company_address_data) {
                  $company_address_data->id;
          }     
          $companyaddresscompanymaster=new Company_Address_Company_Master;
          $companyaddresscompanymaster->company_id=$companydata->id;
          $companyaddresscompanymaster->company_address_id=$company_address_data->id;
          $companyaddresscompanymaster->save();

 
//company_lead
          $company_lead=new Company_Master_Lead;
          $company_lead->company_id=$companydata->id;
          $company_lead->lead_id=$request->id;
          $company_lead->save();
//company_phone_company_master done
          foreach($leaddata->company_phone_lead as $company_number){

          }
          $companyphone=new Company_Phone_Company_Master;
          $companyphone->company_id=$companydata->id;
          $companyphone->company_phone_id=$company_number->id;
          $companyphone->save();
          
 //add client phone
          $phonearray=[];
          foreach($leaddata->lead_client_phone as $phone){
              $phoneid=$phone->id;
              $phonearray[]=$phoneid;
          }
          $phonecount=count($leaddata->lead_client_phone);

          for($i=0; $i < $phonecount; $i++){
                  $companyclientphno=new Company_Master_Phone_Client;
                  $companyclientphno->client_phone_id=$phonearray[$i];
                  $companyclientphno->company_id=$companydata->id;
                  $companyclientphno->save();
             }
 //add client email      
          $emailarray=[];
          foreach($leaddata->lead_client_email as $emailar){
              $emailid=$emailar->id;
              $emailarray[]=$emailid;
          }
          $emailcount=count($leaddata->lead_client_email);

          for($i=0; $i < $emailcount; $i++){
                  $companyemail=new Email_Company_Master;
                  $companyemail->email_id= $emailarray[$i];
                  $companyemail->company_id=$companydata->id;
                  $companyemail->save();
          }
        } 

      if($contact == 'Contact'){

//client data
           $clientdata=new Client_Master;
           $clientdata->salutation_name= $leaddata->salutation_name;
           $clientdata->client_first_name= $leaddata->client_first_name;
           $clientdata->client_last_name= $leaddata->client_last_name;
           $clientdata->client_designation=$leaddata->client_designation;
           $clientdata->company_id= $leaddata->company_name;
           $clientdata->lead_description= $leaddata->lead_description;
           $clientdata->save();

//add client_id
           $addclientid=lead::where('id',$request->id)->update(['contact_id'=>$clientdata->id]);

//lead_client_detail 
          $leadclient=new Lead_Client_Detail;

                $leadclient->lead_id=$request->id;
                $leadclient->client_id=$clientdata->id;
                $leadclient->save();
//client_company_address table
              foreach($leaddata->lead_company_address as $client_address_data){
                    $client_address_data->id;
              } 
              $clientadress=new Client_Company_Address;
              $clientadress->client_id=$clientdata->id;
              $clientadress->company_address_id=$client_address_data->id;
              $clientadress->save();
//email_client done
       $emailarray=[];
       foreach($leaddata->lead_client_email as $emailar){
              $emailid=$emailar->id;
              $emailarray[]=$emailid;
       }
       $emailcount=count($leaddata->lead_client_email);

       for($i=0; $i < $emailcount; $i++){
                  $emailclient=new Email_Client;
                  $emailclient->email_id= $emailarray[$i];
                  $emailclient->client_id=$clientdata->id;
                  $emailclient->save();
                }

//client_phone_client notdone

       $phonearray=[];
       foreach($leaddata->lead_client_phone as $phone){
              $phoneid=$phone->id;
              $phonearray[]=$phoneid;
       }
       $phonecount=count($leaddata->lead_client_phone);

        for($i=0; $i < $phonecount; $i++){
                  $clientphoneclient=new Client_Phone_Client;
                  $clientphoneclient->client_phone_id=$phonearray[$i];
                  $clientphoneclient->client_id= $clientdata->id;
                  $clientphoneclient->save();
             }

       }
       if($opportunity == 'Opportunity'){
        
            $opportunity=new Opportunity;
            $opportunity->lead_description= $leaddata->lead_description;
            $opportunity->company_id= $leaddata->company_name;
            $opportunity->lead_source= $leaddata->lead_source;
            $opportunity->opportunity_amount= $leaddata->opportunity_amount;
            $opportunity->save();
       }
       $leaddata=lead::where('id',$request->id)->update(['status_id'=>"Converted"]);
       return view("leads.viewleads.view");

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
}
