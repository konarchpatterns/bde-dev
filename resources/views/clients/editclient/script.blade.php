 <script type="text/javascript">
	
  $(document).ready(function () {
    var i=0;
 	//addphone script
 	$("#addphone").on("click",function (e) {
 		e.preventDefault();
     i++;
     var a=0;
      $("input[class *= 'phno']").each(function(){
        var phone=$(this).val();
        if(phone == ""){
           a=1;
          toastr.error('Phone field is empty.');
        }
      });
      if(a != 1){
 			$("#phonetextbox").append('<div class="input-group input-group-unstyled"><input type="text"  class="form-control phno"id="client_phone['+i+']" placeholder="" name="client_phone[]" value="" pattern="[1-9]{1}[0-9]{9}" required=""><select name="phone_type[]" class="btn1"id="phone_type[]"><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select><a href="#" class="remove_phonefield1 btn1">X</a></div>');
        document.getElementById('client_phone['+i+']').focus();
      }
 	});
 	//remove phone from design
      $('#phonetextbox').on("click",".remove_phonefield1", function(){ 
          
         $(this).parent('div').remove();
      });
	//addemail script
	$("#addemail").on("click",function (e) {
		e.preventDefault();
	   i++;
      var a=0;
      $("input[class *= 'emailid']").each(function(){
        var email=$(this).val();
        if(email == ""){
           a=1;
          toastr.error('Email field is empty.');
        }
      });
      if(a != 1){
 			$("#emailtextbox").append('<div class="input-group input-group-unstyled"><input type="email"  class="form-control emailid" id="email['+i+']" placeholder="" name="email[]" value="" required=""><select name="email_type[]" id="email_type[]" class="btn1"><option value="Home">Home</option><option value="Work">Work</option></select><a href="#" class="remove_emailfield1 btn1">X</a></div>');
       document.getElementById('email['+i+']').focus();
     }
		
 	});
//remove from design 
      $('#emailtextbox').on("click",".remove_emailfield1", function(e){ //user click on remove text
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
 	});

 	$("#client_last_name").on("focusout", function() {
 		var last_name=$("#client_last_name").val();
        var last_name1=last_name.trim();
        var last_name2=last_name1.charAt(0).toUpperCase() + last_name1.slice(1);
        $("#client_last_name").val(last_name2);
        console.log(last_name2);
 	});

 	$("#client_last_name").on("focusout", function() {
 		var last_name=$("#client_last_name").val();
        var last_name1=last_name.trim();
        var last_name2=last_name1.charAt(0).toUpperCase() + last_name1.slice(1);
        $("#client_last_name").val(last_name2);
        console.log(last_name2);
 	});

 	
 	// $("#company_phone_number").on("focusout", function() {
 	// 	var phno=$("#company_phone_number").val();
 	// 	var regex = /^[1-9]\d{9}$/;
 	// 	if(regex.test(phno) === false) {
  //       	error = "10 digit number.";
  //       document.getElementById("compnymobileErr").innerHTML = error;
  //      }
  //      else{
  //      	 document.getElementById("compnymobileErr").innerHTML = "";
  //      }
       
 	// }); 


 });

//phone no validation
//  $(document).on("focusout", ".phno", function(){
//     var phone1=$(this).val();
//     var pointer=$(this);
//     var a=0;      
//     $("input[class *= 'phno']").each(function(){
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
//      if($(this).val() != ''){
     
//           $.ajax({
//                 type: "post",
//                 url: "{{route('client.isexist')}}",
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
//update phone no validation
 $(document).on("focusout", ".phno", function(){
    var phone=$(this).val();
    var pointer=$(this);
    var prev=$(this).prev().val();
    var nextid=$(this).next().val();

    var a=0;
    $("input[class *= 'phno']").each(function(){
        var phone1=$(this).val();
    if(phone == phone1 && phone1 != 0){
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
                url: "{{route('client.isexist')}}",
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
                      $(pointer).val(prev);
                    }         
                 },
                   
                });
     }  
});
//email validation client email
// $(document).on("focusout", ".emailid", function(){
//      var email1=$(this).val();
//      var pointer=$(this);
//      var a=0;
//      $("input[class *= 'emailid']").each(function(){
//        var email=$(this).val();
       
//        //alert(nextid);
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
                  
//                     if(data == '')
//                     {
//                         $('.emailid').removeAttr('id');
//                     }          
//                     else{
//                       swal({
//                           text: " "+email1+" already exist!",
//                           icon: "warning",
//                           //buttons: true,
//                           //dangerMode: true,
//                       })
//                        $(pointer).val('');
//                     }         
//                  },
                   
//                 });
//      }  
// });
//update email validation client email
$(document).on("focusout", ".emailid", function(){
     var email=$(this).val();
     var pointer=$(this);
     var prev=$(this).prev().val();
     var nextid=$(this).next().val();

     var a=0;
     $("input[class *= 'emailid']").each(function(){
       var email1=$(this).val();
         if(email == email1 && email1 != 0){
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
     if($(this).val() == ''){
        
     }
     else{
     
          $.ajax({
                type: "post",
                url: "{{route('client.isexist')}}",
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
                      $(pointer).val(prev);
                    }         
                 },
                   
                });
     }  
});


//delete phone number from master and pivote
function Deleteclientemail(URL,ee,mail){


   swal({
       text: "Do you want to delete "+ mail +" email?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
     $(ee).parent('div').remove();
      
      $.ajax({

        url:URL,
        type:'GET',
        success:function(data){

            toastr.error('Client Email Address is deleted.');   
        }
      });
    }
    else{
     toastr.warning('You canceled delete operation');  
    }
  });
 }

 
//delete email from master and pivote
function Deleteclientphoneno(URL,pp,num){
 swal({
      text: "Do you want to delete "+ num +" number?",
      // text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {  
    $(pp).parent('div').remove();
      
      $.ajax({

        url:URL,
        type:'GET',
        success:function(data){
          toastr.error('Client Phone Number is deleted.');   
        }
      });
  }
  else{
     toastr.warning('You canceled delete operation');  
  }
});
 }
//takecompany name
 $( document ).ready(function(){
          $('.compinput').on("keyup", function() {
            var comp = $("#company_name").val() ;
            $(this).autocomplete({
            
               source: function(request, response) {
              $.post("{{ URL::to('/getcompanyname') }}", {_token: "{{ csrf_token() }}", term: request.term, companyname: comp},
                 response, "json");
            },

                minLength: 1 ,
              
            
            select: function(event, ui) {
                  $('#company_name').val(ui.item.company_name);
                    return false;
              }
            
              }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .data( "ui-autocomplete-item", item )
            .append( "<a>" +  item.company_name  +  "</a>" )
            .appendTo( ul );
        };
    });
    $('.compinput').on("focusout", function() {
        var comp = $("#company_name").val();
        var oldcomp = $("#company_id").val();
           $.ajax({
                type: "post",
                url: "{{route('company.nameexist')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "comp":comp,     
                       },
                 
                 success: function(data){    
                    if(data.countexist == 0)
                    {
                      swal({
                          text: " "+comp+" company not exist!",
                          icon: "warning",
                          //buttons: true,
                          //dangerMode: true,
                      })
                     document.getElementById('company_name').value=oldcomp;
                    
                    }         
                 },
                   
                });
    });

});
 

 </script>	