 <script type="text/javascript">
  //multiple select 
  $(function(){

  $('#departmentid').multiselect();

});
//pop up custom modal
$(document).on("change", "#departmentid", function(){
  var cusval=$('#departmentid :selected').text();
  var cuscheck=$('#custompopvalueid').val();
  if(cuscheck == 0 && cusval.substring(cusval.length - 6) == "Custom"){
    $('#custompopupmodalid').modal('show');
  }
  if(cusval.substring(cusval.length - 6) == "Custom"){
    if(cuscheck == 1){

    }
    else{
      $('#custompopvalueid').val('1');
    }
  }
  else{
   $('#custompopvalueid').val('0');
  }
  
});
//submit custom pop up modal
$(document).on("click", "#customsubmitid", function(){
  var custoinfo=$('#customdiscriptionid').val();
  $('#custompopupmodalid').modal('hide');
  $('#customdetailins').val(custoinfo);
});
 $(document).ready(function () {

    $('#primaryButton').dblclick(function(e){

           e.preventDefault();

    });
    var i=0;

    //multiple email and phone number company
    $("#addcompanyemail").on("click",function () {
       var a=0;
      $("input[class *= 'coemail']").each(function(){
        var email=$(this).val();
        if(email == ""){
           a=1;
          toastr.error('Company Email field is empty.');
        }
      });
      if(a != 1){ 
        i++;
      $("#emailtextboxcompany").append('<div class="input-group input-group-unstyled"><input type="email" id="comemail['+i+']"  class="form-control coemail"  placeholder="" name="companyemail[]" value="" required=""><select id="company_email_type[]" name="company_email_type[]"   value="" class="btn1 mt-2"><option value="Work">Work</option><option value="Home">Other</option></select> <a href="javascript:void(0)" class="removecompanyemailfield btn1"><i class="fa fa-times mt-2"></i></a></div>');
          document.getElementById('comemail['+i+']').focus();
        }
    });

    $('#emailtextboxcompany').on("click",".removecompanyemailfield", function(){ 

         $(this).parent('div').remove();

    });

    $("#addcompanyphone").on("click",function (e) {
      var a=0;
      $("input[class *= 'cophone']").each(function(){
        var email=$(this).val();
        if(email == ""){
           a=1;
          toastr.error('Company Phone field is empty.');
        }
      });
      if(a != 1){
      i++;
      $("#phonetextboxcompany").append('<div class="input-group input-group-unstyled"><input type="text" id="comphone['+i+']" class="form-control cophone" name="companyclient_phone[]" value="" pattern="[1-9]{1}[0-9]{9}" required=""><select id="company_phone_type[]" name="company_phone_type[]" class="btn1 mt-2" value=""><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select><a href="javascript:void(0)" class="remove_companyphonefield btn1"><i class="fa fa-times mt-2"></i></a></div>');
        document.getElementById('comphone['+i+']').focus();
        }  
    });

    $('#phonetextboxcompany').on("click",".remove_companyphonefield", function(){ 

         $(this).parent('div').remove();

    });
   
  var rowNum = 0;
  var phone=0;
  $("#addclient").on("click",function (e) {
    rowNum++;

    $("#clientdetail").append('<div class="jumbotron mt-2 pl-2"><a href="#" class="delteclient mt-1 pr-3  btncancle ">Delete Client</a><div  class="row mt-1 pr-3 pl-3 "><div class="col-md-2 pr-1"><div class="form-group"><label>Name</label><select id="salutation_name[]" name="salutation_name['+rowNum+']" class="form-control mt-0"><option value="Mr.">Mr.</option><option value="Ms.">Ms.</option><option value="Mrs.">Mrs.</option><option value="Dr.">Dr.</option></select></div></div><div class="col-md-2 px-1"><div class="form-group"><label></label><input type="text" id="" class="form-control mt-0 first"  name="client_first_name['+rowNum+']" placeholder="First Name" value="" required=""></div></div><div class="col-md-2 px-1"><div class="form-group"><label></label><input type="text" id="client_last_name[]" class="form-control mt-0 last"  name="client_last_name['+rowNum+'] " placeholder="Last Name" value="" ></div></div> <div class="col-md-2 px-1"><div class="form-group"><label>Designation</label><input type="text"  class="form-control mt-0 designation"  name="client_designation['+rowNum+']" placeholder="" value="" ></div></div><div class="col-md-4 pl-1"><div class="form-group"><label>linkedin URL</label><input type="text"  class="form-control mt-0"  name="linkedin_url['+rowNum+']" placeholder="" value="" ></div></div><div class="col-md-6 pr-1"><div id="emailtextbox" class="form-group"><label>Email</label><div class="input-group my-group"><input type="email" class="form-control mt-0 emailid emptyemail'+rowNum+'" id="email[]" name="email['+rowNum+'][]" value="" required=""><select name="email_type['+rowNum+'][]"  id="email_type[]" value="" class=""><option value="Work">Work</option><option value="Home">Home</option></select></div></div><div class="error" id="emailErr"></div><a href="javascript:void(0)" class="btn2 addemail"> Add Mail </a><input type="hidden" value="'+rowNum+'"></div><div class="col-md-6 pl-1"><div id="phonetextbox" class="form-group"><label>Phone No</label><div class="input-group my-group"><input type="text" class="form-control mt-0 phno emptyphone'+rowNum+'" id="client_phone[]" name="client_phone['+rowNum+'][]" value="" ><select id="phone_type[]" name="phone_type['+rowNum+'][]" class="" value="" pattern="[1-9]{1}[0-9]{9}" required=""><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select></div></div><div class="error" id="mobileErr"></div><a href="javascript:void(0)"  class="btn2 addphone" id="'+rowNum+'"> Add Phone </a><input type="hidden" value="'+rowNum+'" name="lastvalue"></div><hr></div>');
  });
  //delete div
  $("#clientdetail").on("click","a.delteclient",function () {
             $(this).parent('div').remove();
             $(this).remove();

   });
  //addphone script
 $("#clientdetail").on("click","a.btn2.addphone",function () {
      var did=$(this).next().val();
      var a=0;
       $("input[class *= 'emptyphone"+did+"']").each(function(){
        var phone=$(this).val();

        if(phone == ""){
           a=1;
          toastr.error('Client Phone field is empty.');
        }
      });
      if(a != 1){ 
      i++;
      var rowno=$(this).next().val();
      $(this).parent('div').find("#phonetextbox").append('<div class="input-group input-group-unstyled mt-1"><input type="text" id="cliphone['+i+']" class="form-control phno emptyphone'+rowno+'"  placeholder="" name="client_phone['+rowno+'][]" value="" pattern="[1-9]{1}[0-9]{9}" required=""><select name="phone_type['+rowno+'][]" class="btn1 mt-2" id="phone_type[]"><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select><a href="javascript:void(0)" class="remove_phonefield btn1"><i class="fa fa-times mt-2"></i></a></div>');
       document.getElementById('cliphone['+i+']').focus();  

    }
  });
  //remove phone script
   $("#clientdetail").on("click","a.remove_phonefield.btn1",function () {
             $(this).parent('div').remove();
   });
  // $('#phonetextbox').on("click",".remove_phonefield", function(){ 
  //         $(this).parent('div').remove();
  // });
  //addemail script
  $("#clientdetail").on("click","a.btn2.addemail",function () {
      // alert($(this).next().val());
      var did=$(this).next().val();
      var a=0;
        $("input[class *= 'emptyemail"+did+"']").each(function(){
        var email=$(this).val();

        if(email == ""){
           a=1;
          toastr.error('Client Email field is empty.');
        }
      });
      if(a != 1){ 
      i++;
      var rowno=$(this).next().val();
      $(this).parent('div').find('#emailtextbox').append('<div class="input-group input-group-unstyled mt-1"><input type="email"  id="cliemail['+i+']" class="form-control emailid emptyemail'+rowNum+'"  placeholder="" name="email['+rowno+'][]" value="" required=""><select  name="email_type['+rowno+'][]" class="btn1"><option value="Home">Home</option><option value="Work">Work</option></select><a href="javascript:void(0)" class="remove_emailfield btn1 "><i class="fa fa-times mt-2"></i></a></div>');
       document.getElementById('cliemail['+i+']').focus(); 
     }
       
  });
   //company dynamic add email required field validator
  $("#companyemails").on("focusout",function(){
     var companyemails=document.getElementById("companyemails").value;
     if(companyemails !=""){ 

        $('#companyclient_phones').prop('required',false);
     }
     else{

        $('#companyclient_phones').prop('required',true);
     }
  });
  //company dynamic add phone required field validator
  $("#companyclient_phones").on("focusout",function(){
     var phones=document.getElementById("companyclient_phones").value;
     if(phones !=""){ 
        $('#companyemails').prop('required',false);
     }
     else{
        $('#companyemails').prop('required',true);
     }
  });
 //client dynamic add email required field validator
  $("#emails").on("focusout",function(){
     var clientemails=document.getElementById("emails").value;
     var clientname=document.getElementById("client_first_name").value;
     if(clientemails !=""){ 
        $('#client_phones').prop('required',false);
        $('#client_first_name').prop('required',true);
     }
     else if(clientname != ""){

        $('#client_phones').prop('required',true);
     }
     else{
       $('#client_first_name').prop('required',false);
     }
  });
  //client dynamic add phone required field validator
  $("#client_phones").on("focusout",function(){
     var clientphone=document.getElementById("client_phones").value;
     var clientname=document.getElementById("client_first_name").value;
     if(clientphone !=""){ 
        $('#emails').prop('required',false);
        $('#client_first_name').prop('required',true);
        
     }
     else if(clientname != ""){
        $('#emails').prop('required',true);
     }
     else{
     $('#client_first_name').prop('required',false);
     }
  });
  // $("#addemail").click(function (e) {
  //  e.preventDefault();
 //    var email=$(".emailid").val();
 //    if(email.length== 0){}
 //    else{ 
 //       $("#emailtextbox").append('<div class="input-group input-group-unstyled"><input type="email"  class="form-control emailid" id="email[]" placeholder="" name="email[]" value="" required=""><select id="email_type[]" name="email_type[]" class="btn1"><option value="Home">Home</option><option value="Work">Work</option></select><label class="remove_emailfield btn1">X</label></div>');
 //    }
 //   });
  //remove email script
  $('#clientdetail').on("click","a.remove_emailfield.btn1", function(){ //user click on remove text
   $(this).parent('div').remove();
  });
  //assign user script
  $("#assignuser").on('click',function (e) {
    e.preventDefault();
    $('#modelHeading').html("Assign User");
    $('#AssignuserModel').modal('show');
  });
//remove space in textbox

  $("#client_first_name").on("focusout", function() {
    var first_name=$("#client_first_name").val();
    var first_name1=first_name.trim();
        var first_name2=first_name1.charAt(0).toUpperCase() + first_name1.slice(1);
        $("#client_first_name").val(first_name2);
         if(first_name == ""){
            $('#client_phones').prop('required',false);
            $('#emails').prop('required',false);
        }
        else{
            $('#client_phones').prop('required',true);
            $('#emails').prop('required',true);
        }

  });

  $("#client_last_name").on("focusout", function() {
    var last_name=$("#client_last_name").val();
        var last_name1=last_name.trim();
        var last_name2=last_name1.charAt(0).toUpperCase() + last_name1.slice(1);
        $("#client_last_name").val(last_name2);
        console.log(last_name2);
  });

  // $("#company_phone_number").on("focusout", function() {
  //   var phno=$("#company_phone_number").val();
  //   var regex = /^[1-9]\d{9}$/;
  //   if(regex.test(phno) === false) {
  //         error = "10 digit number.";
  //       document.getElementById("compnymobileErr").innerHTML = error;
  //      }
  //      else{
  //        document.getElementById("compnymobileErr").innerHTML = "";
  //      }
       
  // }); 
  jQuery('#datetimepicker').datetimepicker({minDate: 'today'});

});
  //select country name get state name  
  $(document).on("change", ".scountry", function(e){    
      var countryname =  this.value ;
      $('#State').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
       $('#time_zone').empty();
      //if country name is other
      if(countryname == "Other"){
         $('.editstate').show();  
         $('.editstate').focus();
         $('.editcounty').show();   
         $('.edittimezone').show();  
         $('#time_zone').empty();    
      }
      else{
         $('.editstate').hide(); 
         $('.editcounty').hide(); 
         $('.edittimezone').hide();    
      // console.log(countryid);
       var myselect = $('<select>');
         $.ajax({
                type: "post",
                url: "{{route('get.statename')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "countryname":countryname,     
                       },
                 
                 success: function(data){    
                  
                       var state=data;
                       $.each(state, function(index, key) {
                           myselect.append( $('<option></option>').val(key).html(key) );
                       });    
                        $('#State').append(myselect.html());      
                             
                 },
                   
                });
       }

  });
  //select city name and time zone from state selection
    $(document).on("change", ".sstate", function(e){    
      var statename =  this.value ;
      if(statename == "Other"){
         $('.editstate').show();  
         $('.editcounty').show();  
         $('.editstate').focus(); 
         $('.edittimezone').show();  
              
      }
      else{
        $('.editstate').hide(); 
         $('.editcounty').hide();  
        $('.edittimezone').hide();    
      }
        $('#County').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
        $('#time_zone').empty();
   
         var myselectcity = $('<select>');
         var myselecttime= $('<select>');
           $.ajax({
                  type: "post",
                  url: "{{route('get.cityname')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "statename":statename,     
                         },
                   
                   success: function(data){    
                              console.log(data.time); 
                              var city1=data.city;
                              var timezone=data.time;
                              $.each(city1, function(index, key) {
                             myselectcity.append( $('<option></option>').val(key).html(key) );

                         });    
                          $('#County').append(myselectcity.html()); 
                        
                        myselecttime.append( $('<option></option>').val(timezone).html(timezone) );  
                        $('#time_zone').append(myselecttime.html());   
                               
                   },
                     
                  });
       

  });


    //select city name from state selection
 $(document).on("change", ".scounty", function(e){  
            var county=this.value;
             // console.log(county);
             if(county == "Other"){
                 $('.editcounty').show();
                 $('.editcounty').focus(); 
             }
             else{
                 $('.editcounty').hide();
             }

 });

//phone no validation
 $(document).on("focusout", ".phno", function(){
    var phone1=$(this).val();
    var a=0;
    $("input[class *= 'phno']").each(function(){
        var phone=$(this).val();
    if(phone1 == phone && phone1 !=""){
          a++;
          if( a == 2){  
               swal({
                    text: " "+phone1+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() == ''){
        
     }
     else{
      $(this).attr("id","phoneid");
          $.ajax({
                type: "post",
                url: "{{route('client.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "phone":phone1,     
                       },
                 
                 success: function(data){    
                  
                    if(data == '')
                    {
                        $('.phno').removeAttr('id');
                    }          
                    else{
                      swal({
                          text: " "+phone1+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                      $('#phoneid').val('');
                    }         
                 },
                   
                });
     }


   
});
 //company phone validation
 $(document).on("focusout", ".cophone", function(){
    var phone1=$(this).val();
    var pointer=$(this);
    var a=0;
    $("input[class *= 'cophone']").each(function(){
        var phone=$(this).val();
    if(phone1 == phone){
          a++;
          if( a == 2){  
               swal({
                    text: " "+phone1+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() == ''){
        
     }
     else{
          $.ajax({
                type: "post",
                url: "{{route('company.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "phone":phone1,     
                       },
                 
                 success: function(data){    
                  
                    if(data != '')
                    {
                      swal({
                          text: " "+phone1+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                      $(pointer).val('');
                    }         
                 },
                   
                });
     }   
});
//email validation company email
$(document).on("focusout", ".coemail", function(){
     var email1=$(this).val();
     var pointer=$(this);
     var a=0;
     $("input[class *= 'coemail']").each(function(){
       var email=$(this).val();
         if(email1 == email){
          a++;
          if( a == 2){  
               swal({
                    text: " "+email1+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() == ''){
        
     }
     else{
   
          $.ajax({
                type: "post",
                url: "{{route('company.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "email":email1,     
                       },
                 
                 success: function(data){    
                  
                    if(data != '')
                    {
                      swal({
                          text: " "+email1+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                      $(pointer).val('');
                    }         
                 },
                   
                });
     }  
});
//email validation client email
$(document).on("focusout", ".emailid", function(){
     var email1=$(this).val();
     var pointer=$(this);
     var a=0;
     $("input[class *= 'emailid']").each(function(){
       var email=$(this).val();
         if(email1 == email && email1 !=""){
          a++;
          if( a == 2){  
               swal({
                    text: " "+email1+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() == ''){
        
     }
     else{
    
          $.ajax({
                type: "post",
                url: "{{route('client.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "email":email1,     
                       },
                 
                 success: function(data){    
                  
                    if(data == '')
                    {
                        $('.emailid').removeAttr('id');
                    }          
                    else{
                      swal({
                          text: " "+email1+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                     $(pointer).val('');
                    }         
                 },
                   
                });
     }  
});



 //takecompany name
 $( document ).ready(function(){
          $('.compinput').on("keyup", function() {
            var comp = $("#company_name").val() ;
            //  $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //         }
            //     })
            //    // e.preventDefault();

            // var token = $('meta[name="csrf-token"]').attr('content');
            $(this).autocomplete({
                
                //source: "{{ URL::to('gmails/fetchcomp') }}",
               source: function(request, response) {
              $.post("{{ URL::to('/getcompanyname') }}", {_token: "{{ csrf_token() }}", term: request.term, companyname: comp},
                 response, "json");
            },

                minLength: 1 ,
              
            
            select: function(event, ui) {
                    //var $itemrow = $(this).closest('tr');
                           
                  
                  $('#company_name').val(ui.item.company_name);
                            
                  //$('#client_company').focus();

                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.company_name  +  "</a>" )
            .appendTo( ul );
        };
 
        $('.compinput').on("focusout", function() {
           var value =  $.trim($(this).val());
           $(this).val(value);
           $(".compinput").css("text-transform", "capitalize");
        });     
    });
});

//prevent form to store duplicate data (double click prevation)
function checkForm(form) // Submit button clicked
  {
    //
    // check form input values
    //

    form.myButton.disabled = true;
    form.myButton.value = "Please wait...";
    return true;
  }
  
</script>










