<script type="text/javascript">
	
  $(document).ready(function () {
     var i=0;
 	//addphone script
 	$("#addphone").on("click",function (e) {
 		e.preventDefault();
     
 		var a=0;
      $("input[class *= 'phno']").each(function(){
        var phone=$(this).val();
        if(phone == ""){
           a=1;
          toastr.error('Phone field is empty.');
        }
      });
      if(a != 1){	
        i++;
 			$("#phonetextbox").append('<div class="input-group input-group-unstyled"><input type="text"  class="form-control phno"id="client_phone['+i+']" placeholder="" name="client_phone[]" value="" pattern="[1-9]{1}[0-9]{9}" required=""><select name="phone_type[]" class="btn1" id="phone_type[]"><option value="Mobile">Mobile</option><option value="Landline">Landline</option></select><a href="#" class="remove_phonefield btn1 mt-1">X</a></div>');
         document.getElementById('client_phone['+i+']').focus();
        }	
 	});
 	//remove phone script
	$('#phonetextbox').on("click",".remove_phonefield", function(){ 
		 $(this).parent('div').remove();
	});
	//addemail script
	$("#addemail").on("click",function (e) {
		e.preventDefault();
   
		var a=0;
      $("input[class *= 'emailid']").each(function(){
        var emailid=$(this).val();
        if(emailid == ""){
           a=1;
          toastr.error('Email field is empty.');
        }
      });
      if(a != 1){
         i++;
 			$("#emailtextbox").append('<div class="input-group input-group-unstyled"><input type="email"  class="form-control emailid" id="email['+i+']" placeholder="" name="email[]" value="" ><select name="email_type[]" id="email_type[]" class="btn1"><option value="Home">Home</option><option value="Work">Work</option></select><a href="#" class="remove_emailfield btn1 mt-1">X</a></div>');
       document.getElementById('email['+i+']').focus();
		}
 	});
 	//remove email script
 	$('#emailtextbox').on("click",".remove_emailfield", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove();
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
//dynamic add email required field validator
  $("#emails").on("focusout",function(){
     var emails=document.getElementById("emails").value;
     if(emails !=""){ 
        $('#client_phones').prop('required',false);
     }
     else{
        $('#client_phones').prop('required',true);
     }
  });
//dynamic add phone required field validator
  $("#client_phones").on("focusout",function(){
     var phones=document.getElementById("client_phones").value;
     if(phones !=""){ 
        $('#emails').prop('required',false);
     }
     else{
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

//phone no validation
 $(document).on("change", ".phno", function(){
    var phone1=$(this).val();
    var pointer=$(this);
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
      
          $.ajax({
                type: "post",
                url: "{{route('client.isexist')}}",
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
                         $('#company_name').val('');
                    }         
                 },
                   
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