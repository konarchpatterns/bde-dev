<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('patternscrmdesign/assets/img/rsz_2logo125_opt.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('patternscrmdesign/assets/img/rsz_2logo125_opt.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Patterns CRM</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> -->
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link href="{{asset('assets/css/light-bootstrap-dashboard790f.css')}}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"> 
   <!--  toastr css -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->

    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> 
   <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet">
   <link href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" >
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css">
@php
         
         $d=\App\User::select('color','sidebar')->where('id',Auth::user()->id)->get() ;
         $sidecolor="";
         $temcolor="hh";
      
           foreach($d as $v){
              $sidecolor=$v->color;
              $sidebarm=$v->sidebar;
       }
       if($sidecolor == "black"){
           $temcolor='black';
       }
       elseif($sidecolor == "azure"){
            $temcolor="#23CCEF";
       }
       elseif($sidecolor == "green"){
             $temcolor='green';
       }
       elseif($sidecolor == "orange"){
              $temcolor='orange';
       }
       elseif($sidecolor == "red"){
              $temcolor='red';
       }
       else{
              $temcolor='purple';
       }
     
        @endphp



.cc{
  display: none;
}
.dd{
   display: none;
}


.form-control2 {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
     padding: 3px 0px 3px 3px;
    height:70px;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.form-control3 {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 1px;
    color: #565656;
     padding: 3px 0px 3px 3px;
    height:30px;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.btnback {
  background-color:#4fc1db;
  border: none;
  color: white;
  padding: 7px 14px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 0px 0px;
  cursor: pointer;
  border-radius: 10px;
}
  input[type=text],input[type=email]{
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
/*  height: 30px;*/
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;
}
.sidebar .logo a.logo-mini {
    float: left;
    width: 46px;
    text-align: center;
    margin-left: 20px;
    margin-right: 5px;
    position: relative;
}
.sidebar .logo .simple-text {
    text-transform: initial;
    padding: 5px 0px;
    display: inline-block;
    font-size: 1.125rem;
    font-weight: 400;
    line-height: 30px;
    white-space: nowrap;
    color: #FFFFFF;
  /*  overflow: hidden;*/
}
/* select.form-control{
   max-height: 30px;
 }*/
input[type=text]:focus, input[type=email]:focus,textarea:focus {
  box-shadow: 0 0 10px rgba(232, 126, 4, 1);
  padding: 3px 0px 3px 3px;
 /* margin: 5px 1px 3px 0px;*/
  border: 1px solid rgba(232, 126, 4, 1);
}

table.dataTable thead th {
  background-color:#565759;
   text-align-last: center;
    color: white;
}
  .dataTables_filter > label{
    color: white;
  }
   
  .dataTables_length > label{
    color: white;
  }
/*table.dataTable td  {
  border: 1px solid #ddd;
  padding: 8px;
}*/
/*table.dataTable tbody tr:nth-child(odd){background-color: #7a7479;color:white;}
table.dataTable tbody tr:nth-child(even){background-color: #8a7f88;color:white;}*/
/*table.dataTable,th,td{
  border: 2px solid;
  border-color: white;
  background-color: #565759;
}*/
h5{
color: white;

}
.card{
  background-color:  #565759;
  border-color: white;

}
.card label{
color: white;
 font-size: 13px;
     margin-bottom: 0px;

    
  text-transform: capitalize;
      
}

 .jumbotron {
 
     padding: 1px 1px 1px 1px;
     background-color: #565759;
 /*   background-color: black;*/
}
.rightdiv{
    float: right;
  }
#more {display: none;}
.unreadnoti{
 background-color: #FFE4AE;font-size: 13px; word-wrap: break-all;color: black; text-align: justify;padding-top: 04px;padding-bottom: 04px;padding-left: 07px;padding-right: 07px;border-top: 2px solid #9FA296;font-weight: 500;
 
}
.readnoti{
 background-color: white;font-size: 13px; word-wrap: break-all;color:black; text-align: justify;padding-top: 04px;padding-bottom: 04px;padding-left: 07px;padding-right: 07px;border-top: 2px solid #9FA296;font-weight: 500;
}
</style>
    @yield('style')
</head>

<body class="{{$sidebarm}}">
    <div class="wrapper">
        <!--sidebar -->
         @include('partial.sidebar')
             <!--End sidebar -->
        <div class="main-panel"  style="background-color: white">
            <!-- Navbar -->
             @include('partial.navbar')
            <!-- End Navbar -->
           
                
                 
                   <!--content -->
                    @yield('content')
                   <!--End content -->
               
           
        
     </div>
</body>
<!--   Core JS Files   -->

 @include('partial.script')
 <script type="text/javascript">
  
   //set unreadnotification value  
  $("#notificationvalue").text({{Auth::user()->unreadNotifications->count()}});
 //stop to prevent dropdownbox click on notification  
  jQuery('.stopdropdownclose').on('click', function (e) {
      e.stopPropagation();
  });
  //click on notification take notification id so mark as read
  $(".ddddd").on('click',function(){
  var id=this.id;
  var obj=$(this);
   $.ajax({
                type: "post",
                url: "{{route('read.readnotificationmessage')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "notificationid":id,
                       },
                 
                 success: function(data){  

                   $(obj).css("background-color","white");
                   $(obj).removeClass('ddddd');

                   if(data == 0){

                      $("#notificationvalue").remove()
                   }
                   else{

                      $("#notificationvalue").text(data);
                   }

                 },
  });

});

$(document).ready(function () {
  $("#minimizeSidebarcos").on('click',function(){
       
         if ($("body").hasClass("sidebar-mini")){
                   $("body").removeClass("sidebar-mini");    
         }
         else{
                $("body").addClass("sidebar-mini");
         }
             $.ajax({
             type:"GET",
             url:'{{url('maxminsidebar')}}',
             success:function(data){
             
                 
            }
          });
        });
      
     
});

</script>
 @yield('script')
</html>
