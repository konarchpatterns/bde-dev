@extends('layouts.calanderdashboard')

@section('style')
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 -->

<!-- <link href="{{ asset('fullcalendar/fullcalendar.css')}}" rel="stylesheet"> -->
<link href="{{ asset('fullcalendar/css/fullcalendar.print.css')}}" rel="stylesheet" media="print">

<link rel="stylesheet" href="{{ asset('fullcalendar/fullcalendar.min.css')}}" />
<link rel="stylesheet" href="{{ asset('fullcalendar/css/jquery.qtip.min.css')}}" />

<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" /> -->

<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
 -->

 <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

 <style type="text/css">

   .dialogbtn {
    background-color: #D3D3D3;
   }

.mycontent {
    font-family: 'Open Sans',sans-serif;
    font-size: 14px;
    line-height: 1.36;
    color: #333;
    background-color: white;

}
   div.ui-datepicker{
 font-size:12px;
}
 </style>

@endsection


@section('content')

<div class="row mr-1 ml-1">
    <table width="100%" >   
     <tr>
    <td  valign="top">
     <!-- <div class="col-md-2 mt-1"> -->
        <a class="btn btn-primary mt-1">+ Create</a>
       <div id="datepicker" class="mt-1 pt-3"></div>
 <!--    </div> -->
    </td>
    <td width="100%">
<!--    <div class="col-md-12"> -->
        <div id="calendar" class="ml-1 mt-1">
   <!--  </div> -->
</div>
    </td>
    </tr>
    </table>

</div>
    <!--     <div class="col-md-10 col-md-offset-4">
            <div class="panel panel-default"> -->
           <!--      <div class="panel-heading">Calendar</div> -->

                <!-- <div   class="panel-body">
               
                     <div class="response"></div>
                     <div id="calendar"></div>
                </div> -->

                <div class="modal fade right" id="eventDialog" aria-hidden="true">

                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="modelHeading"></h4>
                                  <label id="closeuser" class="btncancle">Cancel</label>
                            </div>

                            <div class="modal-body">
                             {{ Form::model($event, array('route' => array('event.store'))) }} 

                        <div class="row">
                            <div class="col-md-4 pr-1">
                              <label>Title:</label>
                              <input type="hidden" id="id1" name="id" value=0>
                            <input id='title' name='title' class="form-control mt-0 field" type="text" value=""></input>
                             </div>
                           
                             <div class="col-md-4 px-1">
                                 <label>Start Date:</label>
                                     <input id='start_date' name='start_date' class="form-control mt-0 field"
                                      type="text" value=""></input>
                             </div>
                             <div class="col-md-4 pl-1">
                                 <label>End Date:</label>
                                     <input id='end_date' name='end_date' class="form-control mt-0 field"
                                      type="text" value=""></input>
                             </div>
                        </div>  
                    <div class="row">
                            <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label>Parent</label>
                                <select name="status" data-name="status" class="form-control mt-0">
                                    <option value="Company" >Company</option><option value="Lead">Lead</option>
                                    <option value="Client">Client</option>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-3 px-1">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" name="company" class="form-control mt-0 compinput" id="company_name">
                            </div>
                            </div>

                             <div class="col-md-3 px-1 "  id="clienttextbox">
                            <label>Guest Email</label>
                            <div class="form-group input-group my-group">  
                                <input type="text" name="clientname[]" class="form-control mt-0 clientinput" id="client_name">
                                <a id="selectclient" class="bg-secondary rounded-right" > <i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 
                            </div>
                             <!-- <lable id="addclient" class="btn btn-sm  btn-warning" > + </lable> -->
                            </div>
                            <div class="col-md-3 pl-1" id="usertextbox">
                            <label>User Email</label>
                            <div class="form-group input-group my-group"  >
                                <input type="text" name="username[]" class="form-control mt-0">
                                <a id="selectuser" class="bg-secondary rounded-right" > <i class="fa fa-caret-down mt-2" aria-hidden="true" style="font-size:25px;color:black"></i> </a> 
                            </div>
                           <!--  <lable id="adduser" class="btn btn-sm  btn-warning" > + </lable> -->
                            </div>
                    </div> 
                    <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control form-control2 my-0"></textarea>
                            </div>
            </div>
                    </div>
                               
                             {{ Form::close() }}
                                
                            </div>

                        </div>

                    </div>

                  </div>
                  <div id='' class='dialog ui-helper-hidden'>
                        <!-- <form> -->
                        {{ Form::model($event, array('route' => array('event.store'))) }}  
                        <div class="row">
                            <div class="col-md-6">
                              <label>Title:</label>
                              <input type="hidden" id="id1" name="id" value=0>
                            <input id='title' name='title' class="form-control mt-0 field" type="text" value=""></input>
                             </div>
                            <!-- <div>
                                 <label>Color:</label>
                                     <input id='color' class="field" type="text"></input>
                             </div> -->
                             <div class="col-md-6">
                                 <label>Start Date:</label>
                                     <input id='start_date' name='start_date' class="form-control field"
                                      type="text" value=""></input>
                             </div>
                        </div>   
                             <div>
                                <button id="pbutton" type="submit" class="btn btn-primary ">Create</button>
                                 <!-- <a type="button" class ="btn btn-primary dialogbtn" href="">  </a> -->

                             </div>
                       <!--  </form> -->
                       {{ Form::close() }}

                  </div>
       <!--      </div>
        </div> -->
    </div>
</div>


@endsection

@section('script')



<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->

    <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script>


<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />
 -->

<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.1/backbone-min.js"></script> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/es-us.js" integrity="sha256-GLtGssLoLnMtXFDxuUAnn+DU02rievBO5E7B5/P50ik=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 -->
<!-- <script src="{{ asset('js/fullcalendar.js') }}"></script> -->

<!-- <script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
 -->


<script src='{{ asset("fullcalendar/lib/moment.min.js") }}'></script>
<!-- <script src='{{ asset("fullcalendar/lib/jquery.min.js") }}'></script> 
<script src='{{ asset("fullcalendar/lib/jquery-ui.custom.min.js") }}'></script> -->
<script src='{{ asset("fullcalendar/fullcalendar.min.js") }}'></script>
<script src='{{ asset("fullcalendar/jquery.qtip.min.js") }}'></script>




<script type="text/javascript">
function get_calendar_height() {
      return $(window).height() - 70;
}

  $(document).ready(function(){

  //       $( "#eventDialog" ).dialog({
  //   autoOpen: false
  // });

  $("body").on("click", ".dialogbtn", function(e){
            debugger;
           var  id1  =  $("#id1").val() ;
          // alert( id1 );
         //   alert($("#title").val(title));
          //  alert($("#start_date").val(start));
          //  alert($("#end_date").val(start));

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }); 
             var title1  =  $("#title").val();
             var start_date1  =  $("#start_date").val();
              
             
             formData = { id : id1 , title: title1, start_date : start_date1 }
             // $.ajax({
             //                type: "POST",
             //              //  dataType: "JSON",
             //                url: "{{ URL::to('events/event_clicks')}}",
             //                data: formData,
             //                success: function(result)
             //                { 
                            
                           
             //                }, 
             //                  error: function(){
             //                            console.log('AJAX load did not work');
             //                    }
             //            });

  });




  //  $('#eventDialog').dialog({
  //      autoOpen: false,
  //      title: "Events",
  //      //width: 200,
  //      modal: true,
  // });

 

    //$("#edit-modal-container-4597").modal('hide');

//     $('#calendar').fullCalendar({
//   dayClick: function(date, jsEvent, view) {
    

//     alert('Clicked on: ' + date.format());
//     var current_date  =  date.format();

//    // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

//    // alert('Current view: ' + view.name);
//    $("#event_date").val(current_date);
//    $("#eventDialog").dialog();

//    // $("#edit-modal-container-4597").modal('show');

//     // change the day's background color just for fun
//     $(this).css('background-color', 'red');

    

//   }
// });

        // $(document).on('click', ".fc-event-container", function(){
 
       
        //     $("#edit-modal-container-4597").modal('show');

        // });  URL::to('clients_1/statename')

        var calendar = $('#calendar').fullCalendar({
              height: get_calendar_height,
           
               eventLimit: 2,
                eventLimitText:"More",
             //   contentHeight: 600,
            // aspectRatio:1.7,
          header: {   left: 'prev,next today myCustomButton',
                    center: 'title',
                   right: 'agendaDay,agendaWeek,month,list timeline',
            // center: 'dayGridMonth,timeGridWeek'
             },
           // buttons for switching between views
        
          views: {

              dayGridMonth: { // name of view
              titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit', weekday: 'long'}
                      // other view-specific options here
              } ,

               list: {

                  displayEventTime: true
                   

                }, 
              }, 
        editable: true,
       
        events: [
              @foreach($data as $evnt)
        {
             id  :  '{{ $evnt['id'] }}',
            title : '{{ $evnt['title'] }}',
            start : '{{ $evnt['start'] }}',
            end: '{{ $evnt['end'] }}',
            // url: '{{ URL::to("events/event_clicks") }}'
            
        },
        @endforeach
        ],
        displayEventTime: false,
        eventRender: function (event, element, view) {
            console.log(event)
             element.qtip({
            content: event.description,
            // Position (optional)
            position: {
                my: 'center center',
                at: 'center center',
                target: $(element)
            }
        });
            if (event.allDay === 'true') {
                event.allDay = false;
            } else {
                event.allDay = false;
            }
        },
        eventAfterRender: function (event, element, view) {
        var dataHoje = new Date();
        if (event.start < dataHoje && event.end > dataHoje) {
            //event.color = "#FFB347"; //Em andamento
            element.css('background-color', '#FFB347');
        } else if (event.start < dataHoje && event.end < dataHoje) {
            //event.color = "#77DD77"; //Concluído OK
            element.css('background-color', '#77DD77');
        } else if (event.start > dataHoje && event.end > dataHoje) {
            //event.color = "#AEC6CF"; //Não iniciado
            element.css('background-color', '#AEC6CF');
        }
    },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
           
           // var title = prompt('Event Title:');  this logic not require as only title event consider
         //  debugger;
           $("#title").val("");
             var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            // alert(start);
            //    var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            $("#start_date").val(start);
            $(".dialogbtn").text("Create");

            // alert( $("#start_date").val() );

            $("#eventDialog").modal("show");
            var title = $("#title").val();

            // if (title) {
            //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            //     $.ajax({
            //         url: 'add-event.php',
            //         data: 'title=' + title + '&start=' + start + '&end=' + end,
            //         type: "POST",
            //         success: function (data) {
            //             displayMessage("Added Successfully");
            //         }
            //     });
            //     calendar.fullCalendar('renderEvent',
            //             {
            //                 title: title,
            //                 start: start,
            //                 end: end,
            //                 allDay: allDay
            //             },
            //     true
            //             );
            // }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    console.log(event);
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {

                    //    debugger;
                      console.log(event);
                      //alert('click');

            var id    = event.id ;                      
            var title =  event.title ;
            alert( id + title);
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
           // var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
           // alert(title);  
            $("#id1").val(id);
            $("#title").val(title);
            $("#start_date").val(start);
            $("#end_date").val(start);
            $(".dialogbtn").text("Modify");
            $("#eventDialog").modal("show");
            //var deleteMsg = confirm("Do you really want to delete?");
            // if (deleteMsg) {
            //     $.ajax({
            //         type: "POST",
            //         url: "delete-event.php",
            //         data: "&id=" + event.id,
            //         success: function (response) {
            //             if(parseInt(response) > 0) {
            //                 $('#calendar').fullCalendar('removeEvents', event.id);
            //                 displayMessage("Deleted Successfully");
            //             }
            //         }
            //     });
            // }
        }

    });

        $('#datepicker').datepicker({
        inline: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#calendar').fullCalendar('gotoDate', d);
        }
       }); 
    });

  // $( function() {
  //   $( "#datepicker" ).datepicker();

        

  //   //   $("#datepicker").on("change",function(){
  //   //     var selected = $(this).val();
  //   //    var res = selected.split("/");
  //   //    var date=res[2]-res[];
  //   //     date = moment("2018-01-04", "YYYY-MM-DD");
  //   //     $("#calendar").fullCalendar( 'gotoDate', date );
  //   //     alert(selected);
  //   //     10/16/2019   2018-01-04
  //   // });
  // });


</script>
@endsection