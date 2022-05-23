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
    <link rel="apple-touch-icon" sizes="76x76"
        href="{{ asset('patternscrmdesign/assets/img/rsz_2logo125_opt.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('patternscrmdesign/assets/img/rsz_2logo125_opt.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Patterns CRM</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" /> -->
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('patternscrmdesign/assets/css/bootstrap.min.css') }}" rel="stylesheet" /> -->

    <link href="{{ asset('assets/css/light-bootstrap-dashboard790f.css') }}" rel="stylesheet" />
    <!--  <link href="{{ asset('patternscrmdesign/assets/css/light-bootstrap-dashboard.css?v=2.0.0') }} " rel="stylesheet" /> -->
    <!-- <link href="{{ asset('patternscrmdesign/assets/css/hover.css') }}" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css">

    <!--  toastr css -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/css/demo.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('patternscrmdesign/assets/css/demo.css') }}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!--  Extra nit not in omsv4 -->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css" rel="stylesheet"
        type="text/css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <style type="text/css">
        @php
            
            $d = \App\User::select('color', 'sidebar')
                ->where('id', Auth::user()->id)
                ->get();
            $sidecolor = '';
            $temcolor = 'hh';
            
            foreach ($d as $v) {
                $sidecolor = $v->color;
                $sidebarm = $v->sidebar;
            }
            if ($sidecolor == 'black') {
                $temcolor = 'black';
            } elseif ($sidecolor == 'azure') {
                $temcolor = '#23CCEF';
            } elseif ($sidecolor == 'green') {
                $temcolor = 'green';
            } elseif ($sidecolor == 'orange') {
                $temcolor = 'orange';
            } elseif ($sidecolor == 'red') {
                $temcolor = 'red';
            } else {
                $temcolor = 'purple';
            }
            
        @endphp a {
            color: #21618C;
        }

        a:hover {
            color: #21618C;
        }

        .s {
            /*box-shadow: 1px 1px 5px black;*/
        }

        .sr {
            /*box-shadow: 1px 1px 5px {{ $temcolor }};*/
        }

        .ts {
            /* text-shadow: 1px 1px 2px {{ $temcolor }};*/
        }

        .tooltip-inner {
            max-width: 200px;
            padding: 3px 8px;
            color: black;
            font-weight: bold;
            text-align: center;
            background-color: #549087;
            border-radius: .25rem;
        }

        /*.tooltip.bs-tooltip-auto[x-placement^=top] .arrow::before, .tooltip.bs-tooltip-top .arrow::before {
    margin-left: -3px;
    content: "";
    border-width: 5px 5px 0;
    border-top-color: #549087;
}
.tooltip.bs-tooltip-auto[x-placement^=left] .arrow::before, .tooltip.bs-tooltip-left .arrow::before {
    right: 0;
    margin-top: -3px;
    content: "";
    border-width: 5px 0 5px 5px;
    border-left-color: #549087;
}*/

        .cc {
            display: none;
        }

        .dd {
            display: none;
        }

        .btn2 {
            background-color: #339CFF;
            border: none;
            color: black !important;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 1px;
            cursor: pointer;
            border-radius: 0px;
        }

        .form-control2 {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 4px;
            color: #565656;
            padding: 3px 0px 3px 3px;
            height: 70px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .form-control3 {
            background-color: #FFFFFF;
            border: 1px solid #E3E3E3;
            border-radius: 1px;
            color: #565656;
            padding: 3px 0px 3px 3px;
            height: 30px;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .ui-state-default,
        .ui-widget-content .ui-state-default,
        .ui-widget-header .ui-state-default {

            border-radius: 10%;
            box-shadow: ;
            height: 25px;
            width: 35px;
            text-align: center;

        }

        input[type=text],
        input[type=email] {
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

        /* select.form-control{
   max-height: 30px;
 }*/
        input[type=text]:focus,
        input[type=email]:focus,
        textarea:focus {
            box-shadow: 0 0 10px rgba(232, 126, 4, 1);
            padding: 3px 0px 3px 3px;
            /* margin: 5px 1px 3px 0px;*/
            border: 1px solid rgba(232, 126, 4, 1);
        }

        .table thead th {
            background: transparent;
            text-align-last: center;
            color: black !important;

        }

        table.dataTable thead .sorting {
            background-image: none;
        }

        table.dataTable thead .sorting_desc {
            background-image: none;
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
        .table tbody tr {
            background: transparent !important;

        }

        .card {
            background: transparent;
            border-color: {{ $temcolor }};

        }

        .ts {
            text-shadow: 1px 1px 1px black;
        }

        .card label {

            font-size: 13px;
            margin-bottom: 0px;


            text-transform: capitalize;

        }

        .btn1 {
            background-color: white;
            color: black;
            /* height: 40px; */
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 1px;
            cursor: pointer;
            border-radius: 0px;
        }

        .jumbotron {

            padding: 1px 1px 1px 1px;
            /*   background-color: black;*/
        }

        .rightdiv {
            float: right;
        }

        #more {
            display: none;
        }

        /*notification css*/
        .unreadnoti {
            background-color: #FFE4AE;
            font-size: 13px;
            word-wrap: break-all;
            color: black;
            text-align: justify;
            padding-top: 04px;
            padding-bottom: 04px;
            padding-left: 07px;
            padding-right: 07px;
            border-top: 2px solid #9FA296;
            font-weight: 500;

        }

        .readnoti {
            background-color: white;
            font-size: 13px;
            word-wrap: break-all;
            color: black;
            text-align: justify;
            padding-top: 04px;
            padding-bottom: 04px;
            padding-left: 07px;
            padding-right: 07px;
            border-top: 2px solid #9FA296;
            font-weight: 500;
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

        .bodycolorclass {

            background: rgba(203, 203, 210, 0.15);

        }

    </style>
    @yield('style')
</head>

<body class="bodycolorclass {{ $sidebarm }}">
    <div class="wrapper">
        <!--sidebar -->
        @include('partial.sidebar')
        <!--End sidebar -->
        <div class="main-panel">
            <!-- Navbar -->
            @include('partial.navbar')
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div id="result"></div>
                    <!--content -->
                    @yield('content')
                    <!--End content -->
                </div>
                <div class="fixed-plugin">
                    <div class="dropdown show-dropdown">
                        <a href="#" data-toggle="dropdown">
                            <i class="fa fa-cog fa-1x"> </i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header-title"> Sidebar Style</li>
                            <li class="adjustments-line">
                                <a href="javascript:void(0)" class="switch-trigger">
                                    <p>Background Image</p>
                                    <label class="switch-image">
                                        <input type="checkbox" data-toggle="switch" checked="" data-on-color="info"
                                            data-off-color="info">
                                        <span class="toggle"></span>
                                    </label>
                                    <div class="clearfix"></div>
                                </a>
                            </li>


                            <li class="adjustments-line">
                                <a href="javascript:void(0)" class="switch-trigger background-color">
                                    <p>Filters</p>
                                    <div class="pull-right">
                                        <span class="badge filter badge-black" data-color="black"></span>
                                        <span class="badge filter badge-azure" data-color="azure"></span>
                                        <span class="badge filter badge-green" data-color="green"></span>
                                        <span class="badge filter badge-orange active" data-color="orange"></span>
                                        <span class="badge filter badge-red" data-color="red"></span>
                                        <span class="badge filter badge-purple" data-color="purple"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </li>
                            <li class="header-title">Sidebar Images</li>
                            <li class="active">
                                <a class="img-holder switch-trigger" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/sidebar-1.jpg') }}" alt="" />
                                </a>
                            </li>
                            <li>
                                <a class="img-holder switch-trigger" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/sidebar-3.jpg') }}" alt="" />
                                </a>
                            </li>
                            <li>
                                <a class="img-holder switch-trigger" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/sidebar-4.jpg') }}" alt="" />
                                </a>
                            </li>
                            <li>
                                <a class="img-holder switch-trigger" href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/sidebar-5.jpg') }}" alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->

@include('partial.script')
<script type="text/javascript">
    $(document).ready(function() {
        //set unreadnotification value  
        $("#notificationvalue").text({!! Auth::user()->unreadNotifications->count() !!});
        //stop to prevent dropdownbox click on notification  
        jQuery('.stopdropdownclose').on('click', function(e) {
            e.stopPropagation();
        });
        //click on notification take notification id so mark as read
        $(".ddddd").on('click', function() {
            var id = this.id;
            var obj = $(this);
            $.ajax({
                type: "post",
                url: "{{ route('read.readnotificationmessage') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "notificationid": id,
                },

                success: function(data) {

                    $(obj).removeClass('unreadnoti');
                    $(obj).removeClass('ddddd');
                    $(obj).addClass("readnoti");
                    if (data == 0) {

                        $("#notificationvalue").remove()
                    } else {

                        $("#notificationvalue").text(data);
                    }

                },
            });

        });
        //this ajax run and if any task for user it shows task of user
        $.ajax({
            type: "post",
            url: "{{ route('show.notificationmessage') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "userid": {!! auth()->user()->id !!},
            },

            success: function(data) {
                var data2 = data.min - 300;
                data1 = data2 * 1000;
                var datamin = -30000;
                var datamax = -1;
                var data9 = -29999;
                if (data1 > datamin && data1 < datamax) {
                    var myVar = setInterval(myTimer, data1);

                    function myTimer() {
                        swal({
                            title: "One " + data.type + " for you.",
                            text: "Title : " + data.title + ".",
                            icon: "info",
                            buttons: true,
                        })
                        clearInterval(myVar);
                    }
                }
            },

        });

        $("#minimizeSidebarcos").on('click', function() {

            if ($("body").hasClass("sidebar-mini")) {
                $("body").removeClass("sidebar-mini");
            } else {
                $("body").addClass("sidebar-mini");
            }
            $.ajax({
                type: "GET",
                url: '{{ url('maxminsidebar') }}',
                success: function(data) {


                }
            });
        });
        $(".badge").on('click', function() {
            var new_color1 = $(this).data('color');

            if (new_color1 == "azure") {

                $('.card').css('border-color', '#23CCEF');
                $('#minimizeSidebarcos').css('background-color', '#23CCEF');
                $('#roles th').css('border', '1px solid #23CCEF');
                $('#roles td').css('border', '1px solid #23CCEF');

            } else {

                $('.card').css('border-color', new_color1);
                $('#minimizeSidebarcos').css('background-color', new_color1);
                $('#roles th').css('border', '1px solid ' + new_color1 + '');
                $('#roles td').css('border', '1px solid ' + new_color1 + '');
            }
            $.ajax({
                type: "GET",
                url: '{{ url('setcolortheme') }}',
                data: {
                    new_color: new_color1
                },
                success: function(data) {


                }
            });
        });





    });
</script>
@yield('script')

</html>
