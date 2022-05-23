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
     var i=0;
  //addphone script
  $("#addcompanyphone").on("click",function (e) {
    e.preventDefault();
       var a=0;
      $("input[class *= 'cophone']").each(function(){
        var phone=$(this).val();
        if(phone == ""){
           a=1;
          toastr.error('Phone field is empty.');
        }
      });
      if(a != 1){ 
           i++;
      $("#phonetextbox").append('<div class="input-group input-group-unstyled"><input type="text"  class="form-control cophone"  placeholder="" name="companyclient_phone[]" id="phone['+i+']" value="" pattern="[1-9]{1}[0-9]{9}" required=""><select id="company_phone_type[]" name="company_phone_type[]" class="btn1" value=""><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select><a href="#" class="remove_phonefield1 btn1">X</a></div>');
       document.getElementById('phone['+i+']').focus();
    }
  });
  //remove phone design
 $('#phonetextbox').on("click",".remove_phonefield1", function(){ 
           $(this).parent('div').remove();   
     });

  //addemail script
  $("#addcompanymail").click(function (e) {
    e.preventDefault();
     var a=0;
      $("input[class *= 'coemail']").each(function(){
        var emailid=$(this).val();
        if(emailid == ""){
           a=1;
          toastr.error('Email field is empty.');
        }
      });
      if(a != 1){ 
           i++;
      $("#emailtextbox").append('<div class="input-group input-group-unstyled"><input type="email"  id="email['+i+']" class="form-control coemail" placeholder="" name="companyemail[]" value="" required=""><select id="company_email_type[]" name="company_email_type[]"   value="" class="btn1"><option value="Work">Work</option><option value="Other">Other</option></select><a href="#" class="remove_emailfield1 btn1">X</a></div>');
          document.getElementById('email['+i+']').focus();
      }
  });
   
//remove email from design
    $('#emailtextbox').on("click",".remove_emailfield1", function(){ 
          $(this).parent('div').remove();   
    });
  //assign user script
  // $("#assignuser").on('click',function (e) {
  //  e.preventDefault();
  //  $('#modelHeading').html("Assign User");
  //  $('#AssignuserModel').modal('show');
  // });
//remove space in textbox

  $("#client_first_name").on("focusout", function() {
    var first_name=$("#client_first_name").val();
    var first_name1=first_name.trim();
        var first_name2=first_name1.charAt(0).toUpperCase() + first_name1.slice(1);
        $("#client_first_name").val(first_name2);
  });

  $("#client_last_name").on("focusout", function() {
    var last_name=$("#client_last_name").val();
        var last_name1=last_name.trim();
        var last_name2=last_name1.charAt(0).toUpperCase() + last_name1.slice(1);
        $("#client_last_name").val(last_name2);
        console.log(last_name2);
  });

  $("#company_phone_number").on("focusout", function() {
    var phno=$("#company_phone_number").val();
    var regex = /^[1-9]\d{9}$/;
    if(regex.test(phno) === false) {
          error = "10 digit number.";
        document.getElementById("compnymobileErr").innerHTML = error;
       }
       else{
         document.getElementById("compnymobileErr").innerHTML = "";
       }
       
  }); 


});

//select country name get state name
  $(document).on("change", ".scountry", function(e){    
      var countryname =  this.value ;
      $('#State').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
      $('.editstate').hide(); 
      $('.editcounty').hide();
      $('.edittimezone').hide();

      if(countryname == "Other"){
         $('.editstate').show();  
         $('.editstate').focus();
         $('.editcounty').show();   
         $('.edittimezone').show();      
      }
      else{
     
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

//select city name from state selection
    $(document).on("change", ".sstate", function(e){    
      var statename =  this.value ;
      if(statename == "Other"){
         $('.editcounty').show();  
         $('.editcounty').focus(); 
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
//  $(document).on("change", ".phno", function(){
//     $("input[class *= 'phno']").each(function(){
//      var ph=$(this).val();
  
//         var regex = /[1-9]{1}[0-9]{9}/;
//         if(regex.test(ph) === false) {
//          error = "Please enter a valid 10 digit mobile number.";
//         document.getElementById("mobileErr").innerHTML = error;
//        }
//        else{
//           document.getElementById("mobileErr").innerHTML = "";
//        }
//     });
   
// });
//email validation 
// $(document).on("change", ".emailid", function(){
//     $("input[class *= 'emailid']").each(function(){
//      var email=$(this).val();
  
//         var regex = /^\S+@\S+\.\S+$/;
//         if(regex.test(email) === false) {
//          error = "Please enter a valid email address.";
//         document.getElementById("emailErr").innerHTML = error;
//        }
//        else{
//           document.getElementById("emailErr").innerHTML = "";
//        }
//     });
   
// });  
//company phone validation
//  $(document).on("focusout", ".cophone", function(){
//     var phone1=$(this).val();
//     var pointer=$(this);
//     var a=0;
//     $("input[class *= 'cophone']").each(function(){
//         var phone=$(this).val();
//     if(phone1 == phone){
//           a++;
//           if( a == 2){  
//                swal({
//                     text: " "+phone1+" already entered!",
//                     icon: "warning",
//                     //buttons: true,
//                     //dangerMode: true,
//                 })
//                 $(this).val('');
//              }
//          }
//      });
//      if($(this).val() == ''){
        
//      }
//      else{
//           $.ajax({
//                 type: "post",
//                 url: "{{route('company.isexist')}}",
//                 data: {
//                              "_token": "{{ csrf_token() }}",
//                              "phone":phone1,     
//                        },
                 
//                  success: function(data){    
                  
//                     if(data != '')
//                     {
//                       swal({
//                           text: " "+phone1+" already exist!",
//                           icon: "warning",
//                           //buttons: true,
//                           //dangerMode: true,
//                       })
//                       $(pointer).val('');
//                     }         
//                  },
                   
//                 });
//      }   
// });
//company phone update validation
 $(document).on("focusout", ".cophone", function(){
  // alert('hi');
    var phone=$(this).val();
    var pointer=$(this);
    var preid=$(this).prev().val();
    var nextid=$(this).next().val();
    var a=0;
    $("input[class *= 'cophone']").each(function(){
        var phone1=$(this).val();
    if(phone == phone1 && phone1 != ""){
          a++;
          if( a == 2){  
               swal({
                    text: " "+phone+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() != ''){
          $.ajax({
                type: "post",
                url: "{{route('company.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "phone":phone, 
                             "id":nextid,    
                       },
                 
                 success: function(data){    
                
                    if(data != '')
                    {
                      swal({
                          text: " "+phone+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      }) 
                      $(pointer).val(preid);
                    }         
                 },
                   
                });
     }  
});
//email validation company email
// $(document).on("focusout", ".coemail", function(){
//      var email1=$(this).val();
//      var pointer=$(this);
//      var a=0;
//      $("input[class *= 'coemail']").each(function(){
//        var email=$(this).val();
//          if(email1 == email){
//           a++;
//           if( a == 2){  
//                swal({
//                     text: " "+email1+" already entered!",
//                     icon: "warning",
//                     //buttons: true,
//                     //dangerMode: true,
//                 })
//                 $(this).val('');
//              }
//          }
//      });
//      if($(this).val() == ''){
        
//      }
//      else{
   
//           $.ajax({
//                 type: "post",
//                 url: "{{route('client.isexist')}}",
//                 data: {
//                              "_token": "{{ csrf_token() }}",
//                              "email":email1,     
//                        },
                 
//                  success: function(data){    
                  
//                     if(data != '')
//                     {
//                       swal({
//                           text: " "+email1+" already exist!",
//                           icon: "warning",
//                           //buttons: true,
//                           //dangerMode: true,
//                       })
//                       $(pointer).val('');
//                     }         
//                  },
                   
//                 });
//      }  
// });
//company email update validation
 $(document).on("focusout", ".coemail", function(){

    var email=$(this).val();
    var pointer=$(this);
    var preid=$(this).prev().val();
    var nextid=$(this).next().val();                           
    var a=0;
    $("input[class *= 'coemail']").each(function(){
        var email1=$(this).val();
    if(email == email1 && email1 != ""){
          a++;
          if( a == 2){  
               swal({
                    text: " "+email+" already entered!",
                    icon: "warning",
                    //buttons: true,
                    //dangerMode: true,
                })
                $(this).val('');
             }
         }
     });
     if($(this).val() != ''){
          $.ajax({
                type: "post",
                url: "{{route('company.isexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "email":email, 
                             "id":nextid,    
                       },
                 
                 success: function(data){    
                  
                    if(data != '')
                    {
                      swal({
                          text: " "+email+" already exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                      $(pointer).val(preid);
                    }         
                 },
                   
                });
     }  
});
//delete phone number from master and pivote
function Deletecompanyphoneno(URL,pp,num){
  
  swal({
      text: "Do you want to delete "+ num +" number?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {  
    //remove phone from design
    $(pp).parent('div').remove();
    $.ajax({
      url:URL,
      type:'GET',
      success:function(data){

        toastr.error('Company Phone Number is deleted.');   
      }
    });
  }
  else{
     toastr.warning('You canceled delete operation');  
  }
});

 }

//delete email from master and pivote
function Deletcompanyeemail(URL,ee,mail){
  
    

  swal({
       text: "Do you want to delete "+ mail +" email?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
    //remove email from design
     $(ee).parent('div').remove();
    $.ajax({

      url:URL,
      type:'GET',
      success:function(data){
        console.log(data);
       toastr.error('Company Email Address is deleted.');   
      }
    });
  }
  else{
     toastr.warning('You canceled delete operation');  
  }
});
   
 }

//clients related to company datatable
$(function () {
     var table = $('#clientrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
        //lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          //Import data in datatable
        ajax: "{{ route('company.relatedclients',['id'=>$companydata->id]) }}",
          columns: [   
            {data: 'id', name: 'id',class:"clientid"},
            {data: 'client_first_name', name:'client_first_name'},
            {data: 'client_designation', name: 'client_designation'}, 
            {data: 'client_email_add', name:'client_email_addresses.client_email',"render":function(data,type,full,meta){
                    
                    var obj=data.replace(",", "</br>");               
                   return obj;

              
              }
            },  
            {data:'client_phone_no',name:'client_phone_numbers.client_phone',"render":function(data,type,full,meta){
                    
                    var obj=data.replace(",", "</br>");               
                   return obj;

              
              }
            }, 
                    
           ], 
            
      });
  });

//Assign user and pop AssignuserModel

$(function () {
   var table1=$('#userrecord').DataTable({
       processing: true,
       serverSide: true,
       async: true,
       destroy: true,
       responsive: true,
       paging:  true,
       ajax:"{{route('showuser.list')}}",
          columns:[
          {data:'id',name:'id',class:'foocompanyuser'},
          {data:'name',name:'name',class:"selectcompanyuser"},
          {data:'email',name:'email'},

          ],
          
        });
 });
 $(document).on("click", ".selectcompanyuser", function(){

     $("#AssignuserModel").modal("hide");
     var table = $('#userrecord').DataTable();
     var $rowid = table.row( this ).index();
     var currentPageIndex = table.page.info().page;
     var targetvalue  = $(this).text();   
     var key  = $(this).closest('tr').find('td.foocompanyuser').text();
     document.getElementById("user_name").value = targetvalue;
     document.getElementById("user_id").value = key;

 });

  $(document).on("click", "#closeuser", function(){
         $("#AssignuserModel").modal("hide");
  });
  $(document).on("click", "#cancelassignuser", function(){
         document.getElementById("user_name").value = "";
  });


jQuery('#datetimepicker').datetimepicker({minDate: 'today'});
 </script>  