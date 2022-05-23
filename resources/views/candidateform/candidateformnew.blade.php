<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Supported HTML Form Controls in Bootstrap 4</title>


<link href="{{ asset('download/bootstrap.min.css')}}" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<link href="{{ asset('download/jquery-ui.css')}}" rel="stylesheet" />
<!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css">  -->
<link href="{{ asset('download/jquery.min.js')}}" rel="stylesheet" />
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script src="{{ asset('download/jquery.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="{{ asset('download/sweetalert2.all.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script> -->
<script src="{{ asset('download/popper.min.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> -->
<script src="{{ asset('download/bootstrap.min.js') }}"></script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script src="{{ asset('download/jquery-1.12.4.js') }}"></script>
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="{{ asset('download/jquery-ui.js') }}"></script>
<!--   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->



  
<style>

    .bs-example{
        margin: 20px;        
    }
    .swal2-popup {
  font-size: 0.9rem !important;
}
.form-control{
   
    height:30px;
      font-size: 1rem;
}
.custom-select{
    height:30px;
    padding:.20rem;
}
label {
    display: inline-block;
    margin-bottom: .0rem;
    font-size: 15px;
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
    background:
        linear-gradient(#312E2C, transparent),
        linear-gradient(to top left, #393938, transparent),
        linear-gradient(to top right, black, transparent);
    background-blend-mode: screen;
    color: white;
}
.ts{
 text-shadow: 1px 2px 10px white;
}
</style>
<script>
// Self-executing function
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
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
    <div class="form-group row">
         <div class="col-md-4">
         <img src="{{asset('patternscrmdesign/assets/img/smalllogo.png')}}" class="pl-1">
        </div>
         <div class="col-md-4 mt-3">
          <h3 class="text-center ts">Candidate Form</h3>
      </div>
    </div>
    <form class="needs-validation" action="{{route('mail.candidatestore')}}" method="post" novalidate>
         @csrf
        <div class="row form-group"> 
          <div class="col-md-3" >
          </div>
            <div class="col-md-2" >
                <label for="dateofinterview">Date:</label>
                <input type="text" class="form-control mt-1" id="dateofinterview"  readonly="" name="date_of_interview" >
            </div>
            <div class="col-md-4" >
                <label for="firstName">Post Applied For:</label>
                <input type="text" class="form-control mt-1" id="dateofinterview" placeholder="" name="post_applied" value="{{old('post_applied')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2 offset-sm-3">
              <label for="firstName"><span style='color: red'>*</span>First Name:</label>
                <input type="text" class="form-control mt-1" id="FirstName" placeholder="First Name" name="first_name" value="{{old('first_name')}}"required>
            </div>
             <div class="col-md-2">
               <label for="LastName"><span style='color: red'>*</span>Middle Name:</label>
                <input type="text" class="form-control mt-1" id="MiddleName" placeholder="Middle Name" name="middle_name" value="{{old('middle_name')}}" required>
            </div>
            <div class="col-md-2">
                <label for="LastName"><span style='color: red'>*</span>Last Name:</label>
                <input type="text" class="form-control mt-1" id="LastName" placeholder="Last Name" name="last_name" value="{{old('last_name')}}" required>
            </div>
        </div>
          <div class="row form-group">
              <div class="col-md-3" >
              </div>
            <div class="col-md-3">
                 <label for="family_occupation">Father's/Husband's Occupation:</label>
                <input type="test" class="form-control" id="family_occupation" placeholder="Designation" name="family_occupation" value="{{old('family_occupation')}}">
            </div>
             <div class="col-md-2">
                 <label ><span style='color: red'>*</span>D.O.B:</label>
                <input type="text" class="form-control" id="datepicker" placeholder="dd/mm/yyyy" name="dob" required  autocomplete="off">
            </div>
           
            <div class="col-md-1">
                <label for="age">Age:</label>
                <input type="text" class="form-control" id="age" placeholder="Age" name="age" required readonly="" >
            </div>
        </div>
           <div class="row form-group">
            <div class="col-md-3" >
            </div>
            <div class="col-md-3">
             <label  for="inputEmail">Email Address:</label>
                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" value="{{old('email')}}">
            </div>
            <div class="col-md-3">
                <div class="row">
                <div class="col-md-6">
                  <label for="phoneNumber"><span style='color: red'>*</span>Mobile(M) :</label>
                <input type="number" class="form-control" id="mobile_no" placeholder="Mobile(M)" name="mobile_no" value="{{old('mobile_no')}}" required pattern="\d{3}[\-]\d{3}[\-]\d{4}">
                </div>
                <div class="col-md-6">
                  <label for="otherphoneNumber">Mobile(R):</label>
                <input type="number" class="form-control" id="residence_no" placeholder="Mobile(R)" name="residence_no" value="{{old('residence_no')}}" pattern="\d{3}[\-]\d{3}[\-]\d{4}">
                </div>
                </div>
            </div>  
            </div>
            <div class="row form-group">
             <div class="col-md-3" >
             </div>
            <div class="col-md-4 ">
             <label  for="school_name">Name Of School:</label>
                <input type="text" class="form-control" id="school_name" placeholder="Name Of School" name="school_name" value="{{old('school_name')}}">
            </div>
             <div class="col-md-2">
                <label for="school_medium">Medium:</label>
                <input type="text" class="form-control" id="school_medium" placeholder="Medium"  name="school_medium" value="{{old('school_medium')}}">
            </div>
        </div>
         <div class="row form-group">
            <div class="col-md-3" >
            </div>
        <div class="col-md-4 ">
             <label  for="inputCollege">Name Of College:</label>
                <input type="text" class="form-control" id="college_name" placeholder="Name Of College" name="college_name" value="{{old('college_name')}}">
            </div>
             <div class="col-md-2">
                <label for="college_medium">Medium:</label>
                <input type="text" class="form-control" id="college_medium" placeholder="Medium" name="college_medium" value="{{old('college_medium')}}">
            </div>
        </div>
         <div class="row form-group">
            <div class="col-md-3" >
            </div>
            <div class="col-md-6">
                 <label for="inputLastEducation">Last Education:</label>
                <input type="test" class="form-control" id="last_education" placeholder="Last Education" name="last_education" value="{{old('last_education')}}">
            </div>
        </div>
         <div class="row form-group">
            <div class="col-md-3" >
            </div>
            <div class="col-md-6">
                <label  for="present_address">Present Address:</label>
                <textarea rows="2" class="form-control" id="present_address" placeholder="Postal Address" name="present_address"  required>{{old('present_address')}}</textarea>
            </div>
        </div>
           <div class="row form-group"> 
            <div class="col-md-3" >
            </div>
            <div class="col-md-4">
                <label for="Previous">Previous/Current Employer :</label>
                <input type="text" class="form-control" id="Previous" placeholder="Previous/Current Employer" value="{{old('previos_current_job')}}" name="previos_current_job">
            </div>
             <div class="col-md-2">
                <label for="Previous">Total Work Exp:</label>
                <div class="row input-group my-group pl-3">
                <select  class="custom-select rounded-right" id="year" placeholder="Year" name="year" value="{{old('year')}}">
                      <option value="0">Year</option>
                    @for($i=0;$i<=25;$i++)
                        <option>{{$i}}</option>
                    @endfor
                </select>
                 <!--  <p class="bg-white rounded-right text-dark pr-1" style="height: 30px">Year</p>-->
                  <p class="px-3"></p> 
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
            <div class="col-md-3" >
            </div>
            <div class="col-md-3">
                <label  for="ReasontoLeave"><span id="Dynamicreq" class="dynamicrequired" style='color: red'>*</span>Reason to Leave:</label>
                <textarea rows="3" class="form-control" id="ReasontoLeave" placeholder="Reason to Leave" name="reason_to_leave" maxlength="300" >{{old('reason_to_leave')}}</textarea>
            </div>
             <div class="col-md-3 ">
                <label  for="ReasontoLeave">Any Other Commitments:</label>
                <div class="row input-group my-group" id="commentsid">
                <a  class="btn btn btn-success ml-3 yescommitements" >Yes</a>
                 <a  class="btn btn btn-danger ml-3 nocommitements" >No</a>
                </div>
                <textarea rows="3" class="form-control notvisible" name="any_commitment" id="any_commitment" placeholder="Any other commitments you have apart from applied job " value="{{old('any_commitment')}}"></textarea>
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-9 offset-sm-3">
                <label class="checkbox-inline">
                    <input type="checkbox" class="mr-1" value="agree" required=""> I agree to the <a href="#">Terms and Conditions</a>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-9 offset-sm-3">
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