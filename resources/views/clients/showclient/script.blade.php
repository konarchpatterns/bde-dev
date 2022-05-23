<script type="text/javascript">
  var win3cx="";
	function redirectToEmailURL(ee){
  swal({
      text: "Do you want to email "+ee+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
    
     var url = '{{ route("mail.write", ":id") }}';
     url = url.replace(':id', ee);
     location.href=url;
   }
   else{
   }
  });
}
function redirectToPhoneURL(pp,type){
  swal({
      text: "Do you want to call "+type+"!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {
     history.pushState(null, null, location.href);
       window.onpopstate = function () {
           history.go(1);
       };
     
       $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
      });
    @if(substr($backto,0,8) == "calendar")
        $('#clienttaskdispositiondialogbox').modal({
                  backdrop: 'static',
                  keyboard: false
          });
        $( "#clienttaskdispositiondialogbox" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        $( "#clienttaskdispositiondialogbox" ).find("textarea")
       .val('');
         $('#taskcallingnumber').val('');

        document.getElementById("submitclienttaskdisposition").disabled = false;
        $(' #followupid ').addClass('followupvisible');
        $('#taskdatetimepicker').val('');
        $('#taskcallingnumber').val(pp);
        $('#taskcallingnumbertype').val(type);
        $( "#clienttaskdispositiondialogbox" ).modal("show");
        $( '#modelHeading' ).html("Disposition");
    @else
        $('#clientdispositiondialogbox').modal({
                backdrop: 'static',
                keyboard: false
        });
        $( "#clientdispositiondialogbox" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        document.getElementById("submitclientpermission").disabled = false;
        $('#callingnumber').val('');
        $( "#clientdispositiondialogbox" ).find("textarea")
        .val('')
        $(' #followupid ').addClass('followupvisible');
        $('#datetimepicker').val('');
         var cid=document.getElementById("clientid").value;
         $.ajax({
                type: "post",
                url: "{{route('clientdisposition.predispositionentry')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "client_id":cid,
                             "phonenumber":pp,
                             "phonenumbertype":type,
                            
                       },
                 
                 success: function(data){    
                         
                        $( "#clientdispositiondialogbox" ).modal("show");
                        $("#dispositionbackid").val(data);
                        $('#clientid').val(cid);
                        $('#callingnumber').val(pp);
                        $( '#modelHeading' ).html("Disposition");                  
                 },
                   
              });
    @endif
    if($('#worktypeid').val() == 'In side'){
  
        win3cx=window.open("https://157.245.98.226/webclient/#/call?phone="+pp+"",'_blank');
      }
      else{
        
         win3cx=window.open("https://patterns.3cx.in:5001/webclient/#/call?phone="+pp+"",'_blank');
      }
     
     // window.location.href="https://divyarajvaghela.3cx.in/webclient/#/call?phone="+pp+"";
   }
   else{
   }
  });
}

//pop up dispoaition modal
  $(document).on('click','#clientdispositionid',function(){
    history.pushState(null, null, location.href);
       window.onpopstate = function () {
           history.go(1);
       };
       $('#clientdispositiondialogbox').modal({
          backdrop: 'static',
          keyboard: false
       });
       $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
      });
    $( "#clientdispositiondialogbox" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
    document.getElementById("submitclientpermission").disabled = false;
    $( "#clientdispositiondialogbox" ).find("textarea")
       .val('')
    $('#callingnumber').val('');
    $(' #followupid ').addClass('followupvisible');
    $('#datetimepicker').val('');
     var pp="";
     var cid=document.getElementById("clientid").value;
        $.ajax({
            type: "post",
            url: "{{route('clientdisposition.predispositionentry')}}",
            data: {
                             "_token": "{{ csrf_token() }}",
                             "client_id":cid,
                             "phonenumber":pp,
                            
                  },
                 
                success: function(data){    
                         
                        $( "#clientdispositiondialogbox" ).modal("show");
                        $("#dispositionbackid").val(data);
                        $('#clientid').val(cid);
                        $('#callingnumber').val(pp);
                        $( '#modelHeading' ).html("Disposition");                  
              },
                   
        });
  });
  //close disposition modal
  $(document).on('click','.closedisposition',function(){
      $( "#clientdispositiondialogbox" ).modal("hide");
  });
  //pop up taskdispoaition modal
  $(document).on('click','#clienttaskdispositionid',function(){
        history.pushState(null, null, location.href);
       window.onpopstate = function () {
           history.go(1);
       };
       $('#clienttaskdispositiondialogbox').modal({
          backdrop: 'static',
          keyboard: false
       });
       $(window).keydown(function(event){
        if(event.keyCode == 116) {
          event.preventDefault();
          return false;
        }
      });
     $( "#clienttaskdispositiondialogbox" ).find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
    $('#taskcallingnumber').val('');  
    $('#taskcallingnumbertype').val('');  
    $( "#clienttaskdispositiondialogbox" ).find("textarea")
       .val('');
    document.getElementById("submitclienttaskdisposition").disabled = false;
    $(' #followupid ').addClass('followupvisible');
    $('#taskdatetimepicker').val('');
    $( "#clienttaskdispositiondialogbox" ).modal("show");
     // var re = /<br *\/?>/gi;
     // var clientdisposition=document.getElementById("clientdispositions").value;
     // var olddisposition1 = clientdisposition.replace(re,"\n");
  //    document.getElementById("clientolddisposition").value=olddisposition1;
  // console.log(olddisposition1);
    // $( "#clientnewdisposition" ).focus();
     // var diapositiondata=document.getElementById("diapositiondata").value;
     // var id=document.getElementById("companyid").value;
 
    $( '#modelHeading' ).html("Disposition");

  });
  //close taskdisposition modal
  $(document).on('click','.closetaskdisposition',function(){
      $( "#clienttaskdispositiondialogbox" ).modal("hide");
  });





  // $(document).on('#clientnewdisposition').keypress(function(event){ 
  //     if(event.keyCode == 13) {
  //     $("a#submitclientpermission").focus();
  //   }
  // });
  //click ok on disposition submit button
  $(document).on('click','a#submitclientpermission.mt-2',function(){
    document.getElementById("submitclientpermission").disabled = true;
    var description=document.getElementById("clientdescription").value;
    var callingphonenumber=document.getElementById("callingnumber").value;
    var dispositionbackid=document.getElementById("dispositionbackid").value;
    var table2 = $('#activitylog').DataTable();
    var table3 = $('#dispositionlog').DataTable();
    var ele = document.getElementsByName('optradio'); 
    var radiovalue="";     
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                  radiovalue=ele[i].value;
              
            } 
    var id=document.getElementById("clientid").value;
    var follow_up=document.getElementById("datetimepicker").value;
    if(radiovalue == "Call Back" || radiovalue == "Follow Up"){
      var datedispo=radiovalue;
    }
      if(description == "" && radiovalue==""){
        document.getElementById("submitclientpermission").disabled = false;
            toastr.error('Please write disposition!');
     
      }
      else if(radiovalue == "Do Not Call" && description == ""){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please write description');
      }
      else if(radiovalue == datedispo && follow_up ==''){
        document.getElementById("submitclientpermission").disabled = false;
        toastr.error('Please Select date!');
      }
      else{
       $.ajax({
                  type: "post",
                  url: "{{route('clientdisposition.store')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "id":dispositionbackid,
                               "description":description, 
                               "status":radiovalue,  
                               "follow_up":follow_up, 
                            
                        },
                   
                   success: function(data){    
                         
                        $( "#clientdispositiondialogbox" ).modal("hide");
                          table2.ajax.reload();
                          table3.ajax.reload();
                          toastr.success('New Disposition entered successfully!'); 
                          //close 3cx tab if it is open
                          if(callingphonenumber != ""){
                              win3cx.close();
                          } 
                                         
                   },
                     
                  });
       $( "#clientdispositiondialogbox" ).modal("hide");
       }

  });

    //click ok on taskdisposition submit button
  $(document).on('click','a#submitclienttaskdisposition.mt-2',function(){
   document.getElementById("submitclienttaskdisposition").disabled = true;
    var description=document.getElementById("clienttaskdescription").value;
    var callingphonenumber=document.getElementById("taskcallingnumber").value;
    var callingphonenumbertype=document.getElementById("taskcallingnumbertype").value;
    var table2 = $('#activitylog').DataTable();
    var table3 = $('#dispositionlog').DataTable();
    var ele = document.getElementsByName('optradio');
    var radiovalue="";
              
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                   radiovalue=ele[i].value;
              
            } 
    var id=document.getElementById("clientid").value;
    var taskid=document.getElementById("taskid").value;
    var follow_up=document.getElementById("taskdatetimepicker").value;
    if(radiovalue == "Call Back" || radiovalue == "Follow Up"){
      var datedispo=radiovalue;
    }
      if(description == "" && radiovalue==""){
        document.getElementById("submitclienttaskdisposition").disabled = false;
             toastr.error('Please write in  task disposition!');
     
      }
      else if(description == "" && radiovalue=="Do Not Call"){
        document.getElementById("submitclienttaskdisposition").disabled = false;
             toastr.error('Please write in  task description');
      }
      else if(radiovalue == datedispo && follow_up ==''){
        document.getElementById("submitclienttaskdisposition").disabled = false;
        toastr.error('Please Select date!');
      }
      else{
       $.ajax({
                  type: "post",
                  url: "{{route('clientdisposition.taskstore')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "description":description, 
                               "status":radiovalue,  
                               "client_id":id, 
                               "task_id":taskid,
                               "follow_up":follow_up, 
                               "phonenumber":callingphonenumber,
                               "phonenumbertype":callingphonenumbertype,

                        },
                   
                   success: function(data){    
                             

                        $( "#clienttaskdispositiondialogbox" ).modal("hide");
                         
                          table2.ajax.reload();
                          table3.ajax.reload();
                        if(data.data == 1){
                          toastr.success('Task followup entered successfully!');  
                        }   
                        else if (data.data == 2){
                            toastr.error('Task followup not entered');
                        }
                        else{
                            toastr.error('Task followup not entered');
                        }

                        //close 3cx tab if it is open
                        if(callingphonenumber != ""){
                              win3cx.close();
                        } 
                   },
                     
                  });
       $( "#clientdispositiondialogbox" ).modal("hide");
     }
  });
//disposition log data table
 $(function () {
     var table = $('#dispositionlog').DataTable({
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
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('client.clientdispositionlog',['id'=>$clientdata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
            {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
            {data: 'name', name: 'users.name'},
          @permission('view.client.phone')
           @permission('show.client.phone')  
            {data: 'phonenumbertype', name:'phonenumbertype',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
           @else
              {data: 'phonenumber', name:'phonenumber',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                       //    var text1="";
                       // text1 += '<span name=emailtext[] value="'+data+'" onclick="redirectToEmailURL('+data+')"><i class="fa fa-phone-square" aria-hidden="true" style="color:#51C248"></i></span><br>';
                        // return text1;
                         return data;
                    }  
               }},
           @endpermission
          @endpermission
            {data: 'status', name:'status',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'follow_up_date', name:'follow_up_date',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }},
            {data: 'description', name:'description',"render":function(data,type,full,mete){
                    if(data == null)
                    {
                      return "-";
                    }
                    else
                    {
                        return data;
                    }  
            }}, 
            {data:'created_at',name:'created_at'},  
           ],
          order: [[ 0, 'desc' ]],
            
      });
  });
//activity log data table
 $(function () {
     var table = $('#activitylog').DataTable({
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
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    "lengthMenu": 'Display <select class="form-control-sm">'+
                      '<option value="10">10</option>'+
                      '<option value="20">20</option>'+
                      '<option value="30">30</option>'+
                      '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">All</option>'+
                    '</select> records'
                    },
          //Import data in datatable
        ajax: "{{ route('client.activitylog',['id'=>$clientdata->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
                // { width: 10, targets: 0 },
                // { width: 20, targets: 1 },
                // { width: 20, targets: 2 },
                // { width: 20, targets: 3 },
                // { width: 20, targets: 4 },
                // { width: 20, targets: 5 },
          ],
          columns: [   
            {data: 'id', name: 'id',class:'foo dt-center',width:'5%'},
            {data: 'name', name:'users.name'},
            {data: 'description', name:'activity_log.description'},
            {data:'attributes2',name:'activity_log.attributes2'},   
            {data: 'log_name', name: 'activity_log.log_name'}, 
            {data:'attributes1',name:'activity_log.attributes1',class:'attributes1show dt-center',"render":function(data,type,full,mete){
              return '<span data-toggle="tooltip" data-placement="left" title="'+ data+'">' + data + '</span>';
            }}, 
            {data:'created_at',name:'created_at'},  
           ],
          order: [[ 0, 'desc' ]],
            
      });
  });
 //datetime picker jquery
 jQuery('#datetimepicker').datetimepicker({minDate: 'today'});
jQuery('#taskdatetimepicker').datetimepicker({minDate: 'today'});

 // search actvity log table
 $(document).ready(function () {
  //goback using session
  $(' #goback ').on('click',function(){
        window.history.go(-1);
  });
  //show pop click on activity column what modify
  $('#activitylog tbody').on( 'click', '.attributes1show', function () {
      swal({
              text: table.cell( this ).data(),
      });
      
   });
//show followup textbox in disposition click on followup radio buttoon 
 $('input:radio[name=optradio]').click(function(){
        var compare=$(this).val();
        if(compare == 'Follow Up' || compare == 'Call Back' || compare == 'Interested'){
            $(' #followupid ').removeClass('followupvisible');
            $('#datetimepicker').focus();
        }
        else{
          $(' #followupid ').addClass('followupvisible');
          $('#datetimepicker').val('');
          
        }
 });

   $('#activitylog').on('draw.dt', function () {
                    $('[data-toggle="tooltip"]').tooltip(); 
                  });
   $('#activitylog .fhead .firstrow th').each( function (i) {
        var title = $('#activitylog th').eq( $(this).index() ).text();
         //alert(title.trim().length);
        var titleclass = title.substring(0,4);
        if(title.trim().length> 0) {
           $(this).html( '<input  type="text"  name="'+titleclass+'"  placeholder="'+title.trim()+'" data-index="'+i+'"     class="'+titleclass+'"   />' );
        }
    } );
 // Apply the search
    var table = $('#activitylog').DataTable();
    $( table.table().container() ).on( 'keyup', '.fhead .firstrow input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
});
 </script>	
@include('clients.clientmodal.clientinfoindisposition.script')