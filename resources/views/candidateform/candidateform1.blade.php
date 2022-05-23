<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>HR Candidate FORM</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
<style>
.bs-example{
        margin: 20px;

    }
.swal2-popup {
  font-size: 0.9rem !important;
}
/*.form-control{
   
    height:30px;
      font-size: 1rem;
}
.custom-select{
    height:30px;
    padding:.20rem;
}*/
label {
    /*display: inline-block;
    margin-bottom: .0rem;
    font-size: 15px;*/
    /*font-style: italic;*/
    font-weight: bold;
}
.notvisible{
     visibility: hidden;
}
.dynamicrequired{
     visibility: hidden;
}
#FirstName,#LastName,#MiddleName{
  text-transform: capitalize;
}
body {

    /*background:
        linear-gradient(#1C120B, transparent),
        linear-gradient(to top left,#1C120B , transparent),
        linear-gradient(to top right, #1C120B, transparent);
     
    background-blend-mode: screen;*/
    /* background:
        linear-gradient(#312E2C, transparent),
        linear-gradient(to top left,#393938 , transparent),
        linear-gradient(to top right, white, transparent);
     
    background-blend-mode: screen;*/
    background:
        linear-gradient(#312E2C, transparent),
        linear-gradient(to top left, #393938, transparent),
        linear-gradient(to top right, black, transparent);
    background-blend-mode: screen;
    color: white;
}
.card1 {
   background:
        linear-gradient(black, transparent),
        linear-gradient(to top left, #393938, transparent),
        linear-gradient(to top right, black, transparent);
    background-blend-mode: screen;
   
   /* background:
        linear-gradient(#312E2C, transparent),
        linear-gradient(to top left,#393938 , transparent),
        linear-gradient(to top right, white, transparent);
     
    background-blend-mode: screen;*/
    
}

.ts{
 text-shadow: 1px 2px 10px black;
}
.s{


    
 box-shadow: 1px 1px 5px 10px #AF7F58;
}
</style>

<script>
//Self-executing function
// (function() {
//     'use strict';
//     window.addEventListener('load', function() {
// //         // Fetch all the forms we want to apply custom Bootstrap validation styles to
//         var forms = document.getElementsByClassName('needs-validation');
//         // Loop over them and prevent submission
//         var validation = Array.prototype.filter.call(forms, function(form) {
//             form.addEventListener('submit', function(event) {
//                 if (form.checkValidity() === false) {
//                     event.preventDefault();
//                     event.stopPropagation();
//                 }
//                 form.classList.add('was-validated');
//             }, false);
//         });
//     }, false);
// })();
$( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      yearRange: "-100:+0",
      changeYear: true, 
      dateFormat: 'dd-mm-yy' //set the format of the date
    });
  } );
</script>
</head>
<body>
  @if(isset($enteres))
   <script type="text/javascript">

        swal({
                text: "Your registration done successfully.",                    
            });
                          </script>
  @endif
    @if ($errors->any())
     <script type="text/javascript">
      var users =  {!! json_encode($errors->all()) !!};
        var result = [];
        for(var i in users){  
            result.push([users [i]]); 
          }
            result=result.join("\n");
                            swal({
                                text: " "+result+"",
                                icon: "error",
                                //buttons: true,
                                //dangerMode: true,
                            });
      </script>
      @endif
<div class="bs-example"> 
	<div class="row">
		<div class="col-md-4">

	 <img src="{{asset('patternscrmdesign/assets/img/smalllogo.png')}}" class="pl-1">
	   </div>
	   <div class="col-md-4 mt-3">
	    <h3 class="text-center ts text-light"><b>Candidate Form</b></h3>
	    </div>
        <div class="col-md-4 ">
                <a href="{{route('mail.candi')}}">simple</a>
                <a href="{{route('form.doubleboxform')}}">double</a>
        </div>
     </div>
    <form  action="{{route('mail.candidatestore')}}" method="post" >
        @csrf
    <div class="row mt-3">
    <div class="col-md-2">
    </div>
      <div class="col-md-8 mb-3" >
         <div class="card card1 s rounded-0">
                <div class="card-body ">
        <div class="row form-group"> 
            <div class="col-md-4" >
            	<label for="dateofinterview">Date:</label>
                <input type="text" class="form-control mt-1" id="dateofinterview"  readonly="" name="date_of_interview" >
            </div>
            <div class="col-md-8" >
            	<label for="firstName">Post Applied For:</label>
                <input type="text" class="form-control mt-1" id="dateofinterview" placeholder="" name="post_applied" value="{{old('post_applied')}}">
            </div>
        </div>

    	<div class="row form-group"> 
            <div class="col-md-4 mb-1" >
            	<label for="firstName"><span style='color: red'>*</span>First Name:</label>
                <input type="text" class="form-control " id="FirstName" placeholder="First Name" name="first_name" value="{{old('first_name')}}"required>
            </div>
            <div class="col-md-4 mb-1">
               <label for="LastName"><span style='color: red'>*</span>Mid Name:</label>
                <input type="text" class="form-control " id="MiddleName" placeholder="Middle Name" name="middle_name" value="{{old('middle_name')}}" required>
            </div>
            <div class="col-md-4">
            	  <label for="LastName"><span style='color: red'>*</span>Last Name:</label>
                <input type="text" class="form-control " id="LastName" placeholder="Last Name" name="last_name" value="{{old('last_name')}}" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
            	 <label for="family_occupation">Father's/Husband's Occupation:</label>
                <input type="test" class="form-control" id="family_occupation" placeholder="Designation" name="family_occupation" value="{{old('family_occupation')}}">
            </div>
             <div class="col-md-4">
            	 <label ><span style='color: red'>*</span>D.O.B:</label>
                <input type="text" class="form-control" id="datepicker" placeholder="dd/mm/yyyy" name="dob" required  autocomplete="off">
            </div>
           
            <div class="col-md-2">
             	<label for="age">Age:</label>
                <input type="text" class="form-control" id="age" placeholder="Age" name="age" required readonly="" >
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
             <label  for="inputEmail">Email Address:</label>
                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{old('email')}}">
            </div>
             <div class="col-md-6">
                 <div class="row">
                <div class="col-md-6">
                  <label for="phoneNumber"><span style='color: red'>*</span>Mobile(M):</label>
                <input type="number" class="form-control" id="mobile_no" placeholder="10 digit" name="mobile_no" value="{{old('mobile_no')}}" min=10 required >
            </div>
             <div class="col-md-6">
                  <label for="otherphoneNumber">Mobile(R):</label>
                <input type="number" class="form-control" id="residence_no" placeholder="Mobile(R)" name="residence_no" value="{{old('residence_no')}}" min=10 >
            </div>
            </div>
          </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
              <label  for="present_address">Present Address:</label>
                <textarea rows="2" class="form-control" id="present_address" placeholder="Postal Address" name="present_address"  required>{{old('present_address')}}</textarea>
            </div>
        </div>
    <!--   </div>
      </div>
      </div>   -->
   
   <!--   <div class="col-md-5 "  >
        <div class="card card1 s rounded-0">
                <div class="card-body "> -->
        <div class="row form-group">
            <div class="col-md-8 ">
             <label  for="school_name">Name of School:</label>
                <input type="text" class="form-control" id="school_name" placeholder="Name Of School" name="school_name" value="{{old('school_name')}}">
            </div>
             <div class="col-md-4">
             	<label for="school_medium">Medium:</label>
                <input type="text" class="form-control" id="school_medium" placeholder="Medium"  name="school_medium" value="{{old('school_medium')}}">
            </div>
        </div>
        <div class="row form-group">
        <div class="col-md-8">
             <label  for="inputCollege">Name of College:</label>
                <input type="text" class="form-control" id="college_name" placeholder="Name Of College" name="college_name" value="{{old('college_name')}}">
            </div>
             <div class="col-md-4">
             	<label for="college_medium">Medium:</label>
                <input type="text" class="form-control" id="college_medium" placeholder="Medium" name="college_medium" value="{{old('college_medium')}}">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
            	 <label for="inputLastEducation">Last Education:</label>
                <input type="test" class="form-control" id="last_education" placeholder="Last Education" name="last_education" value="{{old('last_education')}}">
            </div>
        </div>

        <div class="row form-group"> 
            <div class="col-md-6">
            	<label for="Previous">Previous/Current Employer :</label>
                <input type="text" class="form-control" id="Previous" placeholder="Previous/Current Employer" value="{{old('previos_current_job')}}" name="previos_current_job">
            </div>
             <div class="col-md-6">
            	<label for="Previous">Work Exp:</label>
                <div class="row input-group my-group pl-3">
                <select  class="custom-select rounded-right" id="year" placeholder="Year" name="year" value="{{old('year')}}">
                      <option value="0">Year</option>
                    @for($i=0;$i<=25;$i++)
                        <option>{{$i}}</option>
                    @endfor
                </select>
                 <!--  <p class="bg-white rounded-right text-dark pr-1" style="height: 30px">Year</p>-->
                  <p class="px-1"></p> 
             <!--  </div>
               <div class="col-md-6 "> -->
                     <select  class="custom-select rounded-left" id="month" placeholder="Month" name="month" value="{{old('month')}}">
                        <option value="0">Month</option>
                    @for($i=0;$i<=12;$i++)
                        <option>{{$i}}</option>
                    @endfor
                </select>
               <!--   <p class="bg-white rounded-right text-dark" style="height: 30px">Month</p> -->
               </div>
                </div>
            </div>

         <div class="row form-group">
            <div class="col-md-6">
            	<label  for="ReasontoLeave"><span id="Dynamicreq" class="dynamicrequired" style='color: red'>*</span>Reason to Leave:</label>
                <textarea rows="3" class="form-control" id="ReasontoLeave" placeholder="Reason to Leave" name="reason_to_leave" maxlength="300" >{{old('reason_to_leave')}}</textarea>
            </div>
             <div class="col-md-6 ">
            	<label  for="ReasontoLeave">Any Other Commitments:</label>
               <!--  <div class="row input-group my-group" id="commentsid">
                <a  class="btn btn btn-success ml-3 yescommitements" >Yes</a>
                 <a  class="btn btn btn-danger ml-3 nocommitements" >No</a>
                </div> -->
                <textarea rows="3" class="form-control " name="any_commitment" id="any_commitment" placeholder="Any other commitments you have apart from applied job " value="{{old('any_commitment')}}"></textarea>
            </div>
        </div>
       </div>
            </div>
    </div>
      </div>
   <div class="form-group row">

            <div class="col-md-5 offset-sm-4">
                <label class="checkbox-inline">
                    <input type="checkbox" class="mr-1" value="agree" required=""><span style="color:red"><b>I agree to the</b></span> <a href="#">Terms and Conditions</a>
                </label>
            </div>
       <!--  </div>
        <div class="form-group row"> -->
            <div class="col-md-5 offset-sm-5">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary" value="Reset">
            </div>
        </div>

    </form>

</div>

<script type="text/javascript">
var n =  new Date();
var y = n.getFullYear();
var m = n.getMonth() + 1;
var d = n.getDate();
document.getElementById("dateofinterview").value = d + "/" + m + "/" + y;

$("#datepicker").change(function(){
     var dob=document.getElementById("datepicker").value;
     var res = dob.split("-");
     var countage=y-res[2]; 
     if(countage<15){
        document.getElementById("datepicker").value="";
         document.getElementById("age").value="";
          Swal.fire('Your age must be above 15');
     }
     else{
     document.getElementById("age").value=countage;
}
  if(dob.match(/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/))
  {
   
  }
  else{
         document.getElementById("datepicker").value="";
         document.getElementById("age").value="";
         Swal.fire('Please enter valid date');
  }
});
$(".yescommitements").on("click",function(){
        $("#any_commitment").removeClass("notvisible");
         $('#any_commitment').prop('required',true);
        
        $('.yescommitements').remove();
        $('.nocommitements').remove();
});
$("#Previous").on("focusout",function(){
     var previous=document.getElementById("Previous").value;
     if(previous !=""){
       $('#Dynamicreq').removeClass("dynamicrequired")     
            $('#ReasontoLeave').prop('required',true);
     }
     else{
        $('#Dynamicreq').addClass("dynamicrequired")
        $('#ReasontoLeave').prop('required',false);
     }
});
$("#mobile_no").on("focusout",function(){
     var mobile_no=document.getElementById("mobile_no").value;
     if(mobile_no.length !=10 && mobile_no.length !=0 ){
            Swal.fire('Please check mobile number');
     }
});  
</script>
</body>

</html>                            